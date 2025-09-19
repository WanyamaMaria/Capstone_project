@extends('layouts.app')

@section('title', 'Add Participant')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Add New Participant</h1>

    <form action="{{ route('participants.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf

        @foreach(['full_name' => 'Full Name','email' => 'Email','affiliation' => 'Affiliation','specialization' => 'Specialization','institution' => 'Institution'] as $field => $label)
            <div class="mb-4">
                <label for="{{ $field }}" class="block font-medium mb-1">{{ $label }}</label>
                <input type="text" name="{{ $field }}" id="{{ $field }}" class="w-full border px-3 py-2 rounded" required>
            </div>
        @endforeach

        <div class="mb-4">
            <label for="cross_skill_trained" class="block font-medium mb-1">Cross-Skill Trained</label>
            <select name="cross_skill_trained" id="cross_skill_trained" class="w-full border px-3 py-2 rounded">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="projects" class="block font-medium mb-1">Assign to Projects</label>
            <select name="projects[]" id="projects" class="w-full border px-3 py-2 rounded" multiple>
                @foreach($projects as $project)
                    <option value="{{ $project->project_id }}">{{ $project->title }}</option>
                @endforeach
            </select>
            <p class="text-sm text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple projects.</p>
        </div>

        <div class="flex items-center space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('participants.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
