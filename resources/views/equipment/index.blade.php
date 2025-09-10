@extends('layouts.app')

@section('title', 'Equipment')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-7xl mx-auto px-2 py-2">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Equipment</h1>
        <a href="{{ route('equipment.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-plus mr-1"></i> Add New Equipment
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-blue-800 bg-blue-100 border border-blue-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" action="{{ route('equipment.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search equipment…" class="border rounded px-4 py-2 w-64 focus:ring-blue-500 focus:border-blue-500">

        <select name="facility_id" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Facilities</option>
            @foreach ($facilities as $id => $name)
                <option value="{{ $id }}" {{ request('facility_id') == $id ? 'selected' : '' }}>
                    {{ $name }}
                </option>
            @endforeach
        </select>

        <select name="usageDomain" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Domains</option>
            @foreach ($domains as $domain)
                <option value="{{ $domain }}" {{ request('usageDomain') == $domain ? 'selected' : '' }}>
                    {{ $domain }}
                </option>
            @endforeach
        </select>

        <select name="supportPhase" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Phases</option>
            @foreach ($phases as $phase)
                <option value="{{ $phase }}" {{ request('supportPhase') == $phase ? 'selected' : '' }}>
                    {{ $phase }}
                </option>
            @endforeach
        </select>

        <a href="{{ route('equipment.index') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-rotate-left mr-1"></i> Reset
        </a>
    </form>

    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        @if($equipment->count() > 0)
            <div class="min-w-full">
                <table class="w-full divide-y divide-blue-200">
                    <thead class="bg-blue-100 text-blue-800 uppercase text-sm font-bold">
                        <tr>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-tag mr-1 text-blue-600"></i> Name
                            </th>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-building mr-1 text-blue-600"></i> Facility
                            </th>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-layer-group mr-1 text-blue-600"></i> Usage Domain
                            </th>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-chart-line mr-1 text-blue-600"></i> Support Phase
                            </th>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-cogs mr-1 text-blue-600"></i> Capabilities
                            </th>
                            <th class="px-4 py-2 text-left">
                                <i class="fa-solid fa-eye mr-1 text-blue-600"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-blue-100">
                        @foreach($equipment as $item)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-4 py-2">{{ $item->name }}</td>
                                <td class="px-4 py-2">{{ $item->facility->name ?? '—' }}</td>
                                <td class="px-4 py-2">{{ $item->usageDomain }}</td>
                                <td class="px-4 py-2">{{ $item->supportPhase }}</td>
                                <td class="px-4 py-2 whitespace-normal break-words max-w-xs">
                                    {{ Str::limit($item->capabilities, 100) }}
                                    @if(strlen($item->capabilities) > 100)
                                        <span class="text-blue-600 hover:underline cursor-pointer" onclick="openQuickView({{ $item->toJson() }})">Read more</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 flex gap-2">
                                    <button onclick="openQuickView({{ $item->toJson() }})" class="text-blue-600 hover:underline">
                                        <i class="fa-solid fa-eye mr-1"></i> View
                                    </button>
                                    <a href="{{ route('equipment.edit', $item) }}" class="text-green-600 hover:underline">
                                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('equipment.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this equipment?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            <i class="fa-solid fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-4">
                {{ $equipment->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                No equipment found. <a href="{{ route('equipment.create') }}" class="text-blue-600 hover:underline">Add a new equipment</a>.
            </div>
        @endif
    </div>
</div>

<!-- Quick View Modal -->
<div id="quickViewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <button onclick="closeQuickView()" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>
        <h2 class="text-xl font-bold mb-4 text-gray-900">Equipment Details</h2>
        <div id="quickViewContent" class="space-y-2 text-gray-700 text-sm whitespace-normal break-words"></div>
    </div>
</div>

<script>
    function openQuickView(data) {
        const modal = document.getElementById('quickViewModal');
        const content = document.getElementById('quickViewContent');
        content.innerHTML = `
            <p><strong>Name:</strong> ${data.name}</p>
            <p><strong>Facility:</strong> ${data.facility?.name ?? '—'}</p>
            <p><strong>Usage Domain:</strong> ${data.usageDomain}</p>
            <p><strong>Support Phase:</strong> ${data.supportPhase}</p>
            <p><strong>Capabilities:</strong> ${data.capabilities}</p>
            <p><strong>Description:</strong> ${data.description}</p>
            <p><strong>Inventory Code:</strong> ${data.inventoryCode}</p>
            <p><strong>Equipment ID:</strong> ${data.equipmentId}</p>
        `;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeQuickView() {
        const modal = document.getElementById('quickViewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection
