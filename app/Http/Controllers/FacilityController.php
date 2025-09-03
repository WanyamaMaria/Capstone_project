<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Http\Requests\FacilityRequest;
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
     * Display the specified facility.
     */
    public function show(Facility $facility)
    {
        // Load related data
        $facility->load(['projects', 'services', 'equipment']);

        return view('facilities.show', compact('facility'));
    }

    /**
     * Show the form for editing the specified facility.
     */
    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified facility in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'partnerOrganization' => 'nullable|string',
            'facilityType' => 'nullable|string',
            'capabilities' => 'nullable|array',
        ]);

        $facility->update($validated);

        return redirect()->route('facilities.index')->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified facility from storage.
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

    /**
     * Get facilities for AJAX requests (for dropdowns in other forms)
     */
    public function ajax(Request $request)
    {
        $facilities = Facility::select('facility_id', 'name', 'location')
                             ->when($request->search, function($query, $search) {
                                 $query->search($search);
                             })
                             ->limit(10)
                             ->get();

        return response()->json($facilities);
    }
}
