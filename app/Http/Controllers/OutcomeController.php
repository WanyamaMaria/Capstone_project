<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutcomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Outcome::with('project');

        // Search by title or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by project
        if ($request->filled('project_id')) {
            $query->where('project_id', $request->ProjectId);
        }

        $outcomes = $query->paginate(10);
        $projects = Project::all();

        return view('outcomes.index', compact('outcomes', 'projects'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'project_id' => 'required|exists:projects,project_id',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
        'outcome_type' => 'required|string',
        'quality_certification' => 'nullable|string',
        'commercialization_status' => 'nullable|string',
    ]);

    $lastItem = Outcome::withTrashed()->latest('outcome_id')->first();
    $lastNumber = $lastItem ? intval(substr($lastItem->outcome_id, 4)) : 0;
    $outcome_id = 'OUT-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

    $outcome = Outcome::create([
        'outcome_id' => $outcome_id,
        'project_id' => $validated['project_id'],
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        'outcome_type' => $validated['outcome_type'],
        'quality_certification' => $validated['quality_certification'] ?? null,
        'commercialization_status' => $validated['commercialization_status'] ?? null,
    ]);

    if ($request->hasFile('artifact')) {
        $path = $request->file('artifact')->store('public/artifacts');
        $outcome->artifact_link = Storage::url($path);
        $outcome->save();
    }

    return redirect()->route('outcomes.index')->with('success', 'Outcome created.');
}

    public function show($OutcomeId)
    {
        $outcome = Outcome::with('project')->findOrFail($OutcomeId);
        return view('outcomes.show', compact('outcome'));
    }

    public function edit($OutcomeId)
    {
        $outcome = Outcome::findOrFail($OutcomeId);
        $projects = Project::all();
        return view('outcomes.edit', compact('outcome', 'projects'));
    }

   public function update(Request $request, $OutcomeId)
{
    $outcome = Outcome::findOrFail($OutcomeId);

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
        'outcome_type' => 'required|string',
        'quality_certification' => 'nullable|string',
        'commercialization_status' => 'nullable|string',
        'project_id' => 'required|exists:projects,project_id',
    ]);

    // Handle artifact upload
    if ($request->hasFile('artifact')) {
        if ($outcome->artifact_link) {
            Storage::delete(str_replace('/storage', 'public', $outcome->artifact_link));
        }
        $path = $request->file('artifact')->store('public/artifacts');
        $validated['artifact_link'] = Storage::url($path);
    }

    $outcome->update($validated);

    return redirect()->route('outcomes.index')->with('success', 'Outcome updated.');
}

    public function destroy($OutcomeId)
    {
        $outcome = Outcome::findOrFail($OutcomeId);
        if ($outcome->ArtifactLink) {
            Storage::delete(str_replace('/storage', 'public', $outcome->ArtifactLink));
        }
        $outcome->delete();
        return redirect()->route('outcomes.index')->with('success', 'Outcome deleted.');
    }
}
