@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold">Facilities</h1>
    <a href="{{ route('facilities.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">Add Facility</a>
</div>
<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Location</th>
            <th class="px-4 py-2">Type</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facilities as $facility)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $facility->name }}</td>
            <td class="px-4 py-2">{{ $facility->location }}</td>
            <td class="px-4 py-2">{{ $facility->facilityType }}</td> -->
            <td class="px-4 py-2 flex gap-2">
                <a href="{{ route('facilities.edit', $facility) }}" class="text-blue-500">Edit</a>
                <form action="{{ route('facilities.destroy', $facility) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
