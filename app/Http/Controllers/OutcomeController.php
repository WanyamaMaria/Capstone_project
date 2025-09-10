<?php

namespace App\Http\Controllers;

use App\Models\Outcome;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OutcomeController extends Controller
{
    public function index()
    {
        $outcomes = Outcome::with('project')->get();
        return view('outcomes.index', compact('outcomes'));
    }

    public function create()
    {
        $projects = Project::all();
        return view('outcomes.create', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'OutcomeId' => 'required|string|unique:outcomes,OutcomeId',
            'ProjectId' => 'required|exists:projects,projectId',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
            'OutcomeType' => 'required|string',
            'QualityCertification' => 'nullable|string',
            'CommercializationStatus' => 'nullable|string',
        ]);

        $outcome = new Outcome($validated);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('public/artifacts');
            $outcome->ArtifactLink = Storage::url($path);
        }

        $outcome->save();

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
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
            'OutcomeType' => 'required|string',
            'QualityCertification' => 'nullable|string',
            'CommercializationStatus' => 'nullable|string',
            'ProjectId' => 'required|exists:projects,projectId',
        ]);

        if ($request->hasFile('artifact')) {
            if ($outcome->ArtifactLink) {
                Storage::delete(str_replace('/storage', 'public', $outcome->ArtifactLink));
            }
            $path = $request->file('artifact')->store('public/artifacts');
            $validated['ArtifactLink'] = Storage::url($path);
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
