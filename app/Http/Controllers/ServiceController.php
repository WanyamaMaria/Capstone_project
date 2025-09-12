<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Facility;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('facility')->paginate(10);
        return view('services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::all();
        return view('services.create', compact('facilities'));
         return redirect()->route('services.index')
                     ->with('success', 'Service created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,facility_id',
            'category' => 'nullable|string|max:255',
            'skill_type' => 'nullable|string|max:255',

        ]);
        
    
        
        $lastItem = Service::withTrashed()->latest('service_id')->first();
        $lastNumber = $lastItem ? intval(substr($lastItem->service_id, 4)) : 0;
        $service_id = 'SER-' . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);

Service::create([
    'service_id' => $service_id,
    'name' => $request->name,
    'description' => $request->description,
    'facility_id' => $request->facility_id,
    'category' => $request->category,
    'skill_type' => $request->skill_type,
]);
    return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load('facility');
        return view('services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $facilities = Facility::all();
        return view('services.edit', compact('service', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,facility_id',
            'category' => 'nullable|string|max:255',
            'skill_type' => 'nullable|string|max:255',

        ]);

        $service->update($validated);

        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully.');
    }
}
