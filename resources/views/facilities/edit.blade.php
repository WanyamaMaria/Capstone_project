@extends('layouts.app')

@section('title', 'Edit Facility')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-lg rounded-xl p-6">
    <h1 class="text-2xl font-bold mb-6 text-blue-700">Edit Facility</h1>

    <form action="{{ route('facilities.update', $facility) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $facility->name) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
        </div>

        <!-- Location -->
        <div class="mb-5">
            <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $facility->location) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2" required>
        </div>

        <!-- Description -->
        <div class="mb-5">
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">{{ old('description', $facility->description) }}</textarea>
        </div>

        <!-- Partner Organization -->
        <div class="mb-5">
            <label for="partnerOrganization" class="block text-sm font-medium text-gray-700 mb-1">Partner Organization</label>
            <input type="text" name="partnerOrganization" id="partnerOrganization"
                   value="{{ old('partnerOrganization', $facility->partnerOrganization) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
        </div>

        <!-- Facility Type -->
        <div class="mb-5">
            <label for="facilityType" class="block text-sm font-medium text-gray-700 mb-1">Facility Type</label>
            <input type="text" name="facilityType" id="facilityType"
                   value="{{ old('facilityType', $facility->facilityType) }}"
                   class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">
        </div>

        <!-- Capabilities -->
        <div class="mb-6">
            <label for="capabilities" class="block text-sm font-medium text-gray-700 mb-1">Capabilities</label>
            <textarea name="capabilities" id="capabilities" rows="4"
                      class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 px-3 py-2">{{ old('capabilities', $facility->capabilities) }}</textarea>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3">
            <a href="{{ route('facilities.index') }}"
               class="bg-gray-400 hover:bg-gray-500 text-white font-medium px-4 py-2 rounded-lg shadow">
                Cancel
            </a>
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded-lg shadow">
                Update Facility
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
