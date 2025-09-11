@extends('layouts.app')
@section('title', 'Projects')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            Add New Project
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded px-4 py-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md">
        @if($projects->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Facility</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Program</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($projects as $project)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('projects.show', $project) }}" class="text-blue-600 hover:underline">
                                    {{ $project->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $project->facility->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $project->program->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ Str::limit($project->description, 50) }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('projects.edit', $project) }}" class="text-green-600 hover:underline">Edit</a>
                                <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?');">
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
                {{ $projects->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                No projects found. <a href="{{ route('projects.create') }}" class="text-blue-600 hover:underline">Add a new project</a>.
            </div>
        @endif
    </div>
</div>
@endsection
