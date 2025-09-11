@extends('layouts.app')

@section('title', 'Create Outcome')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Create Outcome</h1>

    <form action="{{ route('outcomes.store') }}" method="POST" enctype="multipart/form-data" class="bg-white dark:bg-gray-800 p-6 rounded shadow-md">
        @csrf

        {{-- Outcome ID --}}
        <div class="mb-4">
            <label for="OutcomeId" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Outcome ID</label>
            <input type="text" name="OutcomeId" id="OutcomeId" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white" required>
        </div>

        {{-- Title --}}
        <div class="mb-4">
            <label for="Title" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Title</label>
            <input type="text" name="Title" id="Title" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white" required>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label for="Description" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Description</label>
            <textarea name="Description" id="Description" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white" rows="3"></textarea>
        </div>

        {{-- Artifact --}}
        <div class="mb-4">
            <label for="artifact" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Artifact</label>
            <input type="file" name="artifact" id="artifact" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white">
        </div>

        {{-- Outcome Type --}}
        <div class="mb-4">
            <label for="OutcomeType" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Type</label>
            <select name="OutcomeType" id="OutcomeType" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white" required>
                <option value="CAD">CAD</option>
                <option value="PCB">PCB</option>
                <option value="Prototype">Prototype</option>
                <option value="Report">Report</option>
                <option value="Business Plan">Business Plan</option>
            </select>
        </div>

        {{-- Quality Certification --}}
        <div class="mb-4">
            <label for="QualityCertification" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Quality Certification</label>
            <input type="text" name="QualityCertification" id="QualityCertification" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white">
        </div>

        {{-- Commercialization Status --}}
        <div class="mb-4">
            <label for="CommercializationStatus" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Commercialization Status</label>
            <select name="CommercializationStatus" id="CommercializationStatus" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white">
                <option value="Demoed">Demoed</option>
                <option value="Market Linked">Market Linked</option>
                <option value="Launched">Launched</option>
            </select>
        </div>

        {{-- Project --}}
        <div class="mb-4">
            <label for="ProjectId" class="block text-gray-700 dark:text-gray-200 font-medium mb-1">Project</label>
            <select name="ProjectId" id="ProjectId" class="border p-2 w-full rounded dark:bg-gray-700 dark:text-white" required>
                @foreach($projects as $project)
                    <option value="{{ $project->projectId }}">{{ $project->title }}</option>
                @endforeach
            </select>
        </div>

        {{-- Buttons --}}
        <div class="flex items-center space-x-4 mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium">Save</button>
            <a href="{{ route('outcomes.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded font-medium">Cancel</a>
        </div>
    </form>
</div>
@endsection
