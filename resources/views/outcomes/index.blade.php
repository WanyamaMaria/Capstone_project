@extends('layouts.app')

@section('title', 'Outcomes')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Outcomes</h1>
    <a href="{{ route('outcomes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Outcome</a>
    <table class="w-full mt-4 bg-white shadow-md rounded">
        <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Title</th>
                <th class="py-3 px-6 text-left">Type</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($outcomes as $outcome)
                <tr class="border-b">
                    <td class="py-3 px-6">{{ $outcome->title }}</td>
                    <td class="py-3 px-6">{{ $outcome->outcome_type }}</td>
                    <td class="py-3 px-6">{{ $outcome->commercialization_status }}</td>
                    <td class="py-3 px-6">
                        <a href="{{ route('outcomes.show', $outcome->id) }}" class="text-blue-500 mr-2">View</a>
                        <a href="{{ route('outcomes.edit', $outcome->id) }}" class="text-blue-500 mr-2">Edit</a>
                        <form action="{{ route('outcomes.destroy', $outcome->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-500">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
