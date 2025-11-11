@extends('layouts.app')

@php
    $title = 'Blog - Ayush Bohra';
    $description = 'Read about AI, Machine Learning, Deep Learning, LLMs, and software engineering. Technical insights and tutorials by Ayush Bohra.';
    $keywords = 'Ayush Bohra, Tech Blog, AI Blog, Machine Learning, Deep Learning, LLM, Software Engineering, Tutorials';
    $ogTitle = 'Blog - Ayush Bohra';
    $ogDescription = 'Technical insights and tutorials on AI, Machine Learning, and Software Engineering';
    $canonical = route('blog.index');
@endphp

@push('structured-data')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Blog",
    "name": "Ayush Bohra's Tech Blog",
    "description": "Technical insights and tutorials on AI, Machine Learning, Deep Learning, and Software Engineering",
    "url": "{{ route('blog.index') }}",
    "author": {
        "@@type": "Person",
        "name": "Ayush Bohra",
        "jobTitle": "Software Engineer & AI Researcher"
    }
}
</script>
@endpush

@section('content')
<div class="min-h-screen pt-24 px-6 pb-20">
    <div class="container mx-auto max-w-6xl">
        <!-- Header -->
        <div class="fade-in-section mb-12">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 terminal-text">
                <span class="text-zinc-300">$</span> ls ./blog
            </h1>
            <p class="text-xl text-zinc-300/70">
                Thoughts, tutorials, and insights on software development
            </p>
        </div>

        @if(count($blogs) > 0)
            <!-- Blog Grid -->
            <div class="grid md:grid-cols-2 gap-8">
                @foreach($blogs as $blog)
                    <article class="fade-in-section terminal-border terminal-glow bg-black/30 rounded-lg overflow-hidden hover:bg-black/50 transition-all group">
                        @if($blog['featured_image'])
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ route('blog.asset', ['slug' => $blog['slug'], 'type' => 'images', 'filename' => basename($blog['featured_image'])]) }}"
                                     alt="{{ $blog['title'] }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                            </div>
                        @endif

                        <div class="p-6">
                            <!-- Date & Tags -->
                            <div class="flex flex-wrap items-center gap-2 mb-4">
                                <time class="text-zinc-300 text-sm" datetime="{{ $blog['date'] }}">
                                    {{ \Carbon\Carbon::parse($blog['date'])->format('M d, Y') }}
                                </time>
                                @if(!empty($blog['tags']))
                                    <span class="text-zinc-300/60">•</span>
                                    @foreach(array_slice($blog['tags'], 0, 2) as $tag)
                                        <span class="px-2 py-1 bg-zinc-700/10 border border-zinc-700/25 text-xs rounded">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl font-bold text-white mb-3 group-hover:text-zinc-300 transition-colors">
                                <a href="{{ route('blog.show', $blog['slug']) }}">
                                    {{ $blog['title'] }}
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            @if($blog['excerpt'])
                                <p class="text-zinc-300/60 mb-4 line-clamp-3">
                                    {{ $blog['excerpt'] }}
                                </p>
                            @endif

                            <!-- Read More Link -->
                            <a href="{{ route('blog.show', $blog['slug']) }}"
                               class="inline-flex items-center text-zinc-300 hover:text-zinc-100 transition-all group-hover:translate-x-1">
                                <span>Read More ></span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="terminal-border terminal-glow bg-black/30 p-12 rounded-lg text-center">
                <div class="text-6xl mb-4">📝</div>
                <h3 class="text-2xl font-bold text-white mb-4">No posts yet</h3>
                <p class="text-zinc-300/60">
                    Blog posts will appear here once they're published.
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
