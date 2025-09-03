<?php
@extends('layouts.app')
@section('title', $facility->name)
@section('content')
<h1 class="text-xl font-bold">{{ $facility->name }}</h1>
<p>Location: {{ $facility->location }}</p>
<p>Type: {{ $facility->facilityType }}</p>
<p>Capabilities: {{ $facility->capabilities }}</p>

<h2 class="mt-4 font-semibold">Projects</h2>
<ul>
    @foreach($facility->projects as $project)
        <li>{{ $project->name ?? 'Unnamed Project' }}</li>
    @endforeach
</ul>

<h2 class="mt-4 font-semibold">Services</h2>
<ul>
    @foreach($facility->services as $service)
        <li>{{ $service->name ?? 'Unnamed Service' }}</li>
    @endforeach
</ul>

<h2 class="mt-4 font-semibold">Equipment</h2>
<ul>
    @foreach($facility->equipment as $equip)
        <li>{{ $equip->name }}</li>
    @endforeach
</ul>
@endsection