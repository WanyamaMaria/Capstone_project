<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Http\Requests\FacilityRequest;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index() {
    $facilities = Facility::all();
    $query = Facility::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%');
    }

    if ($request->filled('facilityType')) {
        $query->where('facilityType', $request->facilityType);
    }

    $facilities = $query->get();
    return view('facilities.index', compact('facilities'));
}

public function create() {
    return view('facilities.create');
}

public function store(Request $request) {
    $request->validate([
        'name' => 'required',
        'location' => 'required',
        'description' => 'required',
        'partnerOrganization' => 'required',
        'facilityType' => 'required',
        'capabilities' => 'required',   

    ]);
    Facility::create($request->all());
    return redirect()->route('facilities.index');
}


    /**
     * Store a newly created resource in storage.
     */
    public function store(FacilityRequest $request)
    {
        Facility::create($request->validated());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        // Load related data
        $facility->load(['projects', 'services', 'equipment']);

        return view('facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $facility->update($request->validated());

        return redirect()->route('facilities.index')
            ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        if ($facility->projects()->exists() ||
            $facility->services()->exists() ||
            $facility->equipment()->exists()) {
            return back()->withErrors('Cannot delete facility with linked projects, services, or equipment.');
        }

        $facility->delete();

        return redirect()->route('facilities.index')
            ->with('success', 'Facility deleted successfully.');
    }
}
