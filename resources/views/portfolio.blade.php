@extends('layouts.app')

@section('content')
<!-- Intro Loader -->
<div id="intro-loader" class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black">
    <!-- Blocky Loader -->
    <div class="loader-container mb-8">
        <div class="blocky-loader">
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
            <div class="block"></div>
        </div>
    </div>

    <!-- Percentage Counter -->
    <div class="percentage-display font-pixel text-2xl md:text-3xl text-zinc-300 mb-8">
        <span id="loading-percentage">0</span>%
    </div>

    <!-- OS Boot Messages -->
    <div class="boot-messages font-mono text-sm text-zinc-400 max-w-2xl px-6 overflow-hidden">
        <div class="boot-line" style="animation-delay: 0.1s;">> Initializing system...</div>
        <div class="boot-line" style="animation-delay: 0.3s;">> Loading core modules...</div>
        <div class="boot-line" style="animation-delay: 0.5s;">> Establishing connection...</div>
        <div class="boot-line" style="animation-delay: 0.7s;">> Mounting file systems...</div>
        <div class="boot-line" style="animation-delay: 0.9s;">> Starting services...</div>
        <div class="boot-line" style="animation-delay: 1.1s;">> Checking hardware...</div>
        <div class="boot-line" style="animation-delay: 1.3s;">> Allocating resources...</div>
        <div class="boot-line" style="animation-delay: 1.5s;">> Loading user profile...</div>
        <div class="boot-line success-line" style="animation-delay: 1.7s;">> System ready. Welcome!</div>
    </div>
</div>

<!-- Main Content Wrapper -->
<div id="main-content" class="opacity-0 transition-opacity duration-500">

<!-- Hero Section -->
<section id="hero" class="min-h-screen flex items-center justify-center px-6 pt-20 relative overflow-hidden">
    <!-- Subtle Radial Gradient -->
    <div class="hero-gradient"></div>
    <div class="container mx-auto max-w-6xl">
        <div class="text-center space-y-8 fade-in-section">
            <!-- Pixelated Globe -->
            <div class="globe-container mb-8">
                <div id="pixel-globe">
                    <canvas id="globe-canvas" width="200" height="200"></canvas>
                </div>
            </div>

            <!-- Terminal Header -->
            <div class="inline-block mb-8">
                <div class="terminal-border bg-black/50 backdrop-blur-sm px-4 py-2 rounded">
                    <span class="text-zinc-300 text-sm font-pixel">session_start()</span>
                </div>
            </div>

            <!-- Main Title with Glitch Effect -->
            <h1 class="text-3xl sm:text-4xl md:text-6xl lg:text-7xl font-pixel mb-6">
                <span class="block text-white glitch-trigger">AYUSH</span>
                <span class="block text-white font-pixel text-4xl sm:text-5xl md:text-7xl lg:text-8xl mt-2 sm:mt-4">BOHRA</span>
            </h1>

            <!-- Typing Effect Subtitle -->
            <div class="text-xs sm:text-sm md:text-base lg:text-lg text-zinc-300 min-h-[2em] font-pixel px-4">
                <span data-type="{{ $personalInfo->title ?? 'AI Engineer • ML Researcher • Full Stack Developer' }}" data-speed="80"></span>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-4 mt-8 sm:mt-12 w-full px-4 sm:px-0">
                <a href="#projects" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 bg-zinc-700/10 border border-zinc-600 transition-all duration-300 text-base sm:text-lg font-semibold text-center">
                    > View Projects
                </a>
                <a href="#contact" class="w-full sm:w-auto px-6 sm:px-8 py-3 sm:py-4 border border-zinc-700/30 transition-all duration-300 text-base sm:text-lg font-semibold text-center">
                    > Get in Touch
                </a>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-16 md:mt-20 animate-bounce">
                <svg class="w-6 h-6 text-zinc-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6 sm:mb-8 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> cat about.txt
            </h2>

            <div class="grid md:grid-cols-2 gap-8 md:gap-12">
                <div class="space-y-4 sm:space-y-6 scroll-animate" data-animate="slide-left" data-delay="100">
                    <p class="text-base sm:text-lg leading-relaxed text-fill-animate">
                        {{ $personalInfo->bio ?? "I'm a passionate AI Engineer and Machine Learning Researcher building intelligent systems that solve real-world problems." }}
                    </p>
                    @if($education->isNotEmpty())
                    <p class="text-base sm:text-lg leading-relaxed text-fill-animate">
                        Currently pursuing {{ $education->first()->degree }} in {{ $education->first()->field_of_study }} at {{ $education->first()->institution }}.
                        With expertise in deep learning, computer vision, and full-stack development.
                    </p>
                    @endif

                    <div class="flex flex-wrap gap-3 sm:gap-4 mt-6 sm:mt-8">
                        @foreach($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base border border-zinc-700/30 transition-all duration-300">
                            {{ $link->platform }} →
                        </a>
                        @endforeach
                        <a href="mailto:{{ $personalInfo->email }}" class="px-4 sm:px-6 py-2 sm:py-3 text-sm sm:text-base border border-zinc-700/30 transition-all duration-300">
                            Email →
                        </a>
                    </div>
                </div>

                <div class="terminal-border bg-black/50 p-4 sm:p-6 rounded-lg transition-all duration-300 scroll-animate" data-animate="flicker" data-delay="200">
                    <div class="space-y-2 sm:space-y-4 font-mono text-xs sm:text-sm">
                        <div class="flex items-start">
                            <span class="text-zinc-300 mr-2">const</span>
                            <span class="text-white">profile</span>
                            <span class="text-zinc-300 mx-2">=</span>
                            <span class="text-white">{</span>
                        </div>
                        <div class="ml-6 space-y-2">
                            <div><span class="text-zinc-300">name:</span> <span class="text-zinc-300">"{{ $personalInfo->name }}"</span>,</div>
                            <div><span class="text-zinc-300">role:</span> <span class="text-zinc-300">"{{ $personalInfo->title }}"</span>,</div>
                            <div><span class="text-zinc-300">location:</span> <span class="text-zinc-300">"{{ $personalInfo->location }}"</span>,</div>
                            @if($education->isNotEmpty())
                            <div><span class="text-zinc-300">education:</span> <span class="text-zinc-300">"{{ $education->first()->degree }} {{ $education->first()->field_of_study }}"</span>,</div>
                            <div><span class="text-zinc-300">cgpa:</span> <span class="text-zinc-300">"{{ $education->first()->cgpa }}/10"</span>,</div>
                            <div><span class="text-zinc-300">graduation:</span> <span class="text-zinc-300">"{{ $education->first()->end_date }}"</span>,</div>
                            @endif
                            <div><span class="text-zinc-300">email:</span> <span class="text-zinc-300">"{{ $personalInfo->email }}"</span>,</div>
                            <div><span class="text-zinc-300">mobile:</span> <span class="text-zinc-300">"{{ $personalInfo->mobile }}"</span></div>
                        </div>
                        <div class="flex items-start">
                            <span class="text-white">}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section id="experience" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> ls ./experience
            </h2>

            <div class="space-y-8">
                @foreach($experiences as $experience)
                <div class="border-l-2 border-zinc-700/30 pl-4 sm:pl-8 pb-6 sm:pb-8 relative group transition-all duration-300 scroll-animate" data-animate="boot-slide" data-delay="{{ $loop->index * 100 }}">
                    <div class="absolute w-3 h-3 sm:w-4 sm:h-4 bg-zinc-500 rounded-full -left-[7px] sm:-left-[9px] top-0 transition-all duration-300"></div>

                    <div class="terminal-border bg-black/30 p-4 sm:p-6 rounded-lg transition-all duration-300">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-3 sm:mb-4">
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-white transition-colors">
                                @if($experience->url)
                                    <a href="{{ $experience->url }}" target="_blank" rel="noopener noreferrer" class="hover:underline">{{ $experience->title }}</a>
                                @else
                                    {{ $experience->title }}
                                @endif
                            </h3>
                            <span class="text-zinc-300 text-sm whitespace-nowrap mt-2 md:mt-0">
                                {{ $experience->start_date }} - {{ $experience->current ? 'Present' : $experience->end_date }}
                            </span>
                        </div>
                        <p class="text-lg mb-4 text-fill-animate">{{ $experience->organization }}@if($experience->location), {{ $experience->location }}@endif</p>

                        @if($experience->description)
                        <p class="mb-4 text-fill-animate">{{ $experience->description }}</p>
                        @endif

                        @if($experience->achievements && count($experience->achievements) > 0)
                        <ul class="space-y-2">
                            @foreach($experience->achievements as $achievement)
                            <li class="text-fill-animate transition-colors">> {!! $achievement !!}</li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> cat skills.json
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
                <!-- AI/ML Skill -->
                <div class="skill-card terminal-border bg-black/30 p-8 rounded-lg group scroll-animate relative overflow-hidden" data-animate="flicker" data-delay="100">
                    <div class="flex flex-col items-center">
                        <!-- Radial Progress Circle -->
                        <div class="radial-progress mb-6" data-progress="95">
                            <svg class="radial-progress-circle" width="200" height="200" viewBox="0 0 200 200">
                                <circle class="radial-progress-bg" cx="100" cy="100" r="90"></circle>
                                <circle class="radial-progress-fill" cx="100" cy="100" r="90" data-value="95"></circle>
                            </svg>
                            <div class="radial-progress-text">
                                <div class="text-4xl font-bold text-white transition-transform">95</div>
                                <div class="text-sm text-zinc-400 font-mono">/100</div>
                            </div>
                        </div>

                        <!-- Skill Title & Icon -->
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 7H7v6h6V7z"/>
                                <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-white transition-colors">AI / ML</h3>
                        </div>

                        <p class="text-center text-zinc-400 text-sm leading-relaxed">
                            Deep learning, transformers, computer vision, and neural network architectures
                        </p>
                    </div>
                </div>

                <!-- Full-Stack Development Skill -->
                <div class="skill-card terminal-border bg-black/30 p-8 rounded-lg group scroll-animate relative overflow-hidden" data-animate="flicker" data-delay="200">
                    <div class="flex flex-col items-center">
                        <!-- Radial Progress Circle -->
                        <div class="radial-progress mb-6" data-progress="85">
                            <svg class="radial-progress-circle" width="200" height="200" viewBox="0 0 200 200">
                                <circle class="radial-progress-bg" cx="100" cy="100" r="90"></circle>
                                <circle class="radial-progress-fill" cx="100" cy="100" r="90" data-value="85"></circle>
                            </svg>
                            <div class="radial-progress-text">
                                <div class="text-4xl font-bold text-white transition-transform">85</div>
                                <div class="text-sm text-zinc-400 font-mono">/100</div>
                            </div>
                        </div>

                        <!-- Skill Title & Icon -->
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633zM5.707 6.293a1 1 0 010 1.414L3.414 10l2.293 2.293a1 1 0 11-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0zm8.586 0a1 1 0 011.414 0l3 3a1 1 0 010 1.414l-3 3a1 1 0 11-1.414-1.414L16.586 10l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-white transition-colors">Full-Stack</h3>
                        </div>

                        <p class="text-center text-zinc-400 text-sm leading-relaxed">
                            React, Next.js, Laravel, Flask, and modern web development frameworks
                        </p>
                    </div>
                </div>

                <!-- Data Science Skill -->
                <div class="skill-card terminal-border bg-black/30 p-8 rounded-lg group scroll-animate relative overflow-hidden" data-animate="flicker" data-delay="300">
                    <div class="flex flex-col items-center">
                        <!-- Radial Progress Circle -->
                        <div class="radial-progress mb-6" data-progress="75">
                            <svg class="radial-progress-circle" width="200" height="200" viewBox="0 0 200 200">
                                <circle class="radial-progress-bg" cx="100" cy="100" r="90"></circle>
                                <circle class="radial-progress-fill" cx="100" cy="100" r="90" data-value="75"></circle>
                            </svg>
                            <div class="radial-progress-text">
                                <div class="text-4xl font-bold text-white transition-transform">75</div>
                                <div class="text-sm text-zinc-400 font-mono">/100</div>
                            </div>
                        </div>

                        <!-- Skill Title & Icon -->
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-white transition-colors">Data Science</h3>
                        </div>

                        <p class="text-center text-zinc-400 text-sm leading-relaxed">
                            Statistical analysis, data visualization, pandas, numpy, and scikit-learn
                        </p>
                    </div>
                </div>

                <!-- Quantitative Analysis Skill -->
                <div class="skill-card terminal-border bg-black/30 p-8 rounded-lg group scroll-animate relative overflow-hidden" data-animate="flicker" data-delay="400">
                    <div class="flex flex-col items-center">
                        <!-- Radial Progress Circle -->
                        <div class="radial-progress mb-6" data-progress="70">
                            <svg class="radial-progress-circle" width="200" height="200" viewBox="0 0 200 200">
                                <circle class="radial-progress-bg" cx="100" cy="100" r="90"></circle>
                                <circle class="radial-progress-fill" cx="100" cy="100" r="90" data-value="70"></circle>
                            </svg>
                            <div class="radial-progress-text">
                                <div class="text-4xl font-bold text-white transition-transform">70</div>
                                <div class="text-sm text-zinc-400 font-mono">/100</div>
                            </div>
                        </div>

                        <!-- Skill Title & Icon -->
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"/>
                                <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-white transition-colors">Quant Analysis</h3>
                        </div>

                        <p class="text-center text-zinc-400 text-sm leading-relaxed">
                            Financial modeling, algorithmic trading, portfolio optimization, and risk analysis
                        </p>
                    </div>
                </div>

                <!-- DevOps Skill -->
                <div class="skill-card terminal-border bg-black/30 p-8 rounded-lg group scroll-animate relative overflow-hidden" data-animate="flicker" data-delay="500">
                    <div class="flex flex-col items-center">
                        <!-- Radial Progress Circle -->
                        <div class="radial-progress mb-6" data-progress="60">
                            <svg class="radial-progress-circle" width="200" height="200" viewBox="0 0 200 200">
                                <circle class="radial-progress-bg" cx="100" cy="100" r="90"></circle>
                                <circle class="radial-progress-fill" cx="100" cy="100" r="90" data-value="60"></circle>
                            </svg>
                            <div class="radial-progress-text">
                                <div class="text-4xl font-bold text-white transition-transform">60</div>
                                <div class="text-sm text-zinc-400 font-mono">/100</div>
                            </div>
                        </div>

                        <!-- Skill Title & Icon -->
                        <div class="flex items-center gap-3 mb-3">
                            <svg class="w-6 h-6 text-zinc-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                            </svg>
                            <h3 class="text-2xl font-bold text-white transition-colors">DevOps</h3>
                        </div>

                        <p class="text-center text-zinc-400 text-sm leading-relaxed">
                            AWS, Docker, CI/CD pipelines, Git workflows, and cloud infrastructure
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> git log --projects
            </h2>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Project 1: Transformer From Scratch -->
                <div class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group scroll-animate" data-animate="fall" data-delay="0">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-bold text-white transition-colors">Transformer Architecture From Scratch</h3>
                        <a href="https://github.com/CodeFingers809/from-scratch-transformer" target="_blank" rel="noopener noreferrer" class="transition-transform">
                            <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <ul class="mb-4 space-y-2 text-sm">
                        <li class="text-fill-animate transition-colors">> Constructed "Attention is all you need" architecture <strong class="text-white">from scratch</strong> using PyTorch</li>
                        <li class="text-fill-animate transition-colors">> Scaled to <strong class="text-white">2 Billion parameters</strong> with 512-token sequence length</li>
                        <li class="text-fill-animate transition-colors">> Trained on 14K+ English-Italian sentences achieving <strong class="text-white">81.2% BLEU score</strong></li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">PyTorch</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Transformers</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">HuggingFace</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Kaggle</span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="https://github.com/CodeFingers809/from-scratch-transformer" target="_blank" rel="noopener noreferrer" class="github-btn inline-flex items-center gap-2 px-4 py-2 border border-zinc-700/30 text-zinc-300 text-sm transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16" style="image-rendering: pixelated;">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                            > GitHub
                        </a>
                    </div>
                </div>

                <!-- Project 2: Vocal Pathology System -->
                <div class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group scroll-animate" data-animate="fall" data-delay="150">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-bold text-white transition-colors">Vocal Pathology Detection System</h3>
                        <a href="https://github.com/CodeFingers809/audihealth" target="_blank" rel="noopener noreferrer" class="transition-transform">
                            <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <ul class="mb-4 space-y-2 text-sm">
                        <li class="text-fill-animate transition-colors">> Built voice pathology detection system with <strong class="text-white">94% accuracy</strong> for vocal disorder identification</li>
                        <li class="text-fill-animate transition-colors">> Designed AI medical reports using DeepSeek-R1, <strong class="text-white">reducing diagnosis time</strong> from days to minutes</li>
                        <li class="text-fill-animate transition-colors">> Integrated real-time audio processing and analysis pipeline</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Flask</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">ReactJS</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">MongoDB</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">PyTorch</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Twilio</span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="https://github.com/CodeFingers809/audihealth" target="_blank" rel="noopener noreferrer" class="github-btn inline-flex items-center gap-2 px-4 py-2 border border-zinc-700/30 text-zinc-300 text-sm transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16" style="image-rendering: pixelated;">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                            > GitHub
                        </a>
                    </div>
                </div>

                <!-- Project 3: QRIYA -->
                <div class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group scroll-animate" data-animate="fall" data-delay="300">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-bold text-white transition-colors">QRIYA - Stock Portfolio Optimizer</h3>
                        <a href="https://github.com/CodeFingers809/audihealth" target="_blank" rel="noopener noreferrer" class="transition-transform">
                            <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                        </a>
                    </div>
                    <ul class="mb-4 space-y-2 text-sm">
                        <li class="text-fill-animate transition-colors">> Computed causal relationships between all NSE stocks using Granger Causality leading to <strong class="text-white">4.4 Million relationships</strong></li>
                        <li class="text-fill-animate transition-colors">> Optimized portfolios using Hierarchical Risk Parity and Efficient Frontier algorithms</li>
                        <li class="text-fill-animate transition-colors">> Built AI-powered news engine using AWS for financial sentiment analysis</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Flask</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">NextJS</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">ShadCN</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">AWS</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Quantitative Analysis</span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="https://github.com/CodeFingers809/audihealth" target="_blank" rel="noopener noreferrer" class="github-btn inline-flex items-center gap-2 px-4 py-2 border border-zinc-700/30 text-zinc-300 text-sm transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16" style="image-rendering: pixelated;">
                                <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                            </svg>
                            > GitHub
                        </a>
                    </div>
                </div>

                <!-- Project 4: Brain Oscillation Mapping -->
                <div class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group scroll-animate" data-animate="fall" data-delay="450">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-2xl font-bold text-white transition-colors">Brain Oscillation Mapping</h3>
                        <div class="transition-transform">
                            <svg class="w-6 h-6 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                        </div>
                    </div>
                    <ul class="mb-4 space-y-2 text-sm">
                        <li class="text-fill-animate transition-colors">> Implemented STGCN with Graph Attention Layers, improving <strong class="text-white">temporal and spatial feature extraction</strong></li>
                        <li class="text-fill-animate transition-colors">> Architected deep learning models for iEEG analysis with <strong class="text-white">83% cognitive state prediction accuracy</strong></li>
                        <li class="text-fill-animate transition-colors">> Applied Graph Neural Networks for brain connectivity analysis</li>
                    </ul>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">PyTorch</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">PyTorch Geometric</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Networkx</span>
                        <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs cursor-default">Neuroscience</span>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="https://github.com/CodeFingers809" target="_blank" rel="noopener noreferrer" class="github-btn inline-flex items-center justify-center gap-2 px-8 py-4 border border-zinc-700/30 transition-all duration-300">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 16 16" style="image-rendering: pixelated;">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                    </svg>
                    > View All Projects on GitHub
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Awards Section -->
<section id="awards" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> cat awards.log
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($awards as $award)
                <div class="award-card terminal-border bg-black/30 p-6 rounded-lg group scroll-animate relative" data-animate="slide-left" data-delay="{{ $loop->index * 80 }}">
                    <div class="flex items-start space-x-4 relative z-10">
                        <div class="award-icon-wrapper shrink-0">
                            @if(str_contains($award->position, '1st'))
                                <!-- 1st Place - Icon only -->
                                <div class="w-14 h-14 rounded-full bg-zinc-700/30 border-2 border-zinc-600 flex items-center justify-center shadow-lg transition-all duration-500">
                                    <svg class="w-8 h-8 text-zinc-300 transition-all duration-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            @elseif(str_contains($award->position, '2nd'))
                                <!-- 2nd Place - Icon only -->
                                <div class="w-14 h-14 rounded-full bg-zinc-700/30 border-2 border-zinc-600 flex items-center justify-center shadow-lg transition-all duration-500">
                                    <svg class="w-8 h-8 text-zinc-300 transition-all duration-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            @elseif(str_contains($award->position, '3rd'))
                                <!-- 3rd Place - Icon only -->
                                <div class="w-14 h-14 rounded-full bg-zinc-700/30 border-2 border-zinc-600 flex items-center justify-center shadow-lg transition-all duration-500">
                                    <svg class="w-8 h-8 text-zinc-300 transition-all duration-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            @else
                                <!-- Other positions - Icon only -->
                                <div class="w-14 h-14 rounded-full bg-zinc-700/30 border-2 border-zinc-600 flex items-center justify-center shadow-lg transition-all duration-500">
                                    <svg class="w-8 h-8 text-zinc-300 transition-all duration-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-white transition-all duration-300 mb-3">
                                {{ $award->title }}
                            </h3>

                            <!-- Position Badge -->
                            <div class="inline-flex items-center gap-2 mb-3 px-3 py-1.5 bg-zinc-700/10 border border-zinc-700/25 rounded-full transition-all duration-300">
                                <span class="text-zinc-300 text-xs font-semibold inline-block transition-transform duration-300">{{ $award->position }}</span>
                            </div>

                            <!-- Prize Badge (consistent height) -->
                            <div class="mb-3">
                                @if($award->prize_type === 'cash' && $award->cash_prize)
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-zinc-700/10 border border-zinc-700/25 rounded-full transition-all duration-300">
                                        <svg class="w-3 h-3 text-zinc-400 transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-zinc-300 text-xs font-semibold inline-block transition-transform duration-300">₹{{ number_format($award->cash_prize, 0) }}</span>
                                    </div>
                                @elseif($award->prize_type === 'other' && $award->other_prize)
                                    <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-zinc-700/10 border border-zinc-700/25 rounded-full transition-all duration-300">
                                        <svg class="w-3 h-3 text-zinc-400 transition-colors duration-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-zinc-300 text-xs font-semibold inline-block transition-transform duration-300">{{ $award->other_prize }}</span>
                                    </div>
                                @endif
                            </div>

                            @if($award->url)
                                <a href="{{ $award->url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-zinc-400 text-xs transition-all group/link">
                                    <span>View Details</span>
                                    <svg class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Certifications Section -->
<section id="certifications" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-6xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> ls ./certifications
            </h2>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Cert 1 -->
                <a href="https://www.credly.com/badges/11c49b3d-83b5-4812-9e82-03178ae4045f/public_url" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-right" data-delay="0">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">AWS Academy Cloud Foundations</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">Amazon Web Services (AWS)</p>
                </a>

                <!-- Cert 2 -->
                <a href="https://catalog-education.oracle.com/pls/certview/sharebadge?id=5A50E4DF76E1E55390593744F2194FA42AC0D2155D6F562F69657F3B39AE3A20" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-left" data-delay="100">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">Generative AI Certified Professional</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">Oracle</p>
                </a>

                <!-- Cert 3 -->
                <a href="https://www.coursera.org/account/accomplishments/specialization/UYN2VK3UR6VL" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-right" data-delay="200">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">Machine Learning Specialization</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">Stanford Online</p>
                </a>

                <!-- Cert 4 -->
                <a href="https://coursera.org/share/3905a8616f30d670fd92b2ff78241d59" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-left" data-delay="300">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">Transformer Models & BERT</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">Google Cloud</p>
                </a>

                <!-- Cert 5 -->
                <a href="https://courses.nvidia.com/certificates/ab451ad878a142c8a1eaf9f84f31fc77/" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-right" data-delay="400">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">AI for Predictive Maintenance</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">NVIDIA Deep Learning Institute</p>
                </a>

                <!-- Cert 6 -->
                <a href="https://courses.nvidia.com/certificates/8c847f134fd44ba9852830f6f22fe921/" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-left" data-delay="500">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">AI for Anomaly Detection</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">NVIDIA Deep Learning Institute</p>
                </a>

                <!-- Cert 7 -->
                <a href="https://courses.nvidia.com/certificates/1ac86ff551f84e54a842400aad798876/" target="_blank" rel="noopener noreferrer"
                   class="terminal-border bg-black/30 p-6 rounded-lg transition-all duration-300 group block scroll-animate" data-animate="slide-right" data-delay="600">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-lg font-bold text-white transition-colors">Fundamentals of Deep Learning</h3>
                        <svg class="w-5 h-5 text-zinc-300 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </div>
                    <p class="text-zinc-300/60 text-sm">NVIDIA Deep Learning Institute</p>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20 px-6 border-t border-zinc-700/20">
    <div class="container mx-auto max-w-4xl">
        <div class="fade-in-section">
            <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-8 sm:mb-12 terminal-text text-center scroll-animate" data-animate="boot-slide" data-delay="0">
                <span class="text-zinc-300">$</span> ./contact.sh
            </h2>

            <div class="terminal-border bg-black/50 p-8 md:p-12 rounded-lg scroll-animate" data-animate="flicker" data-delay="100">
                <div class="text-center mb-8 scroll-animate" data-animate="boot-slide" data-delay="200">
                    <p class="text-base sm:text-xl leading-relaxed text-fill-animate">
                        Have a project in mind or want to collaborate? Feel free to reach out!
                    </p>
                </div>

                <div class="grid md:grid-cols-2 gap-6 mb-8">
                    <div class="border border-zinc-700/25 bg-black/30 p-6 rounded transition-all scroll-animate" data-animate="slide-left" data-delay="300">
                        <div class="flex items-center space-x-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-zinc-300/50 text-sm">Email</p>
                                <a href="mailto:tech.ayushbohra@gmail.com" class="text-zinc-300 transition-colors break-all">
                                    tech.ayushbohra@gmail.com
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border border-zinc-700/25 bg-black/30 p-6 rounded transition-all scroll-animate" data-animate="slide-right" data-delay="350">
                        <div class="flex items-center space-x-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="text-zinc-300/50 text-sm">Mobile</p>
                                <a href="tel:+919082000297" class="text-zinc-300 transition-colors">
                                    +91-9082000297
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="border border-zinc-700/25 bg-black/30 p-6 rounded transition-all scroll-animate cursor-pointer" data-animate="slide-left" data-delay="400" onclick="copyToClipboard('Mumbai, India', this)">
                        <div class="flex items-center space-x-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="text-zinc-300/50 text-sm">Location</p>
                                <p class="text-zinc-300">Mumbai, India <span class="text-xs opacity-50">(click to copy)</span></p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-zinc-700/25 bg-black/30 p-6 rounded transition-all scroll-animate" data-animate="slide-right" data-delay="450">
                        <div class="flex items-center space-x-4">
                            <svg class="w-8 h-8 text-zinc-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.840 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.430.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            <div>
                                <p class="text-zinc-300/50 text-sm">GitHub</p>
                                <a href="https://github.com/CodeFingers809" target="_blank" rel="noopener noreferrer" class="text-zinc-300 transition-colors">
                                    CodeFingers809
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-center gap-4 scroll-animate" data-animate="boot-slide" data-delay="500">
                    <a href="https://linkedin.com/in/ayush-bohra7" target="_blank" rel="noopener noreferrer" class="px-8 py-4 bg-zinc-700/10 border border-zinc-600 transition-all text-center">
                        > LinkedIn
                    </a>
                    <a href="https://github.com/CodeFingers809" target="_blank" rel="noopener noreferrer" class="px-8 py-4 border border-zinc-700/30 transition-all text-center">
                        > GitHub
                    </a>
                    <a href="https://leetcode.com/u/CodeFingers809/" target="_blank" rel="noopener noreferrer" class="px-8 py-4 border border-zinc-700/30 transition-all text-center">
                        > LeetCode
                    </a>
                    <a href="mailto:tech.ayushbohra@gmail.com" class="px-8 py-4 border border-zinc-700/30 transition-all text-center">
                        > Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

</div><!-- End Main Content Wrapper -->
@endsection
