<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> 
        @yield('title', 'Dashboard')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-blue-700 text-white shadow-md px-6 py-4 flex justify-between">
        <a href="{{ route('home') }}" class="font-bold text-lg">Capstone</a>
        <ul class="flex gap-4">
            <li><a href="{{ route('programs.index') }}">Programs</a></li>
            <li><a href="{{ route('facilities.index') }}">Facilities</a></li>
            <li><a href="{{ route('services.index') }}">Services</a></li>
            <li><a href="{{ route('equipment.index') }}">Equipment</a></li>
            <li><a href="{{ route('projects.index') }}">Projects</a></li>
            <li><a href="{{ route('participants.index') }}">Participants</a></li>
            <li><a href="{{ route('outcomes.index') }}">Outcomes</a></li>
        </ul>
    </nav>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>
</body>
</html>
