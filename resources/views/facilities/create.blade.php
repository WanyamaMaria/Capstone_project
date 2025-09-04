@extends('layouts.app')

@section('title', 'Create Facility')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded p-6">
    <h1 class="text-xl font-bold mb-4">Create a New Facility</h1>
    <form action="{{ route('facilities.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>
        <div class="mb-4">
            <label for="partnerOrganization" class="block text-sm font-medium text-gray-700">Partner Organization</label>
            <input type="text" name="partnerOrganization" id="partnerOrganization" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="facilityType" class="block text-sm font-medium text-gray-700">Facility Type</label>
            <input type="text" name="facilityType" id="facilityType" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>
        <div class="mb-4">
            <label for="capabilities" class="block text-sm font-medium text-gray-700">Capabilities</label>
            <textarea name="capabilities" id="capabilities" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"></textarea>
        </div>
        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Facility</button>
            <a href="{{ route('facilities.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>

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