@extends('layouts.public')

@section('title', 'Our Services')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO ARCHITECTURE
═══════════════════════════════════════════════════ --}}
<section class="relative bg-slate-950 py-28 text-white overflow-hidden border-b border-slate-900">
    {{-- Ambient light spots --}}
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-indigo-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-emerald-600/5 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="container mx-auto px-6 text-center relative z-10">
        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/20 text-indigo-300 text-xs font-mono tracking-wider uppercase mb-5 shadow-sm">
            <span class="flex h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
            Capabilities Blueprint
        </span>

        <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold font-display tracking-tight text-white mb-6 max-w-4xl mx-auto" style="font-family: 'Syne', 'Poppins', sans-serif;">
            Innovative Solutions Engineered For <span class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Digital Growth</span>
        </h1>

        <p class="max-w-2xl mx-auto text-base sm:text-lg text-slate-400 leading-relaxed">
            We bridge technological frontiers with high-fidelity production designs, deploying comprehensive full-stack pipelines tailored to scale operations cleanly.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     SERVICES GRID DECK
═══════════════════════════════════════════════════ --}}
<section class="py-24 bg-slate-50 relative overflow-hidden">
    {{-- Decorative grid background background layer --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] opacity-60 pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10">
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-slate-200/80 rounded-3xl overflow-hidden border border-slate-200/80 shadow-md">
            @forelse($services as $service)
                
                {{-- Card Dynamic Structural Evaluation --}}
                <div class="group relative flex flex-col justify-between p-8 transition-all duration-500 ease-out 
                    {{ $service->is_featured 
                        ? 'bg-slate-950 text-white md:col-span-1 lg:col-span-1' 
                        : 'bg-white text-slate-900 hover:bg-slate-50/50' 
                    }}">
                    
                    {{-- Interactive Radial Gradient Spotlight Hover Tracking Glow --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 pointer-events-none
                        {{ $service->is_featured 
                            ? 'bg-[radial-gradient(600px_circle_at_var(--x,0px)_var(--y,0px),rgba(99,102,241,0.08),transparent_40%)]' 
                            : 'bg-[radial-gradient(600px_circle_at_var(--x,0px)_var(--y,0px),rgba(79,70,229,0.04),transparent_40%)]' 
                        }}">
                    </div>

                    <div>
                        {{-- Top Deck Header Element Array Line --}}
                        <div class="flex items-start justify-between gap-4 mb-8">
                            <span class="font-mono text-[10px] uppercase tracking-widest px-2.5 py-1 rounded border
                                {{ $service->is_featured 
                                    ? 'bg-indigo-500/10 border-indigo-500/30 text-indigo-400' 
                                    : 'bg-slate-100 border-slate-200 text-slate-500' 
                                }}">
                                {{ $service->category->name ?? 'SYSTEM CAPABILITY' }}
                            </span>

                            @if($service->is_featured)
                                <div class="flex h-2 w-2 rounded-full bg-indigo-400 shadow-[0_0_12px_rgba(129,140,248,0.8)] animate-pulse"></div>
                            @endif
                        </div>

                        {{-- Node Icon Engine Segment Integration Box --}}
                        <div class="mb-6 flex h-12 w-12 items-center justify-center rounded-xl transition-all duration-500 border
                            {{ $service->is_featured 
                                ? 'bg-indigo-500/10 border-indigo-500/20 text-indigo-400 group-hover:bg-indigo-500 group-hover:text-white group-hover:scale-110 shadow-[0_0_20px_rgba(99,102,241,0.1)]' 
                                : 'bg-slate-50 border-slate-200 text-slate-700 group-hover:bg-indigo-600 group-hover:text-white group-hover:scale-110' 
                            }}">
                            @if($service->icon)
                                <i class="{{ $service->icon }} text-lg"></i>
                            @else
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75L16.5 12l-2.25 2.25m-4.5 0L7.5 12l2.25-2.25M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                                </svg>
                            @endif
                        </div>

                        {{-- Content Blocks Section --}}
                        <h3 class="text-xl font-bold tracking-tight mb-3 transition-colors duration-300 group-hover:text-indigo-500" style="font-family: 'Poppins', sans-serif;">
                            {{ $service->title }}
                        </h3>

                        <p class="text-sm leading-relaxed mb-8 transition-colors duration-300
                            {{ $service->is_featured ? 'text-slate-400 group-hover:text-slate-300' : 'text-slate-500 group-hover:text-slate-600' }}">
                            @if($service->short_description)
                                {{ Str::limit($service->short_description, 140) }}
                            @else
                                {{ Str::limit(strip_tags($service->description), 120) }}
                            @endif
                        </p>
                    </div>

                    {{-- Link Accessor Deck Anchor Container --}}
                    <div class="pt-4 border-t transition-colors duration-500
                        {{ $service->is_featured ? 'border-slate-800' : 'border-slate-100' }}">
                        <a href="{{ route('services.show', $service->slug) }}" 
                           class="inline-flex items-center gap-2 text-xs font-mono tracking-wider uppercase font-semibold transition-all duration-300
                            {{ $service->is_featured 
                                ? 'text-slate-400 hover:text-white' 
                                : 'text-slate-600 hover:text-indigo-600' 
                            }}">
                            EXPLORE MODULE 
                            <svg class="w-3.5 h-3.5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </a>
                    </div>

                </div>
            @empty
                {{-- Empty Array Blueprint Matrix Interface --}}
                <div class="col-span-full bg-white rounded-3xl py-16 text-center px-6">
                    <div class="mx-auto h-12 w-12 rounded-xl bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-400 mb-4">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25-2.25M12 13.875v-5.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-semibold text-slate-900 mb-1">No services active</h3>
                    <p class="text-xs text-slate-400 max-w-sm mx-auto">The application pipeline is parsed cleanly but active dynamic records matrix returned an empty dataset.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination Controls Grid Segment --}}
        @if($services->hasPages())
            <div class="mt-16 flex justify-center">
                {{ $services->links() }}
            </div>
        @endif

    </div>
</section>

@endsection

{{-- Dynamic Spotlighting Engine Logic Setup --}}
@push('scripts')
<script>
    // Injects client tracking properties over grid canvas containers dynamically
    document.querySelectorAll('.group').forEach(card => {
        card.addEventListener('mousemove', e => {
            const boundaryBox = card.getBoundingClientRect();
            const pointerCoordinateX = e.clientX - boundaryBox.left;
            const pointerCoordinateY = e.clientY - boundaryBox.top;
            
            card.style.setProperty('--x', `${pointerCoordinateX}px`);
            card.style.setProperty('--y', `${pointerCoordinateY}px`);
        });
    });
</script>
@endpush