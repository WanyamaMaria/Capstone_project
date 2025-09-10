<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Facility;
use App\Models\Program;
use App\Models\Participant;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['facility', 'program'])->paginate(10);
        $facilities = Facility::all();
        $programs = Program::all();

        return view('projects.index', compact('projects', 'facilities', 'programs'));
    }

    public function create()
    {
        $facilities = Facility::all();
        $programs = Program::all();

        return view('projects.create', compact('facilities', 'programs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'project_overview' => 'nullable|string',
            'nature_of_project' => 'required|string',
            'innovation_focus' => 'nullable|string',
            'prototype_stage' => 'required|string',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,id',
            'program_id' => 'required|exists:programs,id',
        ]);

        Project::create($validated);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['facility', 'program', 'participants']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $facilities = Facility::all();
        $programs = Program::all();

        return view('projects.edit', compact('project', 'facilities', 'programs'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'project_overview' => 'nullable|string',
            'nature_of_project' => 'required|string',
            'innovation_focus' => 'nullable|string',
            'prototype_stage' => 'required|string',
            'testing_requirements' => 'nullable|string',
            'commercialization_plan' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,id',
            'program_id' => 'required|exists:programs,id',
        ]);

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }

    // Custom: Show participant assignment form
    public function assignParticipants(Project $project)
    {
        $participants = Participant::all();

        return view('projects.assign', compact('project', 'participants'));
    }

    // Custom: Store assigned participants
    public function storeParticipants(Request $request, Project $project)
    {
        $validated = $request->validate([
            'participant_ids' => 'required|array',
            'participant_ids.*' => 'exists:participants,id',
        ]);

        Participant::whereIn('id', $validated['participant_ids'])->update([
            'project_id' => $project->id,
        ]);

        return redirect()->route('projects.show', $project)->with('success', 'Participants assigned successfully.');
    }
}
