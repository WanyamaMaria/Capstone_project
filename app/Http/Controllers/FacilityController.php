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

    // 🔍 Full-text search across multiple fields
    if ($search = trim((string) $request->get('search'))) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%")
              ->orWhere('partnerOrganization', 'like', "%{$search}%")
              ->orWhere('facilityType', 'like', "%{$search}%")
              ->orWhere('capabilities', 'like', "%{$search}%");
        });
    }

    // 🎯 Dropdown filters (still supported)
    if ($type = $request->get('facilityType')) {
        $query->where('facilityType', $type);
    }

    if ($partner = $request->get('partnerOrganization')) {
        $query->where('partnerOrganization', $partner);
    }

   if ($cap = $request->get('capability')) {
    $query->where('capabilities', 'like', "%{$cap}%");
}


    $facilities = $query->orderBy('name')->paginate(10)->withQueryString();

    $facilityTypes = Facility::whereNotNull('facilityType')->distinct()->pluck('facilityType');
    $partners      = Facility::whereNotNull('partnerOrganization')->distinct()->pluck('partnerOrganization');
    $capabilities  = Facility::whereNotNull('capabilities')->pluck('capabilities')
        ->flatMap(fn($c) => is_array($c) ? $c : preg_split('/\s*[,;]\s*/', (string) $c, -1, PREG_SPLIT_NO_EMPTY))
        ->unique()->values();

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
   $lastFacility = Facility::withTrashed()->latest('facility_id')->first();

        if ($lastFacility) {
            // Extract the numeric part from the facility_id, e.g., FAC-0001
            $lastNumber = (int) str_replace('FAC-', '', $lastFacility->facility_id);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

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
        $services = $facility->services; // Fetch services linked to the facility
        $equipment = $facility->equipment; // Fetch equipment linked to the facility
        $projects = $facility->projects; // Fetch projects linked to the facility

        return view('facilities.show', compact('facility', 'services', 'equipment', 'projects'));
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
