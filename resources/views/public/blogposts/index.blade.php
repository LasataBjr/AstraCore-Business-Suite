@extends('layouts.public')

@section('title', 'Blog')

@section('content')

{{-- ═══════════════════════════════════════════════════
     MINIMALIST EDITORIAL HERO
═══════════════════════════════════════════════════ --}}
<section class="bg-navy-950 pt-32 pb-16 border-b border-slate-100">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="space-y-4">
            <div class="inline-flex items-center gap-2 mb-4 px-4 py-1.5 rounded-full border border-navy-700/60 bg-navy-900/60 backdrop-blur-sm opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.1s]">
                <span class="h-1.5 w-1.5 rounded-full bg-indigo-600 animate-pulse"></span>
                <span class="font-mono text-xs tracking-widest text-navy-300 uppercase">Our Journal</span>
            </div>
             
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight bg-gradient-to-r from-[#7485ff] via-[#5560f8] to-[#9db0ff] bg-clip-text text-transparent
             font-display leading-relaxed opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.22s]" >
                Insights & Engineering
            </h1>
            <p class="text-slate-505 text-base md:text-lg max-w-2xl leading-relaxed opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.34s]">
                Thoughts, tutorials, and practical guides regarding modern web architectures, UI systems, and backend design patterns.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     STREAMLINED LIST ARCHITECTURE
═══════════════════════════════════════════════════ --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-6 max-w-4xl">
        
        <div class="divide-y divide-slate-100">
            @forelse($blogs as $blog)
                <article class="group relative py-12 transition-all duration-300 first:pt-0 last:pb-0">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-6 md:gap-10 items-start">
                        
                        {{-- Left Side: Date/Category Meta (Clean Alignment Column) --}}
                        <div class="md:col-span-3 flex md:flex-col items-center md:items-start justify-between md:justify-start gap-2 pt-1">
                            <time class="font-mono text-xs tracking-tight text-slate-400">
                                {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                            </time>
                            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50/60 px-2.5 py-0.5 rounded-md md:mt-2">
                                {{ $blog->category?->name ?? 'Uncategorized' }}
                            </span>
                        </div>

                        {{-- Right Side: Primary Info Block --}}
                        <div class="md:col-span-9 space-y-4">
                            {{-- Title --}}
                            <h2 class="text-2xl font-bold tracking-tight text-slate-900 group-hover:text-indigo-600 transition-colors duration-300" style="font-family: 'Poppins', sans-serif;">
                                <a href="{{ route('blogposts.show', $blog->slug) }}" class="focus:outline-none block">
                                    {{ $blog->title }}
                                </a>
                            </h2>

                            {{-- Optional Compact Thumbnail --}}
                            @if($blog->featured_image)
                                <div class="my-4 overflow-hidden rounded-2xl border border-slate-100 bg-slate-50 max-h-48 w-full md:w-3/4">
                                    <img src="{{ asset('storage/'.$blog->featured_image) }}" 
                                         class="w-full h-48 object-cover object-center grayscale-[20%] group-hover:grayscale-0 transition-all duration-500" 
                                         alt="{{ $blog->title }}">
                                </div>
                            @endif

                            {{-- Excerpt --}}
                            <p class="text-slate-500 text-sm leading-relaxed max-w-2xl">
                                {{ $blog->excerpt ?? Str::limit(strip_tags($blog->content), 140) }}
                            </p>

                            {{-- Card Footer Actions --}}
                            <div class="pt-2 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs text-slate-400">By</span>
                                    <span class="text-xs font-medium text-slate-700">{{ $blog->author?->name ?? 'Editorial Staff' }}</span>
                                </div>

                                <a href="{{ route('blogposts.show', $blog->slug) }}" 
                                   class="inline-flex items-center gap-1 text-xs font-mono font-bold uppercase tracking-wider text-slate-700 group-hover:text-indigo-600 transition-colors duration-200">
                                    Read Article 
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 transform group-hover:translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>
                </article>
            @empty
                {{-- Clean Empty State --}}
                <div class="py-24 text-center">
                    <p class="text-sm font-medium text-slate-400">No articles have been documented yet.</p>
                </div>
            @endforelse
        </div>

        {{-- REFINE PAGINATION SYSTEM --}}
        @if($blogs->count() > 0)
            <div class="mt-16 pt-12 border-t border-slate-100 flex justify-center">
                {{ $blogs->links() }}
            </div>
        @endif

    </div>
</section>

@endsection

