@extends('layouts.app')

@section('title', 'Assign Participants')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">
        Assign Participants to: {{ $project->title }}
    </h1>

    <form action="{{ route('projects.storeParticipants', $project) }}" method="POST" class="bg-white dark:bg-gray-900 rounded-lg shadow-md p-6">
        @csrf

        <div class="mb-4">
            <label for="participant_ids" class="block font-medium mb-2 text-gray-700 dark:text-gray-300">
                Select Participants
            </label>
            <select name="participant_ids[]" id="participant_ids" multiple
                    class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded px-3 py-2 h-48">
                @foreach($participants as $participant)
                    <option value="{{ $participant->id }}"
                        {{ $project->participants->contains($participant->id) ? 'selected' : '' }}>
                        {{ $participant->name }}
                    </option>
                @endforeach
            </select>
            @error('participant_ids')
                <div class="text-red-600 text-sm mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center mt-6">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium">
                Assign Participants
            </button>
            <a href="{{ route('projects.show', $project) }}" class="ml-4 text-gray-600 dark:text-gray-300 hover:underline">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
