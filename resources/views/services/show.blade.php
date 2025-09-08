@extends('layouts.app')

@section('title', 'Service Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">{{ $service->name }}</h1>
    <div class="mb-2">
        <strong>Description:</strong>
        <p>{{ $service->description }}</p>
    </div>
    <div class="mb-2">
        <strong>Facility:</strong>
        <span>{{ $service->facility->name ?? 'N/A' }}</span>
    </div>
    <a href="{{ route('services.index') }}" class="text-blue-600 hover:underline">Back to Services</a>
