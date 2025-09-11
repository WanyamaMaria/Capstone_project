@extends('layouts.app')

@section('title', 'Add Participant')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Add New Participant</h1>

    <form action="{{ route('participants.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
        @csrf

        @foreach([
            'fullName' => 'Full Name',
            'email' => 'Email',
            'affiliation' => 'Affiliation',
            'specialization' => 'Specialization',
            'institution' => 'Institution'
        ] as $field => $label)
            <div class="mb-4">
                <label for="{{ $field }}" class="block font-medium mb-1">{{ $label }}</label>
                <input type="text" name="{{ $field }}" id="{{ $field }}" class="w-full border px-3 py-2 rounded dark:bg-gray-700 dark:text-white" required>
            </div>
        @endforeach

        <div class="mb-4">
            <label for="crossSkillTrained" class="block font-medium mb-1">Cross-Skill Trained</label>
            <select name="crossSkillTrained" id="crossSkillTrained" class="w-full border px-3 py-2 rounded dark:bg-gray-700 dark:text-white">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="project_id" class="block font-medium mb-1">Assign to Project</label>
            <select name="project_id" id="project_id" class="w-full border px-3 py-2 rounded dark:bg-gray-700 dark:text-white">
                <option value="">None</option>
                @foreach($projects as $project)
                    <option value="{{ $project->projectId }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('participants.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Cancel</a>
        </div>
    </form>
</div>
@endsection
