@extends('layouts.app')

@section('title', 'Services')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Services</h1>
        <a href="{{ route('services.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium">
            Add New Service
        </a>
    </div>

  @if(session('success'))
    <div id="success-message" class="success-message">
        
        {{ session('success') }}
    </div>
@endif

    <div class="bg-white rounded-lg shadow-md">
        @if($services->count() > 0)
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Facility</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">SkillType</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($services as $service)
                        <tr>
                            <td class="px-4 py-2">
                                <a href="{{ route('services.show', $service) }}" class="text-blue-600 hover:underline">
                                    {{ $service->name }}
                                </a>
                            </td>
                            <td class="px-4 py-2">{{ $service->facility->name ?? 'N/A' }}</td>
                            <td class="px-4 py-2">{{ $service->description }}</td>
                            <td class="px-4 py-2">{{ $service->category }}</td>
                            <td class="px-4 py-2">{{ $service->skill_type }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <a href="{{ route('services.edit', $service) }}" class="text-green-600 hover:underline">Edit</a>
                                <form action="{{ route('services.destroy', $service) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                {{ $services->links() }}
            </div>
        @else
            <div class="p-12 text-center text-gray-500">
                No services found.
            </div>
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
