<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\Project;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index(Request $request)
    {
        $query = Participant::with('projects');

        // Search by name or email
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by affiliation
        if ($request->filled('affiliation')) {
            $query->where('affiliation', $request->affiliation);
        }

        // Filter by project (via pivot)
        if ($request->filled('project_id')) {
            $query->whereHas('projects', function ($q) use ($request) {
                $q->where('projects.project_id', $request->project_id);
            });
        }

        $participants = $query->paginate(10);
        $affiliations = Participant::select('affiliation')->distinct()->pluck('affiliation');
        $projects = Project::all();

        return view('participants.index', compact('participants', 'affiliations', 'projects'));
    }

    public function show(Participant $participant)
    {
        $participant->load('projects');
        return view('participants.show', compact('participant'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('participants.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email',
            'affiliation' => 'required|string',
            'specialization' => 'required|string',
            'cross_skill_trained' => 'boolean',
            'institution' => 'required|string',
            'projects' => 'array',
            'projects.*' => 'exists:projects,project_id',
        ]);

        // Auto-generate participant_id
        $last = Participant::orderBy('participant_id', 'desc')->first();
        $nextNumber = $last ? intval(str_replace('PT-', '', $last->participant_id)) + 1 : 1;
        $validated['participant_id'] = 'PT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Create participant
        $participant = Participant::create($validated);

        // Attach projects via pivot
        if (!empty($validated['projects'])) {
            $participant->projects()->sync($validated['projects']);
        }

        return redirect()->route('participants.index')->with('success', 'Participant created successfully.');
    }

    public function edit(Participant $participant)
    {
        $projects = Project::all();
        $participant->load('projects');
        return view('participants.edit', compact('participant', 'projects'));
    }

    public function update(Request $request, Participant $participant)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:participants,email,' . $participant->participant_id . ',participant_id',
            'affiliation' => 'required|string',
            'specialization' => 'required|string',
            'cross_skill_trained' => 'boolean',
            'institution' => 'required|string',
            'projects' => 'array',
            'projects.*' => 'exists:projects,project_id',
        ]);

        $participant->update($validated);

        // Sync projects in pivot
        $participant->projects()->sync($validated['projects'] ?? []);

        return redirect()->route('participants.index')->with('success', 'Participant updated successfully.');
    }

    public function destroy(Participant $participant)
    {
        $participant->projects()->detach(); // cleanup pivot
        $participant->delete();

        return redirect()->route('participants.index')->with('success', 'Participant deleted successfully.');
    }
}
