@extends('layouts.app')

@section('title', 'Participant Profile')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-900 mb-4">
        <i class="fa-solid fa-user mr-2 text-blue-600"></i> Participant Profile
    </h1>

    @if(session('success'))
        <div id="success-alert" class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) alert.remove();
            }, 4000);
        </script>
    @endif

    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">
            <i class="fa-solid fa-id-badge mr-2 text-gray-600"></i> {{ $participant->fullName }}
        </h2>

        <ul class="space-y-2 text-gray-700 text-sm">
            <li><strong><i class="fa-solid fa-hashtag mr-1 text-gray-500"></i> Participant ID:</strong> {{ $participant->participantId }}</li>
            <li><strong><i class="fa-solid fa-envelope mr-1 text-gray-500"></i> Email:</strong> {{ $participant->email }}</li>
            <li><strong><i class="fa-solid fa-building-columns mr-1 text-gray-500"></i> Affiliation:</strong> {{ $participant->affiliation }}</li>
            <li><strong><i class="fa-solid fa-screwdriver-wrench mr-1 text-gray-500"></i> Specialization:</strong> {{ $participant->specialization }}</li>
            <li><strong><i class="fa-solid fa-school mr-1 text-gray-500"></i> Institution:</strong> {{ $participant->institution }}</li>
            <li><strong><i class="fa-solid fa-brain mr-1 text-gray-500"></i> Cross-Skill Trained:</strong> {{ $participant->crossSkillTrained ? 'Yes' : 'No' }}</li>
            <li><strong><i class="fa-solid fa-diagram-project mr-1 text-gray-500"></i> Project:</strong> {{ $participant->project->title ?? '—' }}</li>
        </ul>

        <div class="mt-6">
            <a href="{{ route('participants.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
