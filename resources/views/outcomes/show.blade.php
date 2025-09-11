@extends('layouts.app')

@section('title', $outcome->Title)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $outcome->Title }}</h1>

    <p class="mb-2"><strong>Description:</strong> {{ $outcome->Description }}</p>
    <p class="mb-2"><strong>Type:</strong> {{ $outcome->OutcomeType }}</p>
    <p class="mb-2"><strong>Certification:</strong> {{ $outcome->QualityCertification }}</p>
    <p class="mb-2"><strong>Status:</strong> {{ $outcome->CommercializationStatus }}</p>

    @if($outcome->ArtifactLink)
        <p class="mb-2">
            <strong>Artifact:</strong>
            <a href="{{ $outcome->ArtifactLink }}" class="text-blue-500" download>Download Artifact</a>
        </p>
    @endif

    <p class="mb-2"><strong>Project:</strong> {{ $outcome->project ? $outcome->project->title : 'N/A' }}</p>

    <a href="{{ route('outcomes.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
@endsection
