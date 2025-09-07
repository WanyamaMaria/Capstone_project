@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center">
    <h1 class="text-3xl font-extrabold mb-2">Welcome to <span class="text-blue-700">Capstone</span></h1>
    <p class="text-gray-600">Navigate to different sections of the platform below.</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">
    @foreach ([
        ['Programs', 'Manage all programs.', 'programs.index'],
        ['Facilities', 'View and manage facilities.', 'facilities.index'],
        ['Services', 'Manage services offered.', 'services.index'],
        ['Equipment', 'View and manage equipment.', 'equipment.index'],
        ['Projects', 'Manage ongoing projects.', 'projects.index'],
        ['Participants', 'View and manage participants.', 'participants.index'],
        ['Outcomes', 'Track project outcomes.', 'outcomes.index'],
    ] as [$title, $desc, $route])
        <a href="{{ route($route) }}" class="bg-white shadow-md hover:shadow-xl transition rounded-xl p-6 text-center border border-gray-200">
            <h2 class="text-lg font-bold text-blue-700">{{ $title }}</h2>
            <p class="text-gray-600 mt-2">{{ $desc }}</p>
        </a>
    @endforeach
</div>
@endsection
