<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index() {
    $facilities = Facility::all();
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
   

    /**
     * Display the specified resource.
     */
    public function show(Facility $facility)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        //
    }
}
