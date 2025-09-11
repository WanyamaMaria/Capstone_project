@extends('layouts.app')
@section('title', 'Projects')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            Add New Project
        </a>
    </div>

   @if(session('success'))
    <div id="success-message" class="success-message">
        
        {{ session('success') }}
    </div>
@endif

    {{-- Optional Filters --}}
    <form method="GET" action="{{ route('projects.index') }}" class="mb-6 flex flex-wrap gap-4">
        <div>
            <select name="facility_id" class="form-select rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                <option value="">Filter by Facility</option>
                @foreach($facilities as $facility)
                    <option value="{{ $facility->id }}" {{ request('facility_id') == $facility->id ? 'selected' : '' }}>
                        {{ $facility->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <select name="program_id" class="form-select rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                <option value="">Filter by Program</option>
                @foreach($programs as $program)
                    <option value="{{ $program->id }}" {{ request('program_id') == $program->id ? 'selected' : '' }}>
                        {{ $program->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 px-4 py-2 rounded">
            Apply Filters
        </button>
    </form>

    <div class="bg-white dark:bg-gray-900 rounded-lg shadow-md overflow-x-auto">
        @if($projects->count() > 0)
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Title</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Facility</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Program</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Nature</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Stage</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Focus</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Overview</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Commercialization Plan</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Testing Requirements</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-black-500 font-bold uppercase">Actions</th>

                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($projects as $project)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    {{ $project->title }}
                                </a>
                            </td>
                            <td class="px-4 py-2 text-left">{{ $project->facility->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->program->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->nature_of_project }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->prototype_stage }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->innovation_focus }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->project_overview }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->description }}</td>
                            <td class="px-4 py-2 text-left">{{ $project->commercialization_plan }}</td>
                            <td class="px-4 py-2 text-left">{{ $project-> testing_requirements }}</td>

                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('projects.edit', $project) }}" class="text-green-600 dark:text-green-400 hover:underline">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="p-4">
                {{ $projects->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500 dark:text-gray-400">
                No projects found. 
        @endif
    </div>
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
@endsection
