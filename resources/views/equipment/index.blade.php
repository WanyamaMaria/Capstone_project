@extends('layouts.app')
@section('title', 'Equipment')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@if(session('success'))
    <div id="success-message" class="success-message">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Equipment</h1>
    <a href="{{ route('equipment.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Add Equipment
    </a>
</div>

<form method="GET" action="{{ route('equipment.index') }}" class="mb-4 flex flex-wrap gap-2 items-center">
    <!-- Search -->
    <div class="flex items-center gap-2">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search equipment…"
            class="border rounded px-3 py-2"
        >
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center gap-2">
            <i class="fa-solid fa-magnifying-glass"></i> Search
        </button>
    </div>

    <!-- Facility Filter -->
    <select name="facility_id" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Facilities</option>
        @foreach ($facilities as $id => $name)
            <option value="{{ $id }}" {{ request('facility_id') == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>

    <!-- Usage Domain Filter -->
    <select name="usageDomain" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Domains</option>
        @foreach ($domains as $domain)
            <option value="{{ $domain }}" {{ request('usageDomain') == $domain ? 'selected' : '' }}>
                {{ $domain }}
            </option>
        @endforeach
    </select>

    <!-- Support Phase Filter -->
    <select name="supportPhase" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">All Phases</option>
        @foreach ($phases as $phase)
            <option value="{{ $phase }}" {{ request('supportPhase') == $phase ? 'selected' : '' }}>
                {{ $phase }}
            </option>
        @endforeach
    </select>

    <!-- Reset -->
    <a href="{{ route('equipment.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <i class="fa-solid fa-rotate-left"></i> Reset
    </a>
</form>

<table class="w-full bg-white shadow rounded overflow-hidden">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Facility</th>
            <th class="px-4 py-2 text-left">Domain</th>
            <th class="px-4 py-2 text-left">Support Phase</th>
            <th class="px-4 py-2 text-left">Capabilities</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($equipment as $item)
            <tr class="border-b">
                <td class="px-4 py-2">{{ $item->name }}</td>
                <td class="px-4 py-2">{{ $item->facility->name ?? '—' }}</td>
                <td class="px-4 py-2">{{ $item->usageDomain }}</td>
                <td class="px-4 py-2">{{ $item->supportPhase }}</td>
                <td class="px-4 py-2">{{ $item->capabilities }}</td>
                <td class="px-4 py-2">
                    <div class="flex gap-3 items-center">
                        <a href="{{ route('equipment.edit', $item) }}" class="text-blue-600 hover:underline inline-flex items-center gap-1">
                            Edit
                        </a>
                        <form action="{{ route('equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this equipment?');">
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
                <td colspan="6" class="px-4 py-6 text-center text-gray-500">No equipment found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@if(method_exists($equipment, 'links'))
    <div class="mt-4">
        {{ $equipment->links() }}
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
