@extends('layouts.public')

@section('title', 'Projects')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO HEADER SECTION
═══════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-navy-950 pt-32 pb-20 border-b border-navy-900">
    {{-- Animated drift grid background --}}
    <div class="about-hero-grid absolute inset-0 pointer-events-none" aria-hidden="true"></div>

    {{-- Glowing background element --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/3 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] rounded-full bg-indigo-500/5 blur-[120px]"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 w-full">
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-2.5 mb-6 px-4 py-1.5 rounded-full border border-navy-700/60 bg-navy-900/60 backdrop-blur-sm opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.1s]">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                <span class="font-mono text-xs tracking-widest text-navy-300 uppercase">Case Studies</span>
            </div>

            <h1 class="font-display font-bold text-white tracking-tight leading-[1.1] mb-6 text-4xl sm:text-5xl lg:text-6xl opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.22s]" style="font-family:'Syne', sans-serif">
                Products Built to Last.<br>
                <span class="bg-gradient-to-r from-[#7485ff] via-[#5560f8] to-[#9db0ff] bg-clip-text text-transparent">Systems Built to Scale.</span>
            </h1>

            <p class="font-sans text-base text-slate-400 max-w-xl leading-relaxed opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.34s]">
                Explore our catalog of web architectures, core database systems, and custom full-stack solutions shipped across the globe.
            </p>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     PROJECTS CORE GRID SECTION
═══════════════════════════════════════════════════ --}}
<section class="py-28 bg-slate-950 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($projects as $project)
                <article class="group relative flex flex-col bg-navy-900/40 border border-navy-800/80 rounded-2xl overflow-hidden shadow-xl hover:border-navy-600 transition-all duration-300 hover:-translate-y-1.5">
                    
                    {{-- Graphic Ambient Accent Corner --}}
                    <div class="absolute -top-px -left-px w-10 h-10 border-t border-l border-indigo-500/20 rounded-tl-2xl pointer-events-none z-20 group-hover:border-indigo-400/40 transition-colors duration-300"></div>

                    {{-- Image Wrapper Section --}}
                    <div class="relative overflow-hidden aspect-[16/10] bg-navy-950 border-b border-navy-800/60 shrink-0">
                        @if($project->featured_image)
                            <img
                                src="{{ asset('storage/' . $project->featured_image) }}"
                                alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500 brightness-[0.9] group-hover:brightness-100"
                                loading="lazy"
                            >
                        @else
                            {{-- Geometric Placeholder for entries missing featured media layout parameters --}}
                            <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-navy-950 to-slate-900 opacity-40">
                                <svg class="w-10 h-10 text-navy-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                            </div>
                        @endif

                        {{-- Category Badge Layer Floating over Image --}}
                        @if($project->category)
                            <div class="absolute top-4 left-4 z-10">
                                <span class="font-mono text-[10px] uppercase tracking-wider text-indigo-300 bg-indigo-950/80 backdrop-blur-md border border-indigo-500/30 px-3 py-1 rounded-full">
                                    {{ $project->category->name }}
                                </span>
                            </div>
                        @endif
                    </div>

                    {{-- Card Information Content Body --}}
                    <div class="p-6 flex flex-col flex-1 justify-between">
                        <div>
                            <h3 class="font-display font-bold text-white text-xl leading-snug group-hover:text-indigo-300 transition-colors duration-200">
                                {{ $project->title }}
                            </h3>

                            <p class="font-sans text-slate-400 text-sm mt-3 leading-relaxed">
                                {{ Str::limit(strip_tags($project->description), 115) }}
                            </p>
                        </div>

                        {{-- Link Navigation Footnote --}}
                        <div class="mt-6 pt-5 border-t border-navy-800/60 flex items-center justify-between">
                            <a
                                href="{{ route('projects.show', $project->slug) }}"
                                class="inline-flex items-center gap-1.5 font-sans font-semibold text-xs text-white group-hover:text-indigo-400 transition-colors"
                            >
                                Architecture View
                                <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </a>
                           
                        </div>

                    </div>
                </article>
            @empty
                {{-- Empty Database Query Fallback Interface --}}
                <div class="col-span-full border border-dashed border-navy-800 bg-navy-900/10 rounded-2xl text-center py-20 px-4">
                    <svg class="w-12 h-12 text-navy-700 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.008 1.24l.885 1.77a2.25 2.25 0 002.007 1.24h1.98a2.25 2.25 0 002.007-1.24l.885-1.77a2.25 2.25 0 012.007-1.24h3.86m-18 0h18M2.25 13.5l1.636-9.02A2.25 2.25 0 016.11 3h11.78a2.25 2.25 0 012.224 1.98l1.636 9.02m-18 0v6.75A2.25 2.25 0 004.5 21h15a2.25 2.25 0 002.25-2.25V13.5m-10.5-6h3m-3 3h6" />
                    </svg>
                    <h3 class="font-display font-semibold text-white text-base mb-1">System Repository Empty</h3>
                    <p class="font-sans text-slate-500 text-xs max-w-xs mx-auto">
                        No active engineering records matched our public index parameters at this moment.
                    </p>
                </div>
            @endforelse
        </div>

        {{-- Custom Stylized Tailwind Pagination Links Row --}}
        @if($projects->hasPages())
            <div class="mt-16 pt-8 border-t border-navy-900 custom-pagination-wrapper">
                {{ $projects->links() }}
            </div>
        @endif

    </div>
</section>

@endsection

