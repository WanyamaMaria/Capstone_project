@extends('layouts.app')

@section('title', 'Edit Service')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Service</h1>
    <form action="{{ route('services.update', $service) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="name" class="block font-medium mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $service->name) }}"
                   class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block font-medium mb-1">Description</label>
            <textarea name="description" id="description" rows="3"
                      class="w-full border border-gray-300 rounded px-3 py-2">{{ old('description', $service->description) }}</textarea>
            @error('description')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-4">
            <label for="facility_id" class="block font-medium mb-1">Facility</label>
            <select name="facility_id" id="facility_id" class="w-full border border-gray-300 rounded px-3 py-2" required>
                <option value="">Select Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}" {{ old('facility_id', $service->facility_id) == $facility->id ? 'selected' : '' }}>
                        {{ $facility->name }}
                    </option>
                @endforeach
            </select>
            @error('facility_id')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium">Update Service</button>
        <a href="{{ route('services.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
    </form>
</div>
@endsection
