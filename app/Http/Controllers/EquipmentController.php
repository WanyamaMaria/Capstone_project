<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::with('facility')->get();
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        $facilities = Facility::all();
        return view('equipment.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capabilities' => 'nullable|string',
            'inventoryCode' => 'required|string|unique:equipment',
            'usageDomain' => 'nullable|string',
            'supportPhase' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,id'
        ]);

        Equipment::create($validated);
        return redirect()->route('equipment.index')->with('success', 'Equipment added successfully.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $facilities = Facility::all();
        return view('equipment.edit', compact('equipment', 'facilities'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'capabilities' => 'nullable|string',
            'inventoryCode' => 'required|string|unique:equipment,inventoryCode,' . $equipment->id,
            'usageDomain' => 'nullable|string',
            'supportPhase' => 'nullable|string',
            'facility_id' => 'required|exists:facilities,id'
        ]);

        $equipment->update($validated);
        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted.');
    }
}
