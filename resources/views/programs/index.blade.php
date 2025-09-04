@extends('layouts.app')
@section('title', 'Programs')

@section('content')
@if(session('success'))
    <div id="success-message" class="   color: #155724;
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    border-radius: 6px;
    padding: 12px 18px;
    margin-bottom: 15px;
    font-weight: bold;
    text-align: center;
    opacity: 1;
    display: inline-block;
    max-width: 90%;
    width: 100%;
    transition: opacity 0.7s;">
        {{ session('success') }}
    </div>
@endif
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Programs</h1>
    <a href="{{ route('programs.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Program</a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-200">
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">NationalAlignment</th>
            <th class="px-4 py-2">Phases</th>
            <th class="px-4 py-2">FocusAreas</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($programs as $program)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $program->name }}</td>
            <td class="px-4 py-2">{{ $program->description }}</td>
            <td class="px-4 py-2">{{ $program->national_alignment }}</td>
            <td class="px-4 py-2">{{ $program->phases }}</td>
            <td class="px-4 py-2">{{ $program->focus_areas }}</td>
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
