@extends('layouts.app')

@section('title', 'Participants')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Participants</h1>
        <a href="{{ route('participants.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-user-plus mr-1"></i> Add Participant
        </a>
    </div>

    @if(session('success'))
        <div id="success-message" class="mb-4 text-blue-800 bg-blue-100 border border-blue-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
        <script>
            setTimeout(() => {
                const flash = document.getElementById('success-message');
                if (flash) {
                    flash.style.transition = 'opacity 0.5s ease';
                    flash.style.opacity = '0';
                    setTimeout(() => flash.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    <!-- Search & Filters -->
    <form method="GET" action="{{ route('participants.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search participants…"
               class="border rounded px-4 py-2 w-64 focus:ring-blue-500 focus:border-blue-500">

        <select name="affiliation" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Affiliations</option>
            @foreach($affiliations as $affiliation)
                <option value="{{ $affiliation }}" {{ request('affiliation') == $affiliation ? 'selected' : '' }}>
                    {{ $affiliation }}
                </option>
            @endforeach
        </select>

        <select name="project_id" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Projects</option>
            @foreach(App\Models\Project::all() as $project)
                <option value="{{ $project->projectId }}" {{ request('project_id') == $project->projectId ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>

        <a href="{{ route('participants.index') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-rotate-left mr-1"></i> Reset
        </a>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        @if($participants->count() > 0)
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-100 text-blue-900 uppercase text-sm font-bold">
                    <tr>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-user mr-1 text-blue-600"></i> Name
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-envelope mr-1 text-blue-600"></i> Email
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-building-columns mr-1 text-blue-600"></i> Affiliation
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-diagram-project mr-1 text-blue-600"></i> Project
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-eye mr-1 text-blue-600"></i> Actions
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-thumbtack mr-1 text-blue-600"></i> Assign
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-100">
                    @foreach($participants as $participant)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-2 text-left">{{ $participant->fullName }}</td>
                            <td class="px-4 py-2 text-left">{{ $participant->email }}</td>
                            <td class="px-4 py-2 text-left">{{ $participant->affiliation }}</td>
                            <td class="px-4 py-2 text-left">{{ $participant->project->title ?? '—' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                <a href="{{ route('participants.show', $participant->participantId) }}" class="text-blue-600 hover:underline">
                                    <i class="fa-solid fa-eye mr-1"></i> View
                                </a>
                                <a href="{{ route('participants.edit', $participant->participantId) }}" class="text-green-600 hover:underline ml-2">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </a>
                                <form action="{{ route('participants.destroy', $participant->participantId) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this participant?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        <i class="fa-solid fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('participants.assign', $participant->participantId) }}" method="POST" class="flex gap-2 items-center">
                                    @csrf
                                    <select name="project_id" class="border rounded px-2 py-1">
                                        <option value="">None</option>
                                        @foreach(App\Models\Project::all() as $project)
                                            <option value="{{ $project->projectId }}" {{ $participant->project_id === $project->projectId ? 'selected' : '' }}>
                                                {{ $project->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded">
                                        <i class="fa-solid fa-thumbtack mr-1"></i> Assign
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $participants->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                No participants found. <a href="{{ route('participants.create') }}" class="text-blue-600 hover:underline">Add a new participant</a>.
            </div>
        @endif
    </div>
</div>
@endsection
