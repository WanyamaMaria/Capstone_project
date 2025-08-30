@extends('layouts.app')
@section('title', 'Programs')
@section('content')
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
        </tr>
    </thead>
    <tbody>
        @foreach($programs as $program)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $program->name }}</td>
            <td class="px-4 py-2">{{ $program->description }}</td>
            <td class="px-4 py-2">{{ $program->national_alignment }}</td>
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
@endsection
