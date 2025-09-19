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
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filters -->
    <form method="GET" action="{{ route('participants.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search participants…"
               class="border rounded px-4 py-2 w-64">

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
                <option value="{{ $project->project_id }}" {{ request('project_id') == $project->project_id ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>

        <a href="{{ route('participants.index') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg">
            <i class="fa-solid fa-rotate-left mr-1"></i> Reset
        </a>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        @if($participants->count() > 0)
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-100 text-blue-900 uppercase text-sm font-bold">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Affiliation</th>
                        <th class="px-4 py-2 text-left">Projects</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-100">
                    @foreach($participants as $participant)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-2">{{ $participant->full_name }}</td>
                            <td class="px-4 py-2">{{ $participant->email }}</td>
                            <td class="px-4 py-2">{{ $participant->affiliation }}</td>
                            <td class="px-4 py-2">
                                @if($participant->projects->isEmpty())
                                    —
                                @else
                                    @foreach($participant->projects as $project)
                                        {{ $project->title }}{{ !$loop->last ? ', ' : '' }}
                                    @endforeach
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('participants.show', $participant->participant_id) }}" class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('participants.edit', $participant->participant_id) }}" class="text-green-600 hover:underline ml-2">Edit</a>
                                <form action="{{ route('participants.destroy', $participant->participant_id) }}" method="POST" class="inline ml-2" onsubmit="return confirm('Delete this participant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
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
