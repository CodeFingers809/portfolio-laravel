<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Ayush Bohra - Software Engineer' }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=VT323&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-[#030303] text-zinc-300 antialiased overflow-x-hidden">
    <!-- Matrix Rain Background -->
    <canvas id="matrix-canvas" class="fixed inset-0 pointer-events-none opacity-10 z-0"></canvas>

    <!-- Main Content -->
    <div class="relative z-10">
        <!-- Navigation -->
        @include('partials.navigation')

        <!-- Page Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('partials.footer')
    </div>

    @stack('scripts')
</body>
</html>
