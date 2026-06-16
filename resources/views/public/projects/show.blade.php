@extends('layouts.public')

@section('title', $project->title . ' — AstraCore Case Study')

@section('content')

{{-- ═══════════════════════════════════════════════════
     PROJECT HERO BANNER
═══════════════════════════════════════════════════ --}}
<section class="relative bg-navy-950 pt-36 pb-12 overflow-hidden border-b border-navy-900">
    {{-- Animated drift background grid layout --}}
    <div class="about-hero-grid absolute inset-0 pointer-events-none" aria-hidden="true"></div>
    
    {{-- Decorative lighting glow radial vectors --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[700px] h-[400px] rounded-full bg-indigo-500/5 blur-[130px]"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6 w-full">
        
        {{-- Navigation Return Controller Anchor --}}
        <div class="mb-8 flex justify-center animate-[fadeUp_0.5s_ease_forwards_0.05s] opacity-0">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center gap-2 font-mono text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-indigo-400 transition-colors duration-200 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Projects
            </a>
        </div>

        <div class="text-center max-w-3xl mx-auto">
            
            {{-- Category Tag Badge --}}
            @if($project->category)
                <div class="inline-flex items-center gap-2 mb-4 px-3 py-1 rounded-full border border-indigo-500/20 bg-indigo-500/5 backdrop-blur-sm animate-[fadeUp_0.5s_ease_forwards_0.1s] opacity-0">
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-400"></span>
                    <span class="font-mono text-[10px] tracking-widest text-indigo-300 uppercase">
                        {{ $project->category->name }}
                    </span>
                </div>
            @endif

            {{-- Title Layer --}}
            <h1 class="font-display font-bold text-white tracking-tight leading-tight mb-4 text-4xl sm:text-5xl lg:text-6xl animate-[fadeUp_0.5s_ease_forwards_0.22s] opacity-0" style="font-family:'Syne', sans-serif">
                {{ $project->title }}
            </h1>

            {{-- System Metadata Subline --}}
            <div class="flex items-center justify-center gap-6 mt-6 font-mono text-xs text-slate-500 animate-[fadeUp_0.5s_ease_forwards_0.34s] opacity-0">
                @if($project->client_name)
                    <div>
                        <span class="text-slate-600">// DEPLOYED FOR:</span> 
                        <span class="text-slate-300 font-sans font-semibold ml-1">{{ $project->client_name }}</span>
                    </div>
                @endif
                <div class="hidden sm:block text-slate-700">|</div>
                <div>
                    <span class="text-slate-600">STATUS:</span> 
                    <span class="text-indigo-400 ml-1 font-semibold uppercase tracking-wider">PRODUCTION LIVE</span>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     FEATURED EMBED IMAGE AREA
═══════════════════════════════════════════════════ --}}
@if($project->featured_image)
    <section class="bg-slate-950 pt-16 pb-12 relative">
        <div class="max-w-6xl mx-auto px-6">
            <div class="relative rounded-2xl overflow-hidden border border-navy-800 shadow-2xl group bg-navy-950">
                
                {{-- UI Framing Lines --}}
                <div class="absolute -top-px -left-px w-16 h-16 border-t border-l border-indigo-500/40 rounded-tl-2xl pointer-events-none z-10"></div>
                
                <img
                    src="{{ asset('storage/' . $project->featured_image) }}"
                    alt="{{ $project->title }} Production Screenshot"
                    class="w-full object-cover max-h-[580px] brightness-[0.95] group-hover:scale-[1.01] transition-transform duration-700"
                >
            </div>
        </div>
    </section>
@endif

{{-- ═══════════════════════════════════════════════════
     ARCHITECTURAL BRIEF / CONTENT BODY
═══════════════════════════════════════════════════ --}}
<section class="py-16 bg-slate-950 relative">
    <div class="max-w-6xl mx-auto px-6">
        
        {{-- Structural Split: Sidebar Details vs Main Document Text --}}
        <div class="grid lg:grid-cols-3 gap-12 items-start">
            
            {{-- Main Case Study Context --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="font-mono text-[11px] tracking-wider text-indigo-400 uppercase flex items-center gap-2">
                    <span class="w-1 h-1 rounded-full bg-indigo-400"></span>
                    System Specifications & Overview
                </div>
                
                {{-- Custom Markdown/HTML Output Styling (Tailored for Dark Mode layouts) --}}
                <div class="font-sans text-slate-300 leading-relaxed text-[16px] space-y-6 rich-project-content
                            prose prose-invert prose-slate max-w-none
                            prose-headings:text-white prose-headings:font-bold prose-headings:tracking-tight
                            prose-h2:text-2xl prose-h2:mt-8 prose-h2:mb-4
                            prose-p:text-slate-400 prose-p:leading-relaxed
                            prose-strong:text-white prose-code:text-indigo-300">
                    {!! $project->description !!}
                </div>
            </div>

            {{-- Engineering Meta Parameters Sticky Box --}}
            <div class="lg:col-span-1 lg:sticky lg:top-28 space-y-6">
                <div class="bg-navy-900/40 border border-navy-800 rounded-2xl p-6 shadow-xl backdrop-blur-sm">
                    <h3 class="font-display font-bold text-white text-sm tracking-wide border-b border-navy-800 pb-4 mb-4 uppercase">
                        Deployment Profile
                    </h3>

                    <ul class="space-y-4 font-mono text-xs">
                        <li class="flex justify-between items-center py-1">
                            <span class="text-slate-500">Core Stack</span>
                            <span class="text-slate-300 font-sans text-right font-medium">Full-Stack Architecture</span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-navy-800/40">
                            <span class="text-slate-500">Node Cluster</span>
                            <span class="text-indigo-400 text-right font-semibold">Active & Monitored</span>
                        </li>
                        <li class="flex justify-between items-center py-1 border-t border-navy-800/40">
                            <span class="text-slate-500">Design Framework</span>
                            <span class="text-slate-300 font-sans text-right font-medium">Bespoke Vector Layout</span>
                        </li>
                    </ul>

                    {{-- Dynamic Project Outbound Portal Action --}}
                    @if($project->project_url)
                        <div class="mt-6">
                            <a
                                href="{{ $project->project_url }}"
                                target="_blank"
                                rel="noopener"
                                class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-gradient-to-r from-[#5560f8] to-[#7485ff] text-white font-sans font-semibold text-sm shadow-lg hover:brightness-110 active:scale-[0.98] transition-all"
                            >
                                Launch Live Application
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>

        </div>

    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     INTERACTIVE INTERFACE GALLERY WITH CAROUSEL MODAL
═══════════════════════════════════════════════════ --}}
@if($project->images->count())
    <section class="py-24 bg-navy-950/40 border-t border-b border-navy-900 relative">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="text-center max-w-xl mx-auto mb-16">
                <p class="font-mono text-[10px] tracking-widest text-indigo-400 uppercase mb-2">Visual Layout Architecture</p>
                <h2 class="font-display font-bold text-white text-3xl sm:text-4xl" style="font-family:'Syne', sans-serif">
                    Project Gallery
                </h2>
            </div>

            {{-- Clickable Grid Framework --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($project->images as $index => $image)
                    <div onclick="openCarouselModal({{ $index }})" 
                         class="group relative overflow-hidden rounded-2xl border border-navy-800 bg-navy-950 aspect-[4/3] shadow-lg cursor-pointer">
                        
                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            alt="Interface Asset Detail Frame"
                            class="w-full h-full object-cover opacity-90 group-hover:opacity-100 group-hover:scale-[1.03] transition-all duration-500"
                            loading="lazy"
                            data-gallery-src="{{ asset('storage/' . $image->image) }}"
                        >
                        
                        {{-- Hover Telemetry Overlay Mask --}}
                        <div class="absolute inset-0 bg-indigo-950/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                            <div class="p-3 rounded-xl border border-indigo-400/30 bg-navy-950/80 text-indigo-300 transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7" />
                                </svg>
                            </div>
                        </div>

                        <div class="absolute inset-0 border border-transparent group-hover:border-indigo-500/30 rounded-2xl transition-colors duration-300 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         CAROUSEL LIGHTBOX OVERLAY PORTAL
    ═══════════════════════════════════════════════════ --}}
    <div id="galleryLightboxModal" 
         class="fixed inset-0 z-[100] hidden items-center justify-center opacity-0 transition-opacity duration-300 ease-out"
         role="dialog" 
         aria-modal="true">
        
        {{-- Backdrop blur scrim closure capture target --}}
        <div onclick="closeCarouselModal()" class="absolute inset-0 bg-slate-950/90 backdrop-blur-md cursor-zoom-out"></div>

        {{-- Frame Container Wrapper --}}
        <div class="relative w-full max-w-5xl px-4 sm:px-16 flex flex-col items-center justify-center z-10 select-none">
            
            {{-- Top Dashboard Command Bar --}}
            <div class="absolute top-[-3.5rem] left-4 right-4 sm:left-16 sm:right-16 flex items-center justify-between font-mono text-xs">
                <div class="text-slate-400 bg-navy-900/60 border border-navy-800 px-3 py-1.5 rounded-lg backdrop-blur-sm">
                    GALLERY STEP // <span id="carouselIndexTracker" class="text-indigo-400 font-bold">1</span> / {{ $project->images->count() }}
                </div>
                
                <button onclick="closeCarouselModal()" 
                        class="p-2 rounded-lg bg-navy-900/60 border border-navy-800 text-slate-400 hover:text-white hover:border-navy-600 backdrop-blur-sm transition-colors"
                        aria-label="Close Lightbox">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Main Asset Frame Box --}}
            <div class="relative w-full aspect-[16/10] sm:aspect-[16/9] bg-navy-950/40 border border-navy-800/80 rounded-2xl overflow-hidden shadow-2xl flex items-center justify-center">
                <img id="carouselMainTargetImage" 
                     src="" 
                     alt="Expanded Display Frame"
                     class="max-w-full max-h-full object-contain opacity-0 transition-opacity duration-200 ease-in-out">
            </div>

            {{-- Left Navigation Deck Control --}}
            <button onclick="shiftCarouselFrame(-1)" 
                    class="absolute left-6 sm:left-2 p-3 rounded-xl bg-navy-900/60 border border-navy-800 text-slate-400 hover:text-white hover:border-indigo-500/40 backdrop-blur-sm transition-all hover:-translate-x-0.5 active:scale-95"
                    aria-label="Previous Image">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
            </button>

            {{-- Right Navigation Deck Control --}}
            <button onclick="shiftCarouselFrame(1)" 
                    class="absolute right-6 sm:right-2 p-3 rounded-xl bg-navy-900/60 border border-navy-800 text-slate-400 hover:text-white hover:border-indigo-500/40 backdrop-blur-sm transition-all hover:translate-x-0.5 active:scale-95"
                    aria-label="Next Image">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                </svg>
            </button>
        </div>
    </div>
@endif


{{-- ═══════════════════════════════════════════════════
     RELATED ARCHITECTURES LAYOUT
═══════════════════════════════════════════════════ --}}
@if($relatedProjects->count())
    <section class="py-24 bg-slate-950">
        <div class="max-w-6xl mx-auto px-6">
            
            <div class="flex items-end justify-between mb-12 border-b border-navy-900 pb-6">
                <div>
                    <p class="font-mono text-[10px] tracking-widest text-indigo-400 uppercase mb-1">Extended Portfolio Spectrum</p>
                    <h2 class="font-display font-bold text-white text-2xl sm:text-3xl" style="font-family:'Syne', sans-serif">
                        Related Projects
                    </h2>
                </div>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedProjects as $item)
                    <article class="group relative flex flex-col bg-navy-900/40 border border-navy-800/80 rounded-2xl overflow-hidden shadow-xl hover:border-navy-600 transition-all duration-300 hover:-translate-y-1">
                        
                        <div class="relative overflow-hidden aspect-[16/10] bg-navy-950">
                            @if($item->featured_image)
                                <img
                                    src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500 brightness-[0.85] group-hover:brightness-100"
                                    loading="lazy"
                                >
                            @endif
                        </div>

                        <div class="p-5 flex flex-col flex-1 justify-between">
                            <h3 class="font-display font-bold text-white text-base leading-snug group-hover:text-indigo-400 transition-colors duration-200">
                                {{ $item->title }}
                            </h3>

                            <div class="mt-4 pt-4 border-t border-navy-800/60">
                                <a
                                    href="{{ route('projects.show', $item->slug) }}"
                                    class="inline-flex items-center gap-1.5 font-sans font-semibold text-xs text-slate-300 hover:text-white transition-colors"
                                >
                                    Explore Architecture
                                    <svg class="w-3 h-3 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </article>
                @endforeach
            </div>

        </div>
    </section>
@endif

@endsection


{{-- Carousel State Management Engine Script --}}
@push('scripts')
    <script>
        // Parse dynamic source arrays into application memory state matrices
        let activeCarouselIndex = 0;
        const galleryImageCache = [];
        
        // Populate system cache links directly from DOM configuration references during parse loop
        document.querySelectorAll('[data-gallery-src]').forEach(img => {
            galleryImageCache.push(img.getAttribute('data-gallery-src'));
        });

        const modalPortal = document.getElementById('galleryLightboxModal');
        const stageImage = document.getElementById('carouselMainTargetImage');
        const indicatorTracker = document.getElementById('carouselIndexTracker');

        function openCarouselModal(targetIndex) {
            activeCarouselIndex = targetIndex;
            updateStageFrameContent();
            
            // Clean browser scrolling layer context locks
            document.body.style.overflow = 'hidden';
            
            modalPortal.classList.remove('hidden');
            modalPortal.classList.add('flex');
            
            // Allow structural rendering ticks before running opacity interpolation transitions
            setTimeout(() => {
                modalPortal.classList.remove('opacity-0');
                modalPortal.classList.add('opacity-100');
            }, 20);

            // Hook window execution keystroke monitoring streams
            window.addEventListener('keydown', processHardwareKeystrokes);
        }

        function closeCarouselModal() {
            modalPortal.classList.remove('opacity-100');
            modalPortal.classList.add('opacity-0');
            
            // Safe teardown framework timeout ensuring animation transitions complete
            setTimeout(() => {
                modalPortal.classList.remove('flex');
                modalPortal.classList.add('hidden');
                stageImage.src = ''; // Flush viewport allocation caches
                document.body.style.overflow = '';
            }, 300);

            window.removeEventListener('keydown', processHardwareKeystrokes);
        }

        function shiftCarouselFrame(directionModifier) {
            activeCarouselIndex += directionModifier;
            
            // Infinite loop tracking parameters around array boundary coordinates
            if (activeCarouselIndex >= galleryImageCache.length) {
                activeCarouselIndex = 0;
            } else if (activeCarouselIndex < 0) {
                activeCarouselIndex = galleryImageCache.length - 1;
            }

            // Pulse opacity state safely during step updates to soften swaps
            stageImage.classList.remove('opacity-100');
            stageImage.classList.add('opacity-0');

            setTimeout(() => {
                updateStageFrameContent();
            }, 120);
        }

        function updateStageFrameContent() {
            stageImage.src = galleryImageCache[activeCarouselIndex];
            indicatorTracker.textContent = activeCarouselIndex + 1;
            
            stageImage.onload = function() {
                stageImage.classList.remove('opacity-0');
                stageImage.classList.add('opacity-100');
            };
        }

        function processHardwareKeystrokes(event) {
            if (event.key === 'Escape') closeCarouselModal();
            if (event.key === 'ArrowRight') shiftCarouselFrame(1);
            if (event.key === 'ArrowLeft') shiftCarouselFrame(-1);
        }
    </script>
@endpush