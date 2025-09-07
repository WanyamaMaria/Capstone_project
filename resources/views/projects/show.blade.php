@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <h1 class="text-2xl font-bold mb-4">{{ $project->title }}</h1>
    <a href="{{ $outcomesLink }}" class="bg-blue-500 text-white px-4 py-2 rounded">View Outcomes</a>
@endsection
