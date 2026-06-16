@extends('layouts.public')

@section('title', $blog->title)

@section('content')

{{-- ═══════════════════════════════════════════════════
     HEADER / HERO CONTEXT (DARK MODE)
═══════════════════════════════════════════════════ --}}
<section class="relative bg-navy-950 pt-36 pb-16 border-b border-navy-900/60 overflow-hidden">
    {{-- Ambient light flare design matrix --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] rounded-full bg-indigo-500/5 blur-[100px]"></div>
    </div>

    <div class="container mx-auto px-6 max-w-4xl relative z-10">
        
        {{-- Navigation Return Controller Anchor --}}
        <div class="mb-8">
            <a href="{{ route('blogposts.index') }}" class="inline-flex items-center gap-2 font-mono text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-indigo-400 transition-colors duration-200 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Articles
            </a>
        </div>

        <div class="space-y-6">
            <span class="inline-block font-mono text-[11px] uppercase tracking-widest font-bold text-indigo-300 bg-indigo-950/80 border border-indigo-500/30 px-3 py-1 rounded-md">
                {{ $blog->category?->name ?? 'SYSTEM LOG' }}
            </span>

            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight text-white leading-tight" style="font-family: 'Poppins', sans-serif;">
                {{ $blog->title }}
            </h1>

            {{-- Metadata Frame --}}
            <div class="flex items-center gap-3 pt-2">
                <div class="h-8 w-8 rounded-full bg-navy-800 border border-navy-700 flex items-center justify-center font-mono text-[10px] font-bold text-slate-400">
                    {{ Str::upper(Str::substr($blog->author?->name ?? 'A', 0, 1)) }}
                </div>
                <div class="text-xs font-mono text-slate-400">
                    <span class="text-slate-300 font-sans font-medium">By {{ $blog->author?->name ?? 'Editorial Core' }}</span>
                    <span class="mx-2 text-navy-700">•</span>
                    <span>{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     FEATURED IMAGE VISUAL OVERLAY CONTAINER
═══════════════════════════════════════════════════ --}}
@if($blog->featured_image)
<section class="bg-slate-950 py-4">
    <div class="container mx-auto px-6 max-w-4xl">
        <div class="relative overflow-hidden rounded-2xl border border-navy-900 shadow-2xl aspect-[16/9] max-h-[500px] w-full bg-navy-900">
            <img
                src="{{ asset('storage/'.$blog->featured_image) }}"
                class="w-full h-full object-cover brightness-[0.9]"
                alt="{{ $blog->title }}"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 to-transparent"></div>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════
     PRIMARY ARTICLES BODY CONTENT FIELD
═══════════════════════════════════════════════════ --}}
<section class="py-16 bg-slate-950 text-slate-300 min-h-fit">
    <div class="container mx-auto px-6 max-w-4xl">
        
        {{-- Tailwind Typography Content Frame tailored for dark background environments --}}
        <div class="prose prose-invert prose-slate prose-lg max-w-none
                    prose-headings:font-bold prose-headings:tracking-tight prose-headings:text-white
                    prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                    prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                    prose-p:text-slate-400 prose-p:leading-relaxed prose-p:mb-6
                    prose-strong:text-white prose-code:text-indigo-300
                    prose-ul:list-disc prose-ol:list-decimal prose-li:text-slate-400">

            {!! $blog->content !!}

        </div>

        {{-- Dynamic Taxonomy Labels Section --}}
        @if($blog->tags->count())
            <div class="mt-12 pt-8 border-t border-navy-900/60 flex flex-wrap gap-2">
                @foreach($blog->tags as $tag)
                    <span class="font-mono text-xs text-slate-400 bg-navy-900/40 border border-navy-800/80 px-3 py-1 rounded-full hover:border-indigo-500/40 transition-colors duration-200">
                        #{{ $tag->name }}
                    </span>
                @endforeach
            </div>
        @endif

    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     RELATED CHRONOLOGICAL POSTS FRAMEWORK
═══════════════════════════════════════════════════ --}}
@if($relatedPosts->count())
<section class="py-20 bg-navy-950/40 border-t border-navy-900/60">
    <div class="container mx-auto px-6 max-w-4xl">
        
        <div class="mb-10">
            <span class="font-mono text-xs text-indigo-400 uppercase tracking-widest font-bold block mb-2">Cross Reference</span>
            <h2 class="text-2xl font-bold tracking-tight text-white" style="font-family: 'Poppins', sans-serif;">Related Publications</h2>
        </div>

        {{-- Modern dark grid matching standard alignment specifications --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-navy-800/60 rounded-2xl overflow-hidden border border-navy-800/60 shadow-xl">
            @foreach($relatedPosts as $post)
                <div class="group relative flex flex-col justify-between p-0 bg-navy-950/80 hover:bg-navy-900/20 transition-all duration-300">
                    
                    <div>
                        {{-- Small Fixed Aspect Box Thumbnail --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-navy-900 border-b border-navy-900/60">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/'.$post->featured_image) }}" 
                                     class="w-full h-full object-cover brightness-[0.8] group-hover:brightness-100 group-hover:scale-[1.02] transition-all duration-500"
                                     alt="{{ $post->title }}">
                            @else
                                <div class="w-full h-full bg-navy-900 flex items-center justify-center text-navy-700">
                                    <i class="bi bi-file-earmark-text text-3xl"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Card Header Metadata --}}
                        <div class="p-6 space-y-2">
                            <h3 class="text-sm font-bold tracking-tight text-white line-clamp-2 group-hover:text-indigo-400 transition-colors duration-300" style="font-family: 'Poppins', sans-serif;">
                                <a href="{{ route('blogposts.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                        </div>
                    </div>

                    {{-- Card Footer Action Link Anchor --}}
                    <div class="p-6 pt-0">
                        <div class="pt-4 border-t border-navy-900/60 flex justify-end">
                            <a href="{{ route('blogposts.show', $post->slug) }}" class="inline-flex items-center gap-1 font-mono text-[11px] font-bold uppercase tracking-wider text-slate-400 group-hover:text-indigo-400 transition-colors duration-200">
                                Open <i class="bi bi-arrow-right transform group-hover:translate-x-0.5 transition-transform"></i>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection