@extends('layouts.app')

@section('title', 'Create Outcome')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create Outcome</h1>
    <form action="{{ route('outcomes.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700">Title: <input type="text" name="title" class="border p-2 w-full" required></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description: <textarea name="description" class="border p-2 w-full"></textarea></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Artifact: <input type="file" name="artifact" class="border p-2 w-full"></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Type: 
                <select name="outcome_type" class="border p-2 w-full" required>
                    <option value="CAD">CAD</option>
                    <option value="PCB">PCB</option>
                    <option value="Prototype">Prototype</option>
                    <option value="Report">Report</option>
                    <option value="Business Plan">Business Plan</option>
                </select>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Quality Certification: <input type="text" name="quality_certification" class="border p-2 w-full"></label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Commercialization Status: 
                <select name="commercialization_status" class="border p-2 w-full">
                    <option value="Demoed">Demoed</option>
                    <option value="Market Linked">Market Linked</option>
                    <option value="Launched">Launched</option>
                </select>
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Project: 
                <select name="project_id" class="border p-2 w-full" >
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </label>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
    </form>
@endsection
