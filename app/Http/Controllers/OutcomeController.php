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
        $outcomes = Outcome::all();
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
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
            'outcome_type' => 'required|string',
            'quality_certification' => 'nullable|string',
            'commercialization_status' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $outcome = new Outcome($validated);

        if ($request->hasFile('artifact')) {
            $path = $request->file('artifact')->store('public/artifacts');
            $outcome->artifact_link = Storage::url($path);
        }

        $outcome->save();

        return redirect()->route('outcomes.index')->with('success', 'Outcome created.');
    }

    public function show($id)
    {
        $outcome = Outcome::findOrFail($id);
        return view('outcomes.show', compact('outcome'));
    }

    public function edit($id)
    {
        $outcome = Outcome::findOrFail($id);
        $projects = Project::all();
        return view('outcomes.edit', compact('outcome', 'projects'));
    }

    public function update(Request $request, $id)
    {
        $outcome = Outcome::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'artifact' => 'nullable|file|mimes:pdf,docx,jpg,png,zip|max:2048',
            'outcome_type' => 'required|string',
            'quality_certification' => 'nullable|string',
            'commercialization_status' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
        ]);

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

    public function destroy($id)
    {
        $outcome = Outcome::findOrFail($id);
        if ($outcome->artifact_link) {
            Storage::delete(str_replace('/storage', 'public', $outcome->artifact_link));
        }
        $outcome->delete();
        return redirect()->route('outcomes.index')->with('success', 'Outcome deleted.');
    }
}
