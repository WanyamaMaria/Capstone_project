@extends('layouts.app')

@section('title', 'Facility Details')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/facilities.css') }}">

<div class="container my-6">
    <!-- Facility Card -->
    <div class="facility-card">
        <h1><i class="fas fa-building"></i> {{ $facility->name }}</h1>

        <div class="facility-info">
            <p><i class="fas fa-map-marker-alt text-red-500"></i> <strong>Location:</strong> {{ $facility->location }}</p>
            <p><i class="fas fa-handshake text-green-600"></i> <strong>Partner:</strong> {{ $facility->partnerOrganization }}</p>
            <p><i class="fas fa-industry text-yellow-500"></i> <strong>Type:</strong> {{ $facility->facilityType }}</p>
            <p><i class="fas fa-cogs text-indigo-500"></i> <strong>Capabilities:</strong> {{ $facility->capabilities }}</p>
        </div>

        <p class="mt-4 text-gray-600">
            <i class="fas fa-align-left text-gray-500"></i> <strong>Description:</strong> {{ $facility->description }}
        </p>
    </div>

    <!-- Services -->
    <h2 class="section-title text-green-700">
        <i class="fas fa-concierge-bell"></i> Services
    </h2>
    @if($services->isEmpty())
        <div class="bg-gray-100 text-gray-600 p-3 rounded">No services linked.</div>
    @else
        <div class="item-grid">
            @foreach($services as $service)
                <div class="item-card services">
                    <i class="fas fa-check-circle text-green-600"></i>
                    <strong>{{ $service->name }}</strong>
                    <p>{{ $service->description }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Equipment -->
    <h2 class="section-title text-yellow-600 mt-6">
        <i class="fas fa-tools"></i> Equipment
    </h2>
    @if($equipment->isEmpty())
        <div class="bg-gray-100 text-gray-600 p-3 rounded">No equipment linked.</div>
    @else
        <div class="item-grid">
            @foreach($equipment as $item)
                <div class="item-card equipment">
                    <i class="fas fa-wrench text-yellow-600"></i>
                    <strong>{{ $item->name }}</strong>
                    <p>{{ $item->description }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Projects -->
    <h2 class="section-title text-blue-700 mt-6">
        <i class="fas fa-project-diagram"></i> Projects
    </h2>
    @if($projects->isEmpty())
        <div class="bg-gray-100 text-gray-600 p-3 rounded">No projects linked.</div>
    @else
        <div class="item-grid">
            @foreach($projects as $project)
                <div class="item-card projects">
                    <i class="fas fa-tasks text-blue-600"></i>
                    <strong>{{ $project->name }}</strong>
                    <p>{{ $project->description }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Back Button -->
    <div class="mt-6">
        <a href="{{ route('facilities.index') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Facilities
        </a>
    </div>
</div>
@endsection
    
    <script>
    setTimeout(() => {
        const msg = document.getElementById('success-message');
        if (msg) {
            msg.style.display = 'none';
        }
    }, 5000);
    </script>