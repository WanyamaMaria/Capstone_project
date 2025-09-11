@extends('layouts.app')
@section('title', 'Programs')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@if(session('success'))
    <div id="success-message" class="success-message">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Programs</h1>
     <a href="{{ route('programs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Add Program
    </a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2 text-left">Name</th>
            <th class="px-4 py-2 text-left">Description</th>
            <th class="px-4 py-2 text-left">NationalAlignment</th>
            <th class="px-4 py-2 text-left">Phases</th>
            <th class="px-4 py-2 text-left">FocusAreas</th>
            <th class="px-4 py-2 text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($programs as $program)
        <tr class="border-b">
            <td class="px-4 py-2 text-left">{{ $program->name }}</td>
            <td class="px-4 py-2 text-left">{{ $program->description }}</td>
            <td class="px-4 py-2 text-left">{{ $program->national_alignment }}</td>
            <td class="px-4 py-2 text-left">{{ $program->phases }}</td>
            <td class="px-4 py-2 text-left">{{ $program->focus_areas }}</td>
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('programs.edit', $program) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('programs.destroy', $program) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    // Wait 4 seconds, then fade out the message
    setTimeout(() => {
        const flash = document.getElementById('success-message');
        if (flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.remove(), 500); // Remove from DOM after fade
        }
    }, 4000); // 4 seconds
</script>
@endsection
