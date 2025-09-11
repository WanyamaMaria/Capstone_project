@extends('layouts.app')

@section('title', 'Project Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">{{ $project->title }}</h1>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6 space-y-4">
        <div>
            <strong class="text-gray-700 dark:text-gray-300">Overview:</strong>
            <p class="text-gray-600 dark:text-gray-400">{{ $project->project_overview }}</p>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Nature of Project:</strong>
            <span class="text-gray-600 dark:text-gray-400">{{ $project->nature_of_project }}</span>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Innovation Focus:</strong>
            <span class="text-gray-600 dark:text-gray-400">{{ $project->innovation_focus }}</span>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Prototype Stage:</strong>
            <span class="text-gray-600 dark:text-gray-400">{{ $project->prototype_stage }}</span>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Testing Requirements:</strong>
            <p class="text-gray-600 dark:text-gray-400">{{ $project->testing_requirements }}</p>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Commercialization Plan:</strong>
            <p class="text-gray-600 dark:text-gray-400">{{ $project->commercialization_plan }}</p>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Facility:</strong>
            <span class="text-gray-600 dark:text-gray-400">{{ $project->facility->name ?? 'N/A' }}</span>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Program:</strong>
            <span class="text-gray-600 dark:text-gray-400">{{ $project->program->name ?? 'N/A' }}</span>
        </div>

        <div>
            <strong class="text-gray-700 dark:text-gray-300">Participants:</strong>
            @if($project->participants->count())
                <ul class="list-disc ml-6 text-gray-600 dark:text-gray-400">
                    @foreach($project->participants as $participant)
                        <li>{{ $participant->name }}</li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500 dark:text-gray-400">No participants assigned.</p>
            @endif
        </div>
    </div>

    <div class="mt-6">
        <a href="{{ route('projects.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">← Back to Projects</a>
    </div>
</div>
@endsection
