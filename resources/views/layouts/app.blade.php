<!DOCTYPE html>
<html lang="en" class="transition duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Capstone10 Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/messages.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (localStorage.theme === 'dark') {
                document.documentElement.classList.add('dark');
                document.getElementById('theme-icon').className = 'fa-solid fa-sun';
            }
        });

        function toggleTheme() {
            const html = document.documentElement;
            const icon = document.getElementById('theme-icon');
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            localStorage.theme = isDark ? 'dark' : 'light';
            icon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        }
    </script>
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar (Fixed) --}}
        <aside class="bg-blue-800 dark:bg-gray-800 text-white w-64 p-6 flex flex-col justify-between fixed top-0 left-0 h-screen overflow-y-auto z-50">
            <nav class="space-y-4">
                @foreach([
                    ['home', 'Home', 'fa-home'],
                    ['programs.index', 'Programs', 'fa-diagram-project'],
                    ['projects.index', 'Projects', 'fa-lightbulb'],
                    ['participants.index', 'Participants', 'fa-users'],
                    ['outcomes.index', 'Outcomes', 'fa-chart-line'],
                    ['facilities.index', 'Facilities', 'fa-building'],
                    ['services.index', 'Services', 'fa-concierge-bell'],
                    ['equipment.index', 'Equipment', 'fa-tools'],
                ] as [$route, $label, $icon])
                    <a href="{{ route($route) }}"
                       class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-blue-700 dark:hover:bg-gray-700 {{ request()->routeIs($route) ? 'bg-blue-700 dark:bg-gray-700 font-semibold' : '' }}">
                        <i class="fa-solid {{ $icon }}"></i> {{ $label }}
                    </a>
                @endforeach
            </nav>

            {{-- Theme Toggle --}}
            <div class="mt-6 text-center">
                <button onclick="toggleTheme()"
                        class="bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 px-4 py-2 rounded hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center justify-center gap-2">
                    <i id="theme-icon" class="fa-solid fa-moon"></i>
                    <span class="text-sm">Toggle Theme</span>
                </button>
            </div>
        </aside>

        {{-- Main Content (Offset for Fixed Sidebar) --}}
        <main class="flex-1 ml-64">
            <div class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 rounded-lg shadow-md p-6 border border-gray-200 dark:border-gray-700">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>
