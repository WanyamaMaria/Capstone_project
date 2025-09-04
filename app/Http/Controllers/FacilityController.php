<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the facilities.
     */
    // public function index()
    // {
    //     $facilities = Facility::all();
    //     return view('facilities.index', compact('facilities'));
    // }
public function index(Request $request)
{
    $query = Facility::query();

    // Search by name or location
    if ($request->filled('search')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('location', 'like', '%' . $request->search . '%');
        });
    }

    // Filter by facility type
    if ($request->filled('facilityType')) {
        $query->where('facilityType', $request->facilityType);
    }

    // Filter by partner
    if ($request->filled('partnerOrganization')) {
        $query->where('partnerOrganization', $request->partnerOrganization);
    }

    // Filter by capability (assuming capabilities stored as plain string or JSON)
    if ($request->filled('capability')) {
        $query->where('capabilities', 'like', '%' . $request->capability . '%');
    }

    $facilities = $query->latest()->paginate(10);

    // Pass filter options to view
    $facilityTypes = Facility::select('facilityType')->distinct()->pluck('facilityType');
    $partners = Facility::select('partnerOrganization')->distinct()->pluck('partnerOrganization');
    $capabilities = Facility::select('capabilities')->distinct()->pluck('capabilities');

    return view('facilities.index', compact('facilities', 'facilityTypes', 'partners', 'capabilities'));
}

    /**
     * Show the form for creating a new facility.
     */
    public function create()
    {
        return view('facilities.create');
    }

    /**
     * Store a newly created facility in storage.
     */
 

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|nullable|string',
        'partnerOrganization' => 'required|nullable|string|max:255',
        'facilityType' => 'required|nullable|string|max:255',
        'capabilities' => 'required|nullable|string|max:255',
    ]);

    // Generate unique facility_id (consider soft-deleted)
    $lastFacility = Facility::withTrashed()->latest('id')->first();
    $newNumber = $lastFacility ? $lastFacility->id + 1 : 1;
    $facilityId = 'FAC-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

    $facility = Facility::create([
        'name' => $request->name,
        'location' => $request->location,
        'description' => $request->description,
        'partnerOrganization' => $request->partnerOrganization,
        'facilityType' => $request->facilityType,
        'capabilities' => $request->capabilities,
        'facility_id' => $facilityId,
    ]);

    return redirect()->route('facilities.index')
                     ->with('success', 'Facility created successfully.');
}

    /**
     * Display the specified facility.
     */
    public function show(Facility $facility)
    {
        return view('facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified facility.
     */
    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified facility in storage.
     */
   public function update(Request $request, Facility $facility)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'nullable|string',
        'partnerOrganization' => 'nullable|string|max:255',
        'facilityType' => 'nullable|string|max:255',
        'capabilities' => 'nullable|string',
    ]);

    $facility->update([
        'name' => $request->name,
        'location' => $request->location,
        'description' => $request->description,
        'partnerOrganization' => $request->partnerOrganization,
        'facilityType' => $request->facilityType,
        'capabilities' => $request->capabilities,
    ]);

    return redirect()->route('facilities.index')
                     ->with('success', 'Facility updated successfully!');
}


    /**
     * Remove the specified facility from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')->with('success', 'Facility deleted successfully.');
    }
}
