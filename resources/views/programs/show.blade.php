@extends('layouts.app')

@section('title', 'Program Details')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/programs.css') }}">

<div class="container my-6">
    <!-- Program Card -->
    <div class="program-card">
        <h1><i class="fas fa-lightbulb text-indigo-600"></i> {{ $program->name }}</h1>

        <div class="program-info">
            <p><i class="fas fa-id-badge text-gray-600"></i> <strong>Program ID:</strong> {{ $program->program_id }}</p>
            <p><i class="fas fa-bullseye text-green-600"></i> <strong>National Alignment:</strong> {{ $program->national_alignment ?? '—' }}</p>
            <p><i class="fas fa-layer-group text-yellow-500"></i> <strong>Focus Areas:</strong> {{ $program->focus_areas ?? '—' }}</p>
            <p><i class="fas fa-stream text-blue-500"></i> <strong>Phases:</strong> {{ $program->phases ?? '—' }}</p>
        </div>

        <p class="mt-4 text-gray-600">
            <i class="fas fa-align-left text-gray-500"></i> <strong>Description:</strong> {{ $program->description ?? 'No description provided.' }}
        </p>
    </div>

    <!-- Linked Projects -->
    <h2 class="section-title text-blue-700 mt-6">
        <i class="fas fa-project-diagram"></i> Linked Projects
    </h2>
    @if($program->projects->isEmpty())
        <div class="bg-gray-100 text-gray-600 p-3 rounded">No projects linked to this program.</div>
    @else
        <div class="item-grid">
            @foreach($program->projects as $project)
                <div class="item-card projects">
                    <i class="fas fa-tasks text-blue-600"></i>
                    <strong>{{ $project->title }}</strong>
                    <p>{{ $project->project_overview }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-6">
        <a href="{{ route('programs.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Programs
        </a>
    </div>
</div>
@endsection

<script>
setTimeout(() => {
    const msg = document.getElementById('success-message');
    if (msg) {
        msg.style.display = 'none';
    }
}, 5000);
</script>
