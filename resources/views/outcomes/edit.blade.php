@extends('layouts.app')

@section('title', 'Edit ' . $outcome->Title)

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Outcome: {{ $outcome->Title }}</h1>
    <form action="{{ route('outcomes.update', $outcome->OutcomeId) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">Title:
                <input type="text" name="Title" value="{{ $outcome->Title }}" class="border p-2 w-full" required>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Description:
                <textarea name="Description" class="border p-2 w-full">{{ $outcome->Description }}</textarea>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Artifact:
                <input type="file" name="artifact" class="border p-2 w-full">
                @if($outcome->ArtifactLink)
                    <span class="text-sm text-gray-600">Current: <a href="{{ $outcome->ArtifactLink }}" class="text-blue-500" target="_blank">View</a></span>
                @endif
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Type:
                <select name="OutcomeType" class="border p-2 w-full" required>
                    <option value="CAD" {{ $outcome->OutcomeType == 'CAD' ? 'selected' : '' }}>CAD</option>
                    <option value="PCB" {{ $outcome->OutcomeType == 'PCB' ? 'selected' : '' }}>PCB</option>
                    <option value="Prototype" {{ $outcome->OutcomeType == 'Prototype' ? 'selected' : '' }}>Prototype</option>
                    <option value="Report" {{ $outcome->OutcomeType == 'Report' ? 'selected' : '' }}>Report</option>
                    <option value="Business Plan" {{ $outcome->OutcomeType == 'Business Plan' ? 'selected' : '' }}>Business Plan</option>
                </select>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Quality Certification:
                <input type="text" name="QualityCertification" value="{{ $outcome->QualityCertification }}" class="border p-2 w-full">
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Commercialization Status:
                <select name="CommercializationStatus" class="border p-2 w-full">
                    <option value="Demoed" {{ $outcome->CommercializationStatus == 'Demoed' ? 'selected' : '' }}>Demoed</option>
                    <option value="Market Linked" {{ $outcome->CommercializationStatus == 'Market Linked' ? 'selected' : '' }}>Market Linked</option>
                    <option value="Launched" {{ $outcome->CommercializationStatus == 'Launched' ? 'selected' : '' }}>Launched</option>
                </select>
            </label>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Project:
                <select name="ProjectId" class="border p-2 w-full" required>
                    @foreach($projects as $project)
                        <option value="{{ $project->projectId }}" {{ $outcome->ProjectId == $project->projectId ? 'selected' : '' }}>{{ $project->title }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
    </form>
@endsection
