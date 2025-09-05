@extends('layouts.app')

@section('title', 'Register Equipment')

@section('content')
<link rel="stylesheet" href="{{ asset('css/messages.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<div class="container">
    @if(session('success'))
        <div id="success-message" class="success-message">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <h2> Equipment Registration Form</h2>

    <form method="POST" action="{{ route('equipment.store') }}">
        @csrf

        <div class="form-section">
            <label><i class="fas fa-industry"></i> Facility</label>
            <select name="facility_id" required>
                <option value="">-- Select Facility --</option>
                @foreach($facilities as $id => $name)
                    <option value="{{ $id }}" {{ old('facility_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @error('facility_id') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-tag"></i> Equipment Name</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-cogs"></i> Capabilities</label>
            <textarea name="capabilities" rows="3">{{ old('capabilities') }}</textarea>
            @error('capabilities') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-align-left"></i> Description</label>
            <textarea name="description" rows="3">{{ old('description') }}</textarea>
            @error('description') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-section">
            <label><i class="fas fa-barcode"></i> Inventory Code</label>
            <input type="text" name="inventoryCode" value="{{ old('inventoryCode') }}">
            @error('inventoryCode') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-microchip"></i> Usage Domain</label>
            <input type="text" name="usageDomain" value="{{ old('usageDomain') }}">
            @error('usageDomain') <div class="error">{{ $message }}</div> @enderror

            <label><i class="fas fa-rocket"></i> Support Phase</label>
            <input type="text" name="supportPhase" value="{{ old('supportPhase') }}">
            @error('supportPhase') <div class="error">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="submit-btn">
            Register Equipment
        </button>
        <a href="{{ route('equipment.index') }}" class="cancel-btn">
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
