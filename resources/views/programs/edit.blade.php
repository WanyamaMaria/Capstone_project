@extends('layouts.app')

@section('title', 'Edit Program')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded p-6">
    <h1 class="text-xl font-bold mb-4">Edit Program</h1>
    <form action="{{ route('programs.update', $program->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" name="name" id="name" 
                   value="{{ old('name', $program->name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <input type="text" name="description" id="description" 
                   value="{{ old('description', $program->description) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div class="mb-4">
            <label for="national_alignment" class="block text-sm font-medium text-gray-700">National Alignment</label>
            <textarea name="national_alignment" id="national_alignment" rows="4" 
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('national_alignment', $program->national_alignment) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="phases" class="block text-sm font-medium text-gray-700">Phases</label>
            <input type="text" name="phases" id="phases" 
                   value="{{ old('phases', $program->phases) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="mb-4">
            <label for="focus_areas" class="block text-sm font-medium text-gray-700">Focus Areas</label>
            <input type="text" name="focus_areas" id="focus_areas" 
                   value="{{ old('focus_areas', $program->focus_areas) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <div class="flex justify-end gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Program</button>
            <a href="{{ route('programs.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Auto-hide flash message
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
