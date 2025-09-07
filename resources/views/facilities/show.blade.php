
@extends('layouts.app')

@section('title', 'Facility Details')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ $facility->name }}</h1>
    <p><strong>Location:</strong> {{ $facility->location }}</p>
    <p><strong>Description:</strong> {{ $facility->description }}</p>
    <p><strong>Partner Organization:</strong> {{ $facility->partnerOrganization }}</p>
    <p><strong>Type:</strong> {{ $facility->facilityType }}</p>
    <p><strong>Capabilities:</strong> {{ $facility->capabilities }}</p>

    <hr>

    <!-- Linked Services -->
    <h2 class="mt-4">Services</h2>
    @if($services->isEmpty())
        <p>No services linked to this facility.</p>
    @else
        <ul>
            @foreach($services as $service)
                <li>{{ $service->name }} - {{ $service->description }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Linked Equipment -->
    <h2 class="mt-4">Equipment</h2>
    @if($equipment->isEmpty())
        <p>No equipment linked to this facility.</p>
    @else
        <ul>
            @foreach($equipment as $item)
                <li>{{ $item->name }} - {{ $item->description }}</li>
            @endforeach
        </ul>
    @endif

    <!-- Linked Projects -->
    <h2 class="mt-4">Projects</h2>
    @if($projects->isEmpty())
        <p>No projects linked to this facility.</p>
    @else
        <ul>
            @foreach($projects as $project)
                <li>{{ $project->name }} - {{ $project->description }}</li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('facilities.index') }}" class="btn btn-primary mt-4">Back to Facilities</a>
</div>
@endsection