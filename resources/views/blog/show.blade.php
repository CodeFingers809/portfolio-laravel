@extends('layouts.app')

@php
    $title = $blog['title'] . ' - Ayush Bohra';
    $description = $blog['excerpt'];
    $keywords = 'Ayush Bohra, ' . implode(', ', $blog['tags']) . ', Tech Blog, AI, Machine Learning';
    $ogTitle = $blog['title'];
    $ogDescription = $blog['excerpt'];
    $ogType = 'article';
    $ogUrl = route('blog.show', $blog['slug']);
    $ogImage = $blog['featured_image'] ? route('blog.asset', ['slug' => $blog['slug'], 'type' => 'images', 'filename' => basename($blog['featured_image'])]) : asset('images/og-default.jpg');
    $canonical = route('blog.show', $blog['slug']);
@endphp

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BlogPosting",
    "headline": "{{ $blog['title'] }}",
    "description": "{{ $blog['excerpt'] }}",
    "image": "{{ $ogImage }}",
    "author": {
        "@@type": "Person",
        "name": "Ayush Bohra",
        "jobTitle": "Software Engineer & AI Researcher"
    },
    "publisher": {
        "@@type": "Person",
        "name": "Ayush Bohra"
    },
    "datePublished": "{{ $blog['date'] }}",
    "dateModified": "{{ $blog['date'] }}",
    "mainEntityOfPage": {
        "@@type": "WebPage",
        "@@id": "{{ route('blog.show', $blog['slug']) }}"
    },
    "keywords": "{{ implode(', ', $blog['tags']) }}"
}
</script>
@endpush

@section('content')
<div class="min-h-screen pt-24 px-6 pb-20">
    <div class="container mx-auto max-w-4xl">
        <!-- Back Button -->
        <div class="mb-8 fade-in-section">
            <a href="{{ route('blog.index') }}"
               class="inline-flex items-center text-zinc-300 hover:text-zinc-100 transition-colors">
                <span>< Back to Blog</span>
            </a>
        </div>

        <!-- Article Header -->
        <article class="fade-in-section">
            <header class="mb-12">
                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 terminal-text">
                    {{ $blog['title'] }}
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-4 text-sm mb-6">
                    <time class="text-zinc-300" datetime="{{ $blog['date'] }}">
                        {{ \Carbon\Carbon::parse($blog['date'])->format('F d, Y') }}
                    </time>

                    @if(!empty($blog['tags']))
                        <span class="text-zinc-300/60">•</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach($blog['tags'] as $tag)
                                <span class="px-3 py-1 bg-zinc-700/10 border border-zinc-700/25 rounded text-xs">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Featured Image -->
                @if($blog['featured_image'])
                    <div class="terminal-border terminal-glow rounded-lg overflow-hidden mb-8">
                        <img src="{{ route('blog.asset', ['slug' => $blog['slug'], 'type' => 'images', 'filename' => basename($blog['featured_image'])]) }}"
                             alt="{{ $blog['title'] }}"
                             class="w-full h-auto">
                    </div>
                @endif
            </header>

            <!-- Article Content -->
            <div class="prose prose-invert prose-gray max-w-none terminal-border terminal-glow bg-black/30 p-8 rounded-lg">
                <div class="blog-content text-zinc-300/80 leading-relaxed text-lg">
                    {!! $blog['content'] !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-12 pt-8 border-t border-zinc-700/20">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Share -->
                    <div class="flex items-center gap-4">
                        <span class="text-zinc-300/60">Share:</span>
                        <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $blog['title'] }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-zinc-300 hover:text-zinc-100 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="text-zinc-300 hover:text-zinc-100 transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                    </div>

                    <!-- Back to Top -->
                    <a href="#" class="text-zinc-300 hover:text-zinc-100 transition-colors flex items-center">
                        <span>Back to Top ^</span>
                    </a>
                </div>
            </footer>
        </article>

        <!-- Navigation to Next/Previous Posts -->
        <div class="mt-16 pt-8 border-t border-zinc-700/20">
            <div class="text-center">
                <a href="{{ route('blog.index') }}"
                   class="inline-block px-8 py-4 border border-zinc-700/30 hover:bg-zinc-700/10 transition-all terminal-glow">
                    > View All Posts
                </a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Blog Content Styling */
    .blog-content {
        font-family: 'JetBrains Mono', 'Fira Code', 'Courier New', monospace !important;
        font-size: 18px !important;
        line-height: 1.8 !important;
        white-space: normal !important;
        font-weight: 600 !important;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .blog-content h1,
    .blog-content h2,
    .blog-content h3,
    .blog-content h4,
    .blog-content h5,
    .blog-content h6 {
        @apply text-white font-bold mt-8 mb-4 terminal-text;
        display: block !important;
        font-weight: 900 !important;
    }

    .blog-content h1 {
        @apply text-4xl;
        font-size: 2.25rem !important;
        margin-top: 2rem !important;
        margin-bottom: 1rem !important;
    }
    .blog-content h2 {
        @apply text-3xl;
        font-size: 1.875rem !important;
        margin-top: 1.75rem !important;
        margin-bottom: 0.875rem !important;
    }
    .blog-content h3 {
        @apply text-2xl;
        font-size: 1.5rem !important;
        margin-top: 1.5rem !important;
        margin-bottom: 0.75rem !important;
    }
    .blog-content h4 {
        @apply text-xl;
        font-size: 1.25rem !important;
    }

    .blog-content p {
        @apply mb-6 leading-relaxed;
        display: block !important;
        margin-bottom: 1.5rem !important;
        line-height: 1.8 !important;
    }

    .blog-content a {
        @apply text-zinc-300 hover:text-zinc-100 underline underline-offset-4 transition-colors;
    }

    .blog-content ul,
    .blog-content ol {
        @apply mb-6 ml-6 space-y-2;
        display: block !important;
        margin-bottom: 1.5rem !important;
        margin-left: 1.5rem !important;
        padding-left: 1rem !important;
    }

    .blog-content ul {
        @apply list-disc;
        list-style-type: disc !important;
    }

    .blog-content ol {
        @apply list-decimal;
        list-style-type: decimal !important;
    }

    .blog-content li {
        @apply text-zinc-300/70;
        display: list-item !important;
        margin-bottom: 0.5rem !important;
    }

    .blog-content blockquote {
        @apply border-l-4 border-zinc-700/30 pl-6 py-2 my-6 italic text-zinc-300/60 bg-zinc-700/8;
        display: block !important;
    }

    .blog-content pre {
        @apply my-6 overflow-x-auto;
        display: block !important;
    }

    .blog-content code {
        @apply text-sm;
    }

    .blog-content img {
        @apply my-8 rounded-lg terminal-border terminal-glow;
        display: block !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }

    .blog-content table {
        @apply w-full my-6 border border-zinc-700/25;
        display: table !important;
    }

    .blog-content th {
        @apply bg-zinc-700/10 px-4 py-2 text-left font-bold border border-zinc-700/25;
    }

    .blog-content td {
        @apply px-4 py-2 border border-zinc-700/25;
    }

    .blog-content hr {
        @apply my-8 border-zinc-700/20;
        display: block !important;
    }

    .blog-content strong {
        @apply font-bold text-white;
        font-weight: bold !important;
    }

    .blog-content em {
        @apply italic;
        font-style: italic !important;
    }
</style>
@endpush
@endsection
