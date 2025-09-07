@extends('layouts.app')

@section('title', 'Create Program')

@section('content')
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <h2> Program Registration Form</h2>

    <form method="POST" action="{{ route('programs.store') }}">
        @csrf

        <div class="form-section">
            <label><i class="fas fa-tag"></i> Program Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-align-left"></i> Description</label>
            <input type="text" name="description" value="{{ old('description') }}" required>
            @error('description') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-flag"></i> National Alignment</label>
            <textarea name="national_alignment" rows="4">{{ old('national_alignment') }}</textarea>
            @error('national_alignment') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-layer-group"></i> Phases</label>
            <input type="text" name="phases" value="{{ old('phases') }}">
            @error('phases') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-bullseye"></i> Focus Areas</label>
            <input type="text" name="focus_areas" value="{{ old('focus_areas') }}">
            @error('focus_areas') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="submit-btn">
            Create Program
        </button>
        <a href="{{ route('programs.index') }}" class="cancel-btn">
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
