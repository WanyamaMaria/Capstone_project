@extends('layouts.app')

@section('title', 'Edit Equipment')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Edit Equipment</h1>

    <form action="{{ route('equipment.update', $equipment) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Facility -->
        <div class="mb-5">
            <label for="facility_id" class="block text-sm font-medium text-gray-700 mb-1">Facility</label>
            <select name="facility_id" id="facility_id"
                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
                <option value="">-- Select Facility --</option>
                @foreach($facilities as $id => $name)
                    <option value="{{ $id }}" {{ old('facility_id', $equipment->facility_id) == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
            @error('facility_id') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $equipment->name) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
            @error('name') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Capabilities -->
        <div class="mb-5">
            <label for="capabilities" class="block text-sm font-medium text-gray-700 mb-1">Capabilities</label>
            <textarea name="capabilities" id="capabilities" rows="3"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">{{ old('capabilities', $equipment->capabilities) }}</textarea>
            @error('capabilities') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Description -->
        <div class="mb-5">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">{{ old('description', $equipment->description) }}</textarea>
            @error('description') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Inventory Code -->
        <div class="mb-5">
            <label for="inventoryCode" class="block text-sm font-medium text-gray-700 mb-1">Inventory Code</label>
            <input type="text" name="inventoryCode" id="inventoryCode"
                   value="{{ old('inventoryCode', $equipment->inventoryCode) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            @error('inventoryCode') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Usage Domain -->
        <div class="mb-5">
            <label for="usageDomain" class="block text-sm font-medium text-gray-700 mb-1">Usage Domain</label>
            <input type="text" name="usageDomain" id="usageDomain"
                   value="{{ old('usageDomain', $equipment->usageDomain) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            @error('usageDomain') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Support Phase -->
        <div class="mb-6">
            <label for="supportPhase" class="block text-sm font-medium text-gray-700 mb-1">Support Phase</label>
            <input type="text" name="supportPhase" id="supportPhase"
                   value="{{ old('supportPhase', $equipment->supportPhase) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
            @error('supportPhase') <div class="error text-red-600">{{ $message }}</div> @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('equipment.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white font-medium px-4 py-2 rounded-lg shadow">
                Cancel
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow">
                Update Equipment
            </button>
        </div>
    </form>
</div>

<script>
    // Auto-fade flash messages
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
