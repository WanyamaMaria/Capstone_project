@extends('layouts.app')

@section('title', $outcome->title)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $outcome->title }}</h1>
    <p class="mb-2"><strong>Description:</strong> {{ $outcome->description }}</p>
    <p class="mb-2"><strong>Type:</strong> {{ $outcome->outcome_type }}</p>
    <p class="mb-2"><strong>Certification:</strong> {{ $outcome->quality_certification }}</p>
    <p class="mb-2"><strong>Status:</strong> {{ $outcome->commercialization_status }}</p>
    @if($outcome->artifact_link)
        <a href="{{ $outcome->artifact_link }}" class="text-blue-500" download>Download Artifact</a>
    @endif
    <a href="{{ route('outcomes.index') }}" class="mt-4 inline-block bg-gray-500 text-white px-4 py-2 rounded">Back</a>
@endsection
