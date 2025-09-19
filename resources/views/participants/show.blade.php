@extends('layouts.app')

@section('title', 'Participant Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow-md">
        <h1 class="text-2xl font-bold mb-4">{{ $participant->full_name }}</h1>

        <p><strong>Email:</strong> {{ $participant->email }}</p>
        <p><strong>Affiliation:</strong> {{ $participant->affiliation }}</p>
        <p><strong>Specialization:</strong> {{ $participant->specialization }}</p>
        <p><strong>Institution:</strong> {{ $participant->institution }}</p>
        <p><strong>Cross-Skill Trained:</strong> {{ $participant->cross_skill_trained ? 'Yes' : 'No' }}</p>

        <div class="mt-4">
            <strong>Assigned Projects:</strong>
            @if($participant->projects->isEmpty())
                <span>—</span>
            @else
                <ul class="list-disc list-inside">
                    @foreach($participant->projects as $project)
                        <li>{{ $project->title }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex gap-4 mt-6">
            <a href="{{ route('participants.edit', $participant->participant_id) }}" class="bg-green-600 text-white px-4 py-2 rounded">Edit</a>
            <a href="{{ route('participants.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Back</a>
            <form action="{{ route('participants.destroy', $participant->participant_id) }}" method="POST" onsubmit="return confirm('Delete this participant?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection
