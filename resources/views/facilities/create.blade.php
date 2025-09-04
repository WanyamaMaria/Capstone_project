@extends('layouts.app')

@section('title', 'Create Facility')

@section('content')
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


<div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <h2> Facility Registration Form</h2>

    <form method="POST" action="{{ route('facilities.store') }}">
        @csrf

        <div class="form-section">
            <label><i class="fas fa-tag"></i> Facility Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-map-marker-alt"></i> Location</label>
            <input type="text" name="location" value="{{ old('location') }}" required>
            @error('location') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-align-left"></i> Description</label>
            <textarea name="description" rows="4">{{ old('description') }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-handshake"></i> Partner Organization</label>
            <input type="text" name="partnerOrganization" value="{{ old('partnerOrganization') }}">
            @error('partnerOrganization') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-industry"></i> Facility Type</label>
            <input type="text" name="facilityType" value="{{ old('facilityType') }}">
            @error('facilityType') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-cogs"></i> Capabilities</label>
            <textarea name="capabilities" rows="4">{{ old('capabilities') }}</textarea>
            @error('capabilities') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="submit-btn">
             Create Facility
        </button>
        <a href="{{ route('facilities.index') }}" class="cancel-btn">
           Cancel
        </a>
    </form>
</div>

<script>
    // Auto-hide flash messages
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
