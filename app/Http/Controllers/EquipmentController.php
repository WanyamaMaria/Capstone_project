<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Facility;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipment::query();

        if ($search = trim((string) $request->get('search'))) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('capabilities', 'like', "%{$search}%")
                  ->orWhere('inventoryCode', 'like', "%{$search}%")
                  ->orWhere('usageDomain', 'like', "%{$search}%")
                  ->orWhere('supportPhase', 'like', "%{$search}%");
            });
        }

        if ($domain = $request->get('usageDomain')) {
            $query->where('usageDomain', $domain);
        }

        if ($phase = $request->get('supportPhase')) {
            $query->where('supportPhase', $phase);
        }

        if ($facilityId = $request->get('facility_id')) {
            $query->where('facility_id', $facilityId);
        }

        $equipment = $query->orderBy('name')->paginate(10)->withQueryString();

        $domains = Equipment::whereNotNull('usageDomain')->distinct()->pluck('usageDomain');
        $phases = Equipment::whereNotNull('supportPhase')->distinct()->pluck('supportPhase');
        $facilities = Facility::orderBy('name')->pluck('name', 'id');

        return view('equipment.index', compact('equipment', 'domains', 'phases', 'facilities'));
    }

    public function create()
    {
        $facilities = Facility::orderBy('name')->pluck('name', 'id');
        return view('equipment.create', compact('facilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'name' => 'required|string|max:255',
            'capabilities' => 'nullable|string',
            'description' => 'nullable|string',
            'inventoryCode' => 'nullable|string|max:255|unique:equipment',
            'usageDomain' => 'nullable|string|max:255',
            'supportPhase' => 'nullable|string|max:255',
        ]);

        $lastItem = Equipment::withTrashed()->latest('id')->first();
        $newNumber = $lastItem ? $lastItem->id + 1 : 1;
        $equipmentId = 'EQP-' . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        Equipment::create([
            'equipmentId' => $equipmentId,
            'facility_id' => $request->facility_id,
            'name' => $request->name,
            'capabilities' => $request->capabilities,
            'description' => $request->description,
            'inventoryCode' => $request->inventoryCode,
            'usageDomain' => $request->usageDomain,
            'supportPhase' => $request->supportPhase,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment registered successfully.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        $facilities = Facility::orderBy('name')->pluck('name', 'id');
        return view('equipment.edit', compact('equipment', 'facilities'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $request->validate([
            'facility_id' => 'required|exists:facilities,id',
            'name' => 'required|string|max:255',
            'capabilities' => 'nullable|string',
            'description' => 'nullable|string',
            'inventoryCode' => 'nullable|string|max:255|unique:equipment,inventoryCode,' . $equipment->id,
            'usageDomain' => 'nullable|string|max:255',
            'supportPhase' => 'nullable|string|max:255',
        ]);

        $equipment->update([
            'facility_id' => $request->facility_id,
            'name' => $request->name,
            'capabilities' => $request->capabilities,
            'description' => $request->description,
            'inventoryCode' => $request->inventoryCode,
            'usageDomain' => $request->usageDomain,
            'supportPhase' => $request->supportPhase,
        ]);

        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();
        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
    }
}
