@extends('layouts.app')
@section('title', 'Facilities')
@section('content')
@if(session('success'))
    <div id="success-message" class="   color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
    padding: 12px 18px;
    margin-bottom: 15px;
    font-weight: bold;
    text-align: center;
    opacity: 1;
    display: inline-block;
    max-width: 90%;
    width: 100%;
    transition: opacity 0.7s;">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Facilities</h1>
    <a href="{{ route('facilities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Facility</a>
</div>

<form method="GET" action="{{ route('facilities.index') }}" class="mb-4 flex flex-wrap gap-2">
    <!-- Search -->
    <input type="text" name="search" value="{{ request('search') }}" 
           placeholder="Search name or location..." 
           class="border rounded px-3 py-2">

    <!-- Facility Type Filter -->
    <select name="facilityType" class="border rounded px-3 py-2">
        <option value="">All Types</option>
        @foreach ($facilityTypes as $type)
            <option value="{{ $type }}" {{ request('facilityType') == $type ? 'selected' : '' }}>
                {{ $type }}
            </option>
        @endforeach
    </select>

    <!-- Partner Filter -->
    <select name="partnerOrganization" class="border rounded px-3 py-2">
        <option value="">All Partners</option>
        @foreach ($partners as $partner)
            <option value="{{ $partner }}" {{ request('partnerOrganization') == $partner ? 'selected' : '' }}>
                {{ $partner }}
            </option>
        @endforeach
    </select>

    <!-- Capability Filter -->
    <select name="capability" class="border rounded px-3 py-2">
        <option value="">All Capabilities</option>
        @foreach ($capabilities as $cap)
            <option value="{{ $cap }}" {{ request('capability') == $cap ? 'selected' : '' }}>
                {{ $cap }}
            </option>
        @endforeach
    </select>

    <!-- Submit -->
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Filter</button>

    <!-- Reset -->
    <a href="{{ route('facilities.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Reset</a>
</form>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Location</th>

            <th class="px-4 py-2">PartnerOrganization</th>
            <th class="px-4 py-2">FacilityType</th>
            <th class="px-4 py-2">Capabilities</th>
    
            <th class="px-4 py-2">Actions</th>


           
        </tr>
    </thead>
    <tbody>
        @foreach($facilities as $facility)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $facility->name }}</td>
            <td class="px-4 py-2">{{ $facility->location }}</td>
            <td class="px-4 py-2">{{$facility->partnerOrganization}}</td>
            <td class="px-4 py-2">{{ $facility->facilityType }}</td> 
           <td class="px-4 py-2">{{ $facility->capabilities }} </td>
            
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('facilities.edit', $facility) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('facilities.destroy', $facility) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    // Wait 4 seconds, then fade out the message
    setTimeout(() => {
        const flash = document.getElementById('success-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500); // Remove from DOM after fade
        }
    }, 4000); // 4 seconds
</script>
@endsection
