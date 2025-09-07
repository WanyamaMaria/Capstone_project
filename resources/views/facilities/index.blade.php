@extends('layouts.app')
@section('title', 'Facilities')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@if(session('success'))
    <div id="success-message" class="success-message">
        
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Facilities</h1>
    <a href="{{ route('facilities.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Add Facility
    </a>
</div>

<form method="GET" action="{{ route('facilities.index') }}" class="mb-4 flex flex-wrap gap-2 items-center">
    <!-- Search -->
    <div class="flex items-center gap-2">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search anything…"
            class="border rounded px-3 py-2"
        >
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
    </div>

    <!-- Facility Type Filter -->
    <select name="facilityType" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Types</option>
        @foreach ($facilityTypes as $type)
            <option value="{{ $type }}" {{ request('facilityType') == $type ? 'selected' : '' }}>
                {{ $type }}
            </option>
        @endforeach
    </select>

    <!-- Partner Filter -->
    <select name="partnerOrganization" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Partners</option>
        @foreach ($partners as $partner)
            <option value="{{ $partner }}" {{ request('partnerOrganization') == $partner ? 'selected' : '' }}>
                {{ $partner }}
            </option>
        @endforeach
    </select>

    <!-- Capability Filter -->
    <select name="capability" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Capabilities</option>
        @foreach ($capabilities as $cap)
            <option value="{{ $cap }}" {{ request('capability') == $cap ? 'selected' : '' }}>
                {{ $cap }}
            </option>
        @endforeach
    </select>

    <!-- Reset -->
    <a href="{{ route('facilities.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <i class="fa-solid fa-rotate-left"></i> Reset
    </a>
</form>


<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Location</th>
            <th class="px-4 py-2 text-left">Partner</th>
            <th class="px-4 py-2 text-left">Type</th>
            <th class="px-4 py-2 text-left">Capabilities</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($facilities as $facility)
            <tr class="border-b">
                <td class="px-4 py-2">
                    <a href="{{ route('facilities.show', $facility) }}" class="text-blue-600 hover:underline">
                        {{ $facility->name }}
                    </a>
                </td>
                <td class="px-4 py-2">{{ $facility->location }}</td>
                <td class="px-4 py-2">{{ $facility->partnerOrganization }}</td>
                <td class="px-4 py-2">{{ $facility->facilityType }}</td>
                <td class="px-4 py-2">{{ $facility->capabilities}}
                   
                </td>
                <td class="px-4 py-2">
                    <div class="flex gap-3 items-center">
                        <a href="{{ route('facilities.edit', $facility) }}" class="text-blue-600 hover:underline inline-flex items-center gap-1">
                            Edit
                        </a>
                        <form action="{{ route('facilities.destroy', $facility) }}" method="POST" onsubmit="return confirm('Delete this facility?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline inline-flex items-center gap-1">
                             Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">No facilities found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if(method_exists($facilities, 'links'))
    <div class="mt-4">
        {{ $facilities->links() }}
    </div>
@endif

<script>
    setTimeout(() => {
        const flash = document.getElementById('success-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500);
        }
    }, 4000);
</script>
@endsection
