

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">

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
        <h1 class="text-2xl font-bold mb-4">Welcome to Capstone.</h1>
        <p class="text-gray-700">This is the main dashboard where you can navigate to different sections of the platform.</p>
        <div class="grid grid-cols-3 gap-4 mt-6">
            <a href="{{ route('programs.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Programs</h2>
                <p class="text-gray-600">Manage all programs.</p>
            </a>
            <a href="{{ route('facilities.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Facilities</h2>
                <p class="text-gray-600">View and manage facilities.</p>
            </a>
            <a href="{{ route('services.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Services</h2>
                <p class="text-gray-600">Manage services offered.</p>
            </a>
            <a href="{{ route('equipment.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Equipment</h2>
                <p class="text-gray-600">View and manage equipment.</p>
            </a>
            <a href="{{ route('projects.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Projects</h2>
                <p class="text-gray-600">Manage ongoing projects.</p>
            </a>
            <a href="{{ route('participants.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Participants</h2>
                <p class="text-gray-600">View and manage participants.</p>
            </a>
            <a href="{{ route('outcomes.index') }}" class="bg-white shadow rounded p-4 text-center">
                <h2 class="text-lg font-bold">Outcomes</h2>
                <p class="text-gray-600">Track project outcomes.</p>
            </a>
        </div>
    </main>
</body>
</html>