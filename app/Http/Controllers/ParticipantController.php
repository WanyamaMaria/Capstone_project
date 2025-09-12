<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Project;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::with('project');

        // Search by name or email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('fullName', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by affiliation
        if ($request->filled('affiliation')) {
            $query->where('affiliation', $request->affiliation);
        }

        // Filter by project
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->project_id);
        }

        $participants = $query->paginate(10);
        $affiliations = Participant::select('affiliation')->distinct()->pluck('affiliation');

        return view('participants.index', compact('participants', 'affiliations'));
    }

    public function show(Participant $participant)
    {
        $participant->load('project');
        $projects = Project::all();
        return view('participants.show', compact('participant', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('participants.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'affiliation' => 'required|string',
            'specialization' => 'required|string',
            'crossSkillTrained' => 'boolean',
            'institution' => 'required|string',
            'project_id' => 'nullable|exists:projects,projectId',
        ]);

        // Auto-generate participantId
        $last = Participant::orderBy('participantId', 'desc')->first();
        $nextNumber = $last ? intval(str_replace('PT-', '', $last->participantId)) + 1 : 1;
        $validated['participantId'] = 'PT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        Participant::create($validated);

        return redirect()->route('participants.index')->with('success', 'Participant created successfully.');
    }

    public function edit(Participant $participant)
    {
        $projects = Project::all();
        return view('participants.edit', compact('participant', 'projects'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->participant_id . ',participant_id',
            'affiliation' => 'required|string',
            'specialization' => 'required|string',
            'crossSkillTrained' => 'boolean',
            'institution' => 'required|string',
            'project_id' => 'nullable|exists:projects,project_id',
        ]);

        $participant->update($validated);

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->delete();
        return redirect()->route('participants.index')->with('success', 'Participant deleted successfully.');
    }

    public function assignToProject(Request $request, Participant $participant)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,projectId',
        ]);

        $participant->update(['project_id' => $request->project_id]);

        return redirect()->route('participants.index')->with('success', 'Participant assigned to project.');
    }

    public function removeFromProject(Participant $participant)
    {
        $participant->update(['project_id' => null]);

        return redirect()->route('participants.index')->with('success', 'Participant removed from project.');
    }
}
