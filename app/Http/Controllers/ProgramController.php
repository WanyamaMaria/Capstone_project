<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the programs.
     */
    public function index()
    {
        $programs = Program::all();
        return view('programs.index', compact('programs'));
    }

    /**
     * Show the form for creating a new program.
     */
    public function create()
    {
        return view('programs.create');
    }

    /**
     * Store a newly created program in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'national_alignment'  => 'nullable|string|max:255',
            'focus_areas'         => 'nullable|string|max:255',
            'phases'              => 'nullable|string|max:255',
        ]);

        // Get the last program by program_id
        $lastProgram = Program::withTrashed()
                              ->orderBy('program_id', 'desc')
                              ->first();

        // Extract numeric part and increment
        $newNumber = $lastProgram
            ? intval(str_replace('P-', '', $lastProgram->program_id)) + 1
            : 1;

        // Format new program_id
        $programId = 'P-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Create new program
        $program = Program::create([
            'program_id'         => $programId,
            'name'               => $request->name,
            'description'        => $request->description,
            'national_alignment' => $request->national_alignment,
            'focus_areas'        => $request->focus_areas,
            'phases'             => $request->phases,
        ]);

        return redirect()->route('programs.index')
                         ->with('success', 'Program created successfully.');
    }

    /**
     * Display the specified program.
     */
    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    /**
     * Show the form for editing the specified program.
     */
    public function edit(Program $program)
    {
        return view('programs.edit', compact('program'));
    }

    /**
     * Update the specified program in storage.
     */
    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name'                => 'required|string|max:255',
            'description'         => 'nullable|string',
            'national_alignment'  => 'nullable|string|max:255',
            'focus_areas'         => 'nullable|string|max:255',
            'phases'              => 'nullable|string|max:255',
        ]);

        $program->update($request->all());

        return redirect()->route('programs.index')
                         ->with('success', 'Program updated successfully.');
    }

    /**
     * Remove the specified program from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')
                         ->with('success', 'Program deleted successfully.');
    }
}
