@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $project->name }}</h1>
    <div class="mb-2">
        <strong>Description:</strong>
        <p>{{ $project->description }}</p>
    </div>
    <div class="mb-2">
        <strong>Facility:</strong>
        <span>{{ $project->facility->name ?? 'N/A' }}</span>
    </div>
    <div class="mb-2">
        <strong>Program:</strong>
        <span>{{ $project->program->name ?? 'N/A' }}</span>
    </div>
    <a href="{{ route('projects.index') }}" class="text-blue-600 hover:underline">Back to
