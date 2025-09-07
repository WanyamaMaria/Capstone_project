@extends('layouts.app')

@section('title', 'Edit ' . $outcome->title)

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Outcome: {{ $outcome->title }}</h1>
    <form action="{{ route('outcomes.update', $outcome->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700">Title: <input type="text" name="title" value="{{ $outcome->title }}" class="border p-2 w-full" required></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description: <textarea name="description" class="border p-2 w-full">{{ $outcome->description }}</textarea></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Artifact: <input type="file" name="artifact" class="border p-2 w-full"> (Current: <a href="{{ $outcome->artifact_link }}" class="text-blue-500">View</a>)</label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Type: 
                <select name="outcome_type" class="border p-2 w-full" required>
                    <option value="CAD" {{ $outcome->outcome_type == 'CAD' ? 'selected' : '' }}>CAD</option>
                    <option value="PCB" {{ $outcome->outcome_type == 'PCB' ? 'selected' : '' }}>PCB</option>
                    <option value="Prototype" {{ $outcome->outcome_type == 'Prototype' ? 'selected' : '' }}>Prototype</option>
                    <option value="Report" {{ $outcome->outcome_type == 'Report' ? 'selected' : '' }}>Report</option>
                    <option value="Business Plan" {{ $outcome->outcome_type == 'Business Plan' ? 'selected' : '' }}>Business Plan</option>
                </select>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Quality Certification: <input type="text" name="quality_certification" value="{{ $outcome->quality_certification }}" class="border p-2 w-full"></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Commercialization Status: 
                <select name="commercialization_status" class="border p-2 w-full">
                    <option value="Demoed" {{ $outcome->commercialization_status == 'Demoed' ? 'selected' : '' }}>Demoed</option>
                    <option value="Market Linked" {{ $outcome->commercialization_status == 'Market Linked' ? 'selected' : '' }}>Market Linked</option>
                    <option value="Launched" {{ $outcome->commercialization_status == 'Launched' ? 'selected' : '' }}>Launched</option>
                </select>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Project: 
                <select name="project_id" class="border p-2 w-full" required>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $outcome->project_id == $project->id ? 'selected' : '' }}>{{ $project->title }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection
