@extends('layouts.app')

@section('title', 'Equipment Details')

@section('content')
<div class="container mt-4">
    <h2 class="mb-3">Equipment Details</h2>

    @if(isset($equipment))
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $equipment->name }}</h5>
                <p class="card-text"><strong>Description:</strong> {{ $equipment->description }}</p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Equipment ID:</strong> {{ $equipment->equipmentId }}</li>
                    <li class="list-group-item"><strong>Facility:</strong> {{ $equipment->facility->name ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Capabilities:</strong> {{ $equipment->capabilities }}</li>
                    <li class="list-group-item"><strong>Inventory Code:</strong> {{ $equipment->inventoryCode }}</li>
                    <li class="list-group-item"><strong>Usage Domain:</strong> {{ $equipment->usageDomain }}</li>
                    <li class="list-group-item"><strong>Support Phase:</strong> {{ $equipment->supportPhase }}</li>
                </ul>


                <div class="mt-3">
                    <a href="{{ route('equipment.edit', $equipment->id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ route('equipment.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            Equipment data not found.
        </div>
    @endif
</div>
@endsection
