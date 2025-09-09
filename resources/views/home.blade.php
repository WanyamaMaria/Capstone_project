@extends('layouts.app')

@section('title', 'Home')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="text-center mb-6">
    <h1 class="text-3xl font-extrabold text-blue-700 dark:text-blue-300">Welcome to Capstone10</h1>
    <p class="text-gray-600 dark:text-gray-300 text-lg mt-2">Navigate to different sections of the platform below.</p>
</div>

{{-- Academic Modules --}}
<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Academic Modules</h2>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
    @foreach ([
        ['Programs', 'Manage all programs.', 'programs.index', 'programs.create', 'fa-diagram-project', $stats['programs'] ?? 0],
        ['Projects', 'Manage ongoing projects.', 'projects.index', 'projects.create', 'fa-lightbulb', $stats['projects'] ?? 0],
        ['Participants', 'View and manage participants.', 'participants.index', 'participants.create', 'fa-users', $stats['participants'] ?? 0],
        ['Outcomes', 'Track project outcomes.', 'outcomes.index', 'outcomes.create', 'fa-chart-line', $stats['outcomes'] ?? 0],
    ] as [$title, $desc, $route, $createRoute, $icon, $count])
        <div class="bg-gradient-to-br from-gray-200 to-white dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg aspect-square p-4 flex flex-col justify-between text-center shadow-sm hover:shadow-md transition">
            <div>
                <i class="fa-solid {{ $icon }} text-3xl text-blue-600 dark:text-blue-300 mb-2"></i>
                <h2 class="text-xl font-bold text-blue-700 dark:text-blue-200">{{ $title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-base mt-1">{{ $desc }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $count }}</span></p>
            </div>
            <div class="mt-2">
                <a href="{{ route($route) }}" class="text-blue-600 dark:text-blue-400 text-sm hover:underline mr-3">View</a>
                <a href="{{ route($createRoute) }}" class="text-green-500 dark:text-green-400 text-sm hover:underline">Add New</a>
            </div>
        </div>
    @endforeach
</div>

{{-- Operational Modules --}}
<h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Operational Modules</h2>
<div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach ([
        ['Facilities', 'View and manage facilities.', 'facilities.index', 'facilities.create', 'fa-building', $stats['facilities'] ?? 0],
        ['Services', 'Manage services offered.', 'services.index', 'services.create', 'fa-concierge-bell', $stats['services'] ?? 0],
        ['Equipment', 'View and manage equipment.', 'equipment.index', 'equipment.create', 'fa-tools', $stats['equipment'] ?? 0],
    ] as [$title, $desc, $route, $createRoute, $icon, $count])
        <div class="bg-gradient-to-br from-gray-200 to-white dark:from-gray-800 dark:to-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg aspect-square p-4 flex flex-col justify-between text-center shadow-sm hover:shadow-md transition">
            <div>
                <i class="fa-solid {{ $icon }} text-3xl text-blue-600 dark:text-blue-300 mb-2"></i>
                <h2 class="text-xl font-bold text-blue-700 dark:text-blue-200">{{ $title }}</h2>
                <p class="text-gray-600 dark:text-gray-300 text-base mt-1">{{ $desc }}</p>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total: <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $count }}</span></p>
            </div>
            <div class="mt-2">
                <a href="{{ route($route) }}" class="text-blue-600 dark:text-blue-400 text-sm hover:underline mr-3">View</a>
                <a href="{{ route($createRoute) }}" class="text-green-500 dark:text-green-400 text-sm hover:underline">Add New</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
