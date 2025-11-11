<!-- Vertical Scroll Progress Bar -->
<div id="scroll-progress-container" class="fixed left-0 top-0 h-screen w-1 bg-zinc-800/30 z-50 hidden md:block">
    <div id="scroll-progress-bar" class="w-full bg-gradient-to-b from-zinc-500 to-zinc-400 transition-all duration-150 ease-out" style="height: 0%"></div>
</div>

<nav class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-sm border-b border-zinc-700/25">
    <div class="container mx-auto px-4 sm:px-6 py-3 sm:py-4">
        <div class="flex items-center justify-between gap-4">
            <!-- Logo with Theme Indicator -->
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('home') }}" class="text-base sm:text-lg lg:text-xl font-bold terminal-text glitch-trigger whitespace-nowrap flex-shrink-0">
                    <span class="text-zinc-300">ayush@portfolio</span><span class="text-white">:~$</span><span class="terminal-cursor"></span>
                </a>
                <button id="theme-toggle" class="flex items-center gap-1 sm:gap-2 cursor-pointer" title="Click to change theme">
                    <span id="theme-icon" class="text-lg sm:text-xl"></span>
                    <span id="theme-name" class="text-xs sm:text-sm font-mono text-zinc-400 hidden sm:inline-block">[<span id="theme-name-text"></span>]</span>
                </button>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8 flex-shrink-0">
                <a href="{{ route('home') }}#about" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> About</a>
                <a href="{{ route('home') }}#experience" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> Experience</a>
                <a href="{{ route('home') }}#skills" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> Skills</a>
                <a href="{{ route('home') }}#projects" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> Projects</a>
                <a href="{{ route('home') }}#awards" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> Awards</a>
                <a href="{{ route('blog.index') }}" class="hover:text-zinc-100 transition-colors terminal-text whitespace-nowrap">> Blog</a>
                <a href="{{ route('home') }}#contact" class="px-3 xl:px-4 py-2 border border-zinc-700/30 hover:bg-zinc-700/10 hover:border-zinc-600 transition-all terminal-glow whitespace-nowrap">> Contact</a>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="lg:hidden text-zinc-300 hover:text-zinc-100 flex-shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 space-y-4">
            <a href="{{ route('home') }}#about" class="block hover:text-zinc-100 transition-colors terminal-text">> About</a>
            <a href="{{ route('home') }}#experience" class="block hover:text-zinc-100 transition-colors terminal-text">> Experience</a>
            <a href="{{ route('home') }}#skills" class="block hover:text-zinc-100 transition-colors terminal-text">> Skills</a>
            <a href="{{ route('home') }}#projects" class="block hover:text-zinc-100 transition-colors terminal-text">> Projects</a>
            <a href="{{ route('home') }}#awards" class="block hover:text-zinc-100 transition-colors terminal-text">> Awards</a>
            <a href="{{ route('blog.index') }}" class="block hover:text-zinc-100 transition-colors terminal-text">> Blog</a>
            <a href="{{ route('home') }}#contact" class="inline-block px-4 py-2 border border-zinc-700/30 hover:bg-zinc-700/10 hover:border-zinc-600 transition-all">> Contact</a>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');

        btn?.addEventListener('click', () => {
            menu?.classList.toggle('hidden');
        });

        // Close mobile menu when clicking on a link
        menu?.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });

        // Vertical Scroll Progress Bar
        const scrollProgressBar = document.getElementById('scroll-progress-bar');

        const updateScrollProgress = () => {
            if (!scrollProgressBar) return;

            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Calculate scroll percentage
            const scrollableHeight = documentHeight - windowHeight;
            const scrollPercentage = (scrollTop / scrollableHeight) * 100;

            // Update progress bar height
            scrollProgressBar.style.height = `${Math.min(scrollPercentage, 100)}%`;
        };

        // Update on scroll
        window.addEventListener('scroll', updateScrollProgress, { passive: true });

        // Initial update
        updateScrollProgress();
    });
</script>
@endpush
