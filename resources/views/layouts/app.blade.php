<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Ayush Bohra - Software Engineer & AI Researcher' }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $description ?? 'Ayush Bohra - Software Engineer and AI Researcher specializing in Machine Learning, Deep Learning, and LLMs. Explore my portfolio, blog posts on AI, and technical projects.' }}">
    <meta name="keywords" content="{{ $keywords ?? 'Ayush Bohra, Software Engineer, AI Researcher, Machine Learning, Deep Learning, LLM, Transformers, Data Science, Portfolio, Tech Blog' }}">
    <meta name="author" content="Ayush Bohra">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $ogTitle ?? ($title ?? 'Ayush Bohra - Software Engineer & AI Researcher') }}">
    <meta property="og:description" content="{{ $ogDescription ?? ($description ?? 'Software Engineer and AI Researcher specializing in Machine Learning, Deep Learning, and LLMs.') }}">
    <meta property="og:type" content="{{ $ogType ?? 'website' }}">
    <meta property="og:url" content="{{ $ogUrl ?? url()->current() }}">
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-default.jpg') }}">
    <meta property="og:site_name" content="Ayush Bohra Portfolio">
    <meta property="og:locale" content="en_US">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $twitterTitle ?? ($title ?? 'Ayush Bohra - Software Engineer & AI Researcher') }}">
    <meta name="twitter:description" content="{{ $twitterDescription ?? ($description ?? 'Software Engineer and AI Researcher specializing in Machine Learning, Deep Learning, and LLMs.') }}">
    <meta name="twitter:image" content="{{ $twitterImage ?? ($ogImage ?? asset('images/og-default.jpg')) }}">
    @if(isset($twitterSite))
    <meta name="twitter:site" content="{{ $twitterSite }}">
    @endif
    @if(isset($twitterCreator))
    <meta name="twitter:creator" content="{{ $twitterCreator }}">
    @endif

    <!-- Performance Optimizations -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Preload Critical Fonts -->
    <link rel="preload" href="{{ asset('fonts/vt323.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/press-start-2p.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- Local Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fonts.css') }}">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Instant Theme Loading - Prevents Flash -->
    <script>
        (function() {
            function getCurrentTheme() {
                const hour = new Date().getHours();
                if (hour >= 6 && hour <= 11) return 'morning';
                if (hour >= 12 && hour <= 16) return 'day';
                if (hour >= 17 && hour <= 20) return 'sunset';
                return 'night';
            }

            function getUserPreference() {
                const savedTheme = localStorage.getItem('user-theme-preference');
                const savedDate = localStorage.getItem('user-theme-date');
                const today = new Date().toISOString().split('T')[0];
                if (savedTheme && savedDate === today) return savedTheme;
                return null;
            }

            const theme = getUserPreference() || getCurrentTheme();
            // Add theme class immediately and disable transitions for initial load
            document.documentElement.style.setProperty('--initial-load', '1');
            document.body.classList.add(`theme-${theme}`);
        })();
    </script>
    <script>
        // Enable transitions only after page is fully loaded
        window.addEventListener('load', function() {
            // Wait for page to be fully painted
            setTimeout(() => {
                document.documentElement.style.removeProperty('--initial-load');
            }, 100);
        });
    </script>

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Person",
        "name": "Ayush Bohra",
        "jobTitle": "Software Engineer & AI Researcher",
        "description": "Software Engineer and AI Researcher specializing in Machine Learning, Deep Learning, and Large Language Models",
        "url": "{{ url('/') }}",
        "knowsAbout": [
            "Machine Learning",
            "Deep Learning",
            "Artificial Intelligence",
            "Large Language Models",
            "Transformers",
            "Python",
            "Software Engineering",
            "Data Science"
        ]
    }
    </script>

    @stack('structured-data')
    @stack('styles')
</head>
<body class="bg-[#030303] text-zinc-300 antialiased overflow-x-hidden">
    <!-- Matrix Rain Background -->
    <canvas id="matrix-canvas" class="fixed inset-0 pointer-events-none opacity-25 z-0"></canvas>

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
