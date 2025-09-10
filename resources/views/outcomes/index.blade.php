@extends('layouts.app')

@section('title', 'Outcomes')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Outcomes</h1>
        <a href="{{ route('outcomes.create') }}" class="bg-blue-600 hover:bg-blue-900 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-plus mr-1"></i> Add Outcome
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

    <!-- Search & Filter -->
    <form method="GET" action="{{ route('outcomes.index') }}" class="mb-6 flex flex-wrap gap-4 items-center">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search outcomes…"
               class="border rounded px-4 py-2 w-64 focus:ring-blue-500 focus:border-blue-500">

        <select name="ProjectId" class="border rounded px-4 py-2" onchange="this.form.submit()">
            <option value="">All Projects</option>
            @foreach($projects as $project)
                <option value="{{ $project->projectId }}" {{ request('ProjectId') == $project->projectId ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>

        <a href="{{ route('outcomes.index') }}" class="bg-blue-400 hover:bg-blue-500 text-white px-4 py-2 rounded-lg font-medium">
            <i class="fa-solid fa-rotate-left mr-1"></i> Reset
        </a>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-x-auto">
        @if($outcomes->count() > 0)
            <table class="min-w-full divide-y divide-blue-200">
                <thead class="bg-blue-100 text-blue-900 uppercase text-sm font-bold">
                    <tr>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-heading mr-1 text-blue-600"></i> Title
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-tags mr-1 text-blue-600"></i> Type
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-signal mr-1 text-blue-600"></i> Status
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-diagram-project mr-1 text-blue-600"></i> Project
                        </th>
                        <th class="px-4 py-2 text-left">
                            <i class="fa-solid fa-eye mr-1 text-blue-600"></i> Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-blue-100">
                    @foreach($outcomes as $outcome)
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-4 py-2 text-left">{{ $outcome->Title }}</td>
                            <td class="px-4 py-2 text-left">{{ $outcome->OutcomeType }}</td>
                            <td class="px-4 py-2 text-left">{{ $outcome->CommercializationStatus ?? '—' }}</td>
                            <td class="px-4 py-2 text-left">{{ $outcome->project->title ?? '—' }}</td>
                            <td class="px-4 py-2 whitespace-nowrap flex gap-3">
                                <a href="{{ route('outcomes.show', $outcome->OutcomeId) }}" class="text-blue-600 hover:underline">
                                    <i class="fa-solid fa-eye mr-1"></i> View
                                </a>
                                <a href="{{ route('outcomes.edit', $outcome->OutcomeId) }}" class="text-green-600 hover:underline">
                                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                                </a>
                                <form action="{{ route('outcomes.destroy', $outcome->OutcomeId) }}" method="POST" onsubmit="return confirm('Delete this outcome?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        <i class="fa-solid fa-trash mr-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $outcomes->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                No outcomes found. <a href="{{ route('outcomes.create') }}" class="text-blue-600 hover:underline">Add a new outcome</a>.
            </div>
        @endif
    </div>
</div>
@endsection
