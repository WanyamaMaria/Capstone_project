@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Create New Project</h1>
    <form action="{{ route('projects.store') }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        @csrf

        {{-- Title --}}
        <div class="mb-4">
            <label for="title" class="block font-medium mb-1">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2" required>
            @error('title')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Project Overview --}}
        <div class="mb-4">
            <label for="project_overview" class="block font-medium mb-1">Project Overview</label>
            <textarea name="project_overview" id="project_overview" rows="3"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2">{{ old('project_overview') }}</textarea>
            @error('project_overview')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Nature of Project --}}
        <div class="mb-4">
            <label for="nature_of_project" class="block font-medium mb-1">Nature of Project</label>
            <select name="nature_of_project" id="nature_of_project"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2" required>
                <option value="">Select Nature</option>
                @foreach(['Research', 'Prototype', 'Applied Work'] as $nature)
                    <option value="{{ $nature }}" {{ old('nature_of_project') == $nature ? 'selected' : '' }}>
                        {{ $nature }}
                    </option>
                @endforeach
            </select>
            @error('nature_of_project')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Innovation Focus --}}
        <div class="mb-4">
            <label for="innovation_focus" class="block font-medium mb-1">Innovation Focus</label>
            <input type="text" name="innovation_focus" id="innovation_focus" value="{{ old('innovation_focus') }}"
                   class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2">
            @error('innovation_focus')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Prototype Stage --}}
        <div class="mb-4">
            <label for="prototype_stage" class="block font-medium mb-1">Prototype Stage</label>
            <select name="prototype_stage" id="prototype_stage"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2" required>
                <option value="">Select Stage</option>
                @foreach(['Concept', 'Prototype', 'MVP', 'Market Launch'] as $stage)
                    <option value="{{ $stage }}" {{ old('prototype_stage') == $stage ? 'selected' : '' }}>
                        {{ $stage }}
                    </option>
                @endforeach
            </select>
            @error('prototype_stage')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Testing Requirements --}}
        <div class="mb-4">
            <label for="testing_requirements" class="block font-medium mb-1">Testing Requirements</label>
            <textarea name="testing_requirements" id="testing_requirements" rows="2"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2">{{ old('testing_requirements') }}</textarea>
            @error('testing_requirements')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Commercialization Plan --}}
        <div class="mb-4">
            <label for="commercialization_plan" class="block font-medium mb-1">Commercialization Plan</label>
            <textarea name="commercialization_plan" id="commercialization_plan" rows="2"
                      class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2">{{ old('commercialization_plan') }}</textarea>
            @error('commercialization_plan')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Facility --}}
        <div class="mb-4">
            <label for="facility_id" class="block font-medium mb-1">Facility</label>
            <select name="facility_id" id="facility_id"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2" required>
                <option value="">Select Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->facility_id }}" {{ old('facility_id') == $facility->facility_id ? 'selected' : '' }}>
                        {{ $facility->name }}
                    </option>
                @endforeach
            </select>
            @error('facility_id')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Program --}}
        <div class="mb-4">
            <label for="program_id" class="block font-medium mb-1">Program</label>
            <select name="program_id" id="program_id"
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2" required>
                <option value="">Select Program</option>
                @foreach($programs as $program)
                    <option value="{{ $program->program_id }}" {{ old('program_id') == $program->program_id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
            @error('program_id')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        {{-- Submit --}}
        <div class="flex items-center mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-medium">Create Project</button>
            <a href="{{ route('projects.index') }}" class="ml-4 text-gray-600 dark:text-gray-300 hover:underline">Cancel</a>
        </div>
    </form>
</div>
@endsection
