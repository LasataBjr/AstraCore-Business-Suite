@extends('layouts.public')

@section('title', $setting?->site_name ?? 'AstraCore')
@section('page-title', 'Home')
@section('meta-description', $setting?->tagline ?? 'We build modern digital experiences for ambitious businesses.')

@section('content')

{{-- ════════════════════════════════════════════════════════════════
     §1 HERO SECTION [ REFRACTED ASYMMETRY]
════════════════════════════════════════════════════════════════ --}}
<section class="relative min-h-[90vh] flex items-center overflow-x-hidden overflow-y-hidden bg-[#070b12]" aria-label="Hero Section">
    
    {{-- Depth Layer Dynamics  --}}
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        {{-- Matrix Grid Blueprint Accent --}}
        <div class="absolute inset-0 opacity-[0.07]" 
             style="background-image: linear-gradient(rgba(56,189,248,0.1) 1px, transparent 1px), linear-gradient(90deg, rgba(56,189,248,0.1) 1px, transparent 1px); background-size: 40px 40px;"></div>
        
        {{-- High-Intensity Chromatic Radial Blurs --}}
        <div class="absolute -top-40 -right-40 h-[600px] w-[600px] rounded-full bg-gradient-to-br from-cyan-600/20 to-indigo-600/0 blur-[130px] animate-pulse" style="animation-duration: 10s;"></div>
        <div class="absolute bottom-[-10%] left-[-10%] h-[500px] w-[500px] rounded-full bg-blue-600/10 blur-[120px]"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
            
            {{-- Left Column: High-Fidelity Typography Blueprint --}}
            <div class="lg:col-span-6 space-y-8 text-left reveal-left">
                
                {{-- Refracted Pill Badge --}}
                <div class="inline-flex items-center gap-2.5 rounded-full border border-indigo-500/20 bg-indigo-950/30 px-4 py-2 backdrop-blur-md">
                    <span class="flex h-2 w-2 rounded-full bg-indigo-400 animate-ping"></span>
                    <span class="text-xs font-semibold tracking-widest uppercase text-indigo-400 font-mono">
                        {{ $setting?->tagline ?? 'SYSTEMS.INITIALIZED' }}
                    </span>
                </div>

                {{-- Clean Dynamic Heading Hierarchy --}}
                <h1 class="text-5xl sm:text-6xl font-black text-white leading-[1.1] tracking-tight font-display">
                    Forging <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-600">
                        High-Impact
                    </span> <br/>
                    Digital Systems
                </h1>

                {{-- Structured Prose Description --}}
                <p class="max-w-xl text-base sm:text-lg text-slate-400 leading-relaxed font-sans font-normal">
                    We fuse structural enterprise backend optimizations with immaculate UI/UX frameworks, ensuring your platform outpaces the competition at scale.
                </p>

                {{-- Action Arrays --}}
                <div class="flex flex-wrap items-center gap-4 pt-2">
                    <a href="{{ url('/contact') }}" class="group inline-flex items-center gap-3 rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-7 py-4 text-sm font-bold text-white shadow-lg shadow-indigo-950/50 hover:brightness-110 active:scale-[0.99] transition-all">
                        Initiate Blueprint
                        <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
                        </svg>
                    </a>
                    <a href="{{ url('/projects') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-800 bg-slate-900/40 backdrop-blur px-7 py-4 text-sm font-semibold text-slate-300 hover:bg-slate-800/60 hover:border-slate-700 transition-all">
                        Explore Showcases
                    </a>
                </div>
            </div>

            {{-- Right Column: Modern Asymmetric Mockup Graphic Asset [UPDATED WITH OVERFLOW LOCK] --}}
            <div class="lg:col-span-6 relative hidden lg:block overflow-hidden select-none pointer-events-none reveal-right [transition-delay:200ms]">
                <div class="relative w-full max-w-[540px] h-[450px] mx-auto flex items-center justify-center">
                    
                    {{-- Intersecting Decorative Grid/Lines backdrop --}}
                    <div class="absolute w-[120%] h-[1px] bg-gradient-to-r from-transparent via-cyan-500/20 to-transparent transform -rotate-12"></div>
                    <div class="absolute w-[1px] h-[120%] bg-gradient-to-b from-transparent via-indigo-500/20 to-transparent transform left-1/3"></div>
                    
                    {{-- Ambient Backlighting Orb --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-72 h-72 rounded-full bg-gradient-to-r from-blue-600/20 to-cyan-500/20 blur-3xl"></div>

                    {{-- Primary Mockup Window Card --}}
                    <div class="absolute z-20 top-8 left-4 w-[85%] aspect-[16/10] rounded-2xl border border-white/10 bg-[#0d1626]/80 shadow-2xl p-4 overflow-hidden transform hover:-translate-y-1 transition-transform duration-500">
                        <div class="flex items-center gap-1.5 border-b border-slate-800/80 pb-3 mb-4">
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-800"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-800"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-slate-800"></span>
                        </div>
                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-4 h-24 rounded-lg bg-slate-900/50 border border-slate-800/50 p-2.5 flex flex-col justify-between">
                                <div class="w-8 h-1 bg-cyan-400/40 rounded"></div>
                                <div class="space-y-1">
                                    <div class="w-full h-2 bg-slate-800 rounded"></div>
                                    <div class="w-2/3 h-1.5 bg-slate-800 rounded"></div>
                                </div>
                            </div>
                            <div class="col-span-8 h-24 rounded-lg bg-gradient-to-br from-indigo-900/20 to-slate-900/50 border border-indigo-500/10 p-3 flex flex-col justify-between">
                                <div class="flex justify-between items-center">
                                    <div class="w-12 h-1.5 bg-indigo-400/40 rounded"></div>
                                    <div class="w-3 h-3 rounded-full bg-cyan-400/30"></div>
                                </div>
                                <div class="w-1/2 h-3 bg-gradient-to-r from-cyan-400 to-blue-400 rounded-sm"></div>
                            </div>
                            <div class="col-span-12 h-14 rounded-lg bg-slate-900/40 border border-slate-800/40 p-3 flex items-center justify-between">
                                <div class="space-y-1 w-1/3">
                                    <div class="w-full h-1.5 bg-slate-800 rounded"></div>
                                    <div class="w-4/5 h-1 bg-slate-800/60 rounded"></div>
                                </div>
                                <div class="w-16 h-5 rounded bg-blue-600/20 border border-blue-500/30"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Foreground Layer 2: Floating Analytics Metric --}}
                    <div class="absolute z-30 bottom-10 right-2 w-[50%] p-4 rounded-xl border border-white/10 bg-white/[0.06] backdrop-blur-md shadow-xl flex items-center gap-3">
                        <div class="p-2.5 rounded-lg bg-cyan-500/10 border border-cyan-400/20 text-cyan-400">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <div class="space-y-1.5 flex-1">
                            <div class="w-12 h-1 bg-slate-500/40 rounded"></div>
                            <div class="w-full h-2 bg-cyan-400/80 rounded-sm"></div>
                        </div>
                    </div>

                    {{-- Background Layer 3 --}}
                    <div class="absolute z-10 bottom-6 left-0 w-36 h-36 rounded-2xl border border-indigo-500/20 bg-indigo-950/20 opacity-60 backdrop-blur-sm transform -rotate-6"></div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════════
     ABOUT ASTRACORE 
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#f8fafc]" aria-labelledby="about-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 reveal-left">
                <div class="flex items-center gap-2">
                    <span class="h-1 w-6 bg-indigo-600 rounded-full"></span>
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 font-mono">Who We Are</span>
                </div>
                <h2 id="about-heading" class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight font-display">
                    We Are AstraCore
                </h2>
                <p class="text-slate-600 leading-relaxed text-base font-sans">
                    We aren't a generic assembly line agency. AstraCore is an engineering-first collective focusing on robust digital transformation. We bridge database optimizations seamlessly with award-winning UX guidelines.
                </p>
                <p class="text-slate-600 leading-relaxed text-sm font-sans">
                    From highly accurate transactional layers to real-time telemetry updates, we make sure your systems look breath-taking while handling enterprise workloads effortlessly.
                </p>
            </div>
            <div class="bg-gradient-to-br from-indigo-900 to-slate-900 rounded-2xl p-8 text-white space-y-6 shadow-xl reveal-right">
                <h3 class="text-xl font-bold tracking-tight font-display">Our Delivery Ecosystem</h3>
                <div class="space-y-4 font-sans">
                    <div class="flex gap-3 items-start">
                        <div class="h-6 w-6 rounded bg-cyan-400/20 flex items-center justify-center text-cyan-300 text-xs font-bold">✓</div>
                        <p class="text-sm text-slate-300"><strong class="text-white">Strict Architecture:</strong> Written using standardized patterns that don't decay over seasonal cycles.</p>
                    </div>
                    <div class="flex gap-3 items-start">
                        <div class="h-6 w-6 rounded bg-cyan-400/20 flex items-center justify-center text-cyan-300 text-xs font-bold">✓</div>
                        <p class="text-sm text-slate-300"><strong class="text-white">Fluid Prototyping:</strong> High-fidelity micro-interactions planned completely beforehand inside Figma grids.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ════════════════════════════════════════════════════════════════
     SERVICES (Active & Featured Query Loop)
════════════════════════════════════════════════════════════════ --}}
@if ($services && $services->isNotEmpty())
<section class="py-24 bg-white border-t border-slate-200/60 relative overflow-hidden" aria-labelledby="services-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 reveal">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="h-1 w-6 bg-indigo-600 rounded-full"></span>
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 font-mono">Core Expertise</span>
                </div>
                <h2 id="services-heading" class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight font-display">
                    Featured Capabilities
                </h2>
            </div>
            <a href="{{ url('/services') }}" class="group inline-flex items-center gap-1 text-sm font-semibold text-slate-600 hover:text-indigo-600 transition-colors font-sans">
                Browse Full Catalog &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($services as $index => $service)
            <div class="group relative rounded-2xl border border-slate-200 bg-white p-8 shadow-sm hover:shadow-xl hover:border-indigo-200 transition-all duration-300 flex flex-col justify-between reveal-up" style="transition-delay: {{ $index * 100 }}ms">
                <div>
                    <div class="mb-6 inline-flex h-11 w-11 items-center justify-center rounded-xl bg-slate-50 border border-slate-200 group-hover:bg-indigo-50 group-hover:border-indigo-200 transition-all">
                        @if ($service->icon)
                            <i class="{{ $service->icon }} text-lg text-slate-600 group-hover:text-indigo-600 transition-colors"></i>
                        @else
                            <svg class="h-5 w-5 text-slate-500 group-hover:text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        @endif
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2 group-hover:text-indigo-600 transition-colors font-display">{{ $service->title }}</h3>
                    <p class="text-sm text-slate-600 leading-relaxed line-clamp-3 font-sans">{{ $service->short_description ?? Str::limit($service->description, 110) }}</p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100">
                    <a href="{{ url('/services/' . $service->slug) }}" class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 tracking-wider uppercase font-mono">
                        Examine Details
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ════════════════════════════════════════════════════════════════
     WHY CHOOSE US 
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#0a0f1d] relative overflow-hidden" aria-labelledby="why-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 text-center max-w-xl mx-auto space-y-2 reveal">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-400 font-mono">Architectural Advantages</span>
            <h2 id="why-heading" class="text-3xl font-black text-white tracking-tight font-display">
                Why Teams Partner With Us
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 rounded-2xl border border-slate-800 bg-[#0e1424] reveal-up [transition-delay:0ms]">
                <span class="text-2xl font-black text-cyan-400 font-mono">01</span>
                <h3 class="text-lg font-bold text-white mt-3 mb-1 font-display">Pixel-Perfect UX Integrity</h3>
                <p class="text-sm text-slate-400 leading-relaxed font-sans">We match structural development layout sheets perfectly down to the layout alignment grids configured by our design team.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-800 bg-[#0e1424] reveal-up [transition-delay:100ms]">
                <span class="text-2xl font-black text-blue-400 font-mono">02</span>
                <h3 class="text-lg font-bold text-white mt-3 mb-1 font-display">Optimized Execution Indexes</h3>
                <p class="text-sm text-slate-400 leading-relaxed font-sans">No bloat. We specialize in reducing server memory overloads and making sure client-side loading times remain fast.</p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-800 bg-[#0e1424] reveal-up [transition-delay:200ms]">
                <span class="text-2xl font-black text-indigo-400 font-mono">03</span>
                <h3 class="text-lg font-bold text-white mt-3 mb-1 font-display">Comprehensive Code Coverage</h3>
                <p class="text-sm text-slate-400 leading-relaxed font-sans">Our backend integration pathways pass complete unit testing suites to ensure absolute stability at launch cycles.</p>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════════════
      DEVELOPMENT PROCESS 
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-[#f8fafc] border-y border-slate-200" aria-labelledby="process-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 text-center max-w-xl mx-auto space-y-2 reveal">
            <span class="text-xs font-bold uppercase tracking-widest text-indigo-600 font-mono">The Delivery Pipeline</span>
            <h2 id="process-heading" class="text-3xl font-black text-slate-900 tracking-tight font-display">
                How We Bring Systems to Life
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 relative font-sans">
            <div class="space-y-3 reveal-up [transition-delay:0ms]">
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-indigo-100 text-indigo-700 font-mono">PHASE 01</span>
                <h3 class="text-base font-bold text-slate-900 pt-1 font-display">Discovery & Scope</h3>
                <p class="text-xs text-slate-600 leading-relaxed">We break down structural bottlenecks and organize explicit feature parameters before any engine code initializes.</p>
            </div>
            <div class="space-y-3 reveal-up [transition-delay:100ms]">
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-indigo-100 text-indigo-700 font-mono">PHASE 02</span>
                <h3 class="text-base font-bold text-slate-900 pt-1 font-display">UI/UX Blueprinting</h3>
                <p class="text-xs text-slate-600 leading-relaxed">High-fidelity design components are customized inside clear systems to maintain clean aesthetic symmetry across dimensions.</p>
            </div>
            <div class="space-y-3 reveal-up [transition-delay:200ms]">
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-indigo-100 text-indigo-700 font-mono">PHASE 03</span>
                <h3 class="text-base font-bold text-slate-900 pt-1 font-display">Agile Sprint Assembly</h3>
                <p class="text-xs text-slate-600 leading-relaxed">Our backend developers execute structured database migrations and connect logical microservices elegantly.</p>
            </div>
            <div class="space-y-3 reveal-up [transition-delay:300ms]">
                <span class="text-xs font-bold px-2.5 py-1 rounded bg-indigo-100 text-indigo-700 font-mono">PHASE 04</span>
                <h3 class="text-base font-bold text-slate-900 pt-1 font-display">Telemetry Validation</h3>
                <p class="text-xs text-slate-600 leading-relaxed">System deployments endure end-to-end integration stress tests prior to production server launch cycles.</p>
            </div>
        </div>
    </div>
</section>



{{-- ════════════════════════════════════════════════════════════════
      FEATURED PROJECTS 
════════════════════════════════════════════════════════════════ --}}
@if ($projects && $projects->isNotEmpty())
<section class="py-24 bg-[#070b14] border-t border-slate-900" aria-labelledby="projects-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-6 reveal">
            <div class="space-y-2">
                <div class="flex items-center gap-2">
                    <span class="h-1 w-6 bg-indigo-500 rounded-full"></span>
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-400 font-mono">Production Deployments</span>
                </div>
                <h2 id="projects-heading" class="text-3xl sm:text-4xl font-black text-white tracking-tight font-display">
                    Case Showcases
                </h2>
            </div>
            <a href="{{ url('/projects') }}" class="group inline-flex items-center gap-1 text-sm font-semibold text-slate-400 hover:text-cyan-400 transition-colors font-sans">
                View Architecture Log
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($projects->take(3) as $index => $project)
            <div class="group relative overflow-hidden rounded-2xl border border-slate-800 bg-[#070b14] aspect-[10/9] shadow-lg reveal-up" style="transition-delay: {{ $index * 100 }}ms">
                <div class="absolute inset-0 z-0">
                    @if ($project->featured_image)
                        <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-slate-900 to-slate-950"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent z-10"></div>
                </div>

                {{-- Quarter-Glassmorphism Panel Structure --}}
                <div class="absolute inset-x-4 bottom-4 z-20 p-5 rounded-xl border border-white/0 bg-transparent backdrop-blur-none transform translate-y-3 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 group-hover:bg-white/[0.08] group-hover:backdrop-blur-md group-hover:border-white/10 transition-all duration-300 shadow-2xl">
                    <div class="flex flex-col gap-1.5 font-sans">
                        @if ($project->category)
                            <span class="self-start rounded bg-cyan-500/20 px-2 py-0.5 text-[9px] font-bold tracking-wider uppercase text-cyan-300 border border-cyan-400/20 font-mono">{{ $project->category->name }}</span>
                        @endif
                        <h3 class="text-base font-bold text-white tracking-tight mt-1 font-display">{{ $project->title }}</h3>
                        <a href="{{ url('/projects/' . $project->slug) }}" class="mt-1 inline-flex items-center gap-1 text-xs font-bold text-cyan-400 hover:text-cyan-300 transition-colors font-mono">
                            Inspect Case Study &rarr;
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif




{{-- ════════════════════════════════════════════════════════════════
     §8 TESTIMONIALS [LIGHT MIX]
════════════════════════════════════════════════════════════════ --}}
@if ($testimonials && $testimonials->isNotEmpty())
<section class="py-24 bg-white" aria-labelledby="testimonials-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-14 text-center max-w-2xl mx-auto space-y-2 reveal">
            <p class="text-xs font-bold uppercase tracking-widest text-indigo-600 font-mono">Client Integration</p>
            <h2 id="testimonials-heading" class="text-3xl font-black text-slate-900 tracking-tight font-display">
                Trusted by Agile Operators
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($testimonials->take(3) as $index => $testimonial)
            <div class="flex flex-col justify-between rounded-2xl border border-slate-200 bg-slate-50/50 p-8 shadow-sm reveal-up" style="transition-delay: {{ $index * 100 }}ms">
                <div class="space-y-4 font-sans">
                    <div class="flex items-center gap-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-indigo-600' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        @endfor
                    </div>
                    <blockquote class="text-sm text-slate-600 leading-relaxed">
                        "{{ $testimonial->review }}"
                    </blockquote>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-200 flex items-center gap-3 font-sans">
                    <div class="h-9 w-9 flex-shrink-0 overflow-hidden rounded-full border border-slate-200 bg-slate-200">
                        @if ($testimonial->image)
                            <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="h-full w-full object-cover"/>
                        @else
                            <div class="flex h-full w-full items-center justify-center text-xs font-bold text-slate-500 bg-slate-300 font-mono">
                                {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="truncate">
                        <p class="text-sm font-bold text-slate-900 truncate font-display">{{ $testimonial->client_name }}</p>
                        <p class="text-xs text-slate-500 truncate">{{ $testimonial->designation }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ════════════════════════════════════════════════════════════════
     BLOG PREVIEW [DARK MIX]
════════════════════════════════════════════════════════════════ --}}
@if ($recentBlogs && $recentBlogs->isNotEmpty())
<section class="py-24 bg-[#0a0d14]" aria-labelledby="blog-heading">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-14 flex flex-col md:flex-row md:items-end justify-between gap-6 reveal">
            <div class="space-y-1">
                <span class="text-xs font-bold uppercase tracking-widest text-indigo-500 font-mono">System Logs</span>
                <h2 id="blog-heading" class="text-3xl font-black text-white tracking-tight font-display">
                    Insights & Documentation
                </h2>
            </div>
            <a href="{{ url('/blog') }}" class="group inline-flex items-center gap-1 text-sm font-semibold text-slate-400 hover:text-cyan-400 transition-colors font-sans">
                Read Full Ledger
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($recentBlogs->take(3) as $index => $post)
            <article class="group flex flex-col rounded-2xl border border-slate-900 bg-[#0f131f] overflow-hidden hover:border-slate-800 transition-all duration-200 reveal-up" style="transition-delay: {{ $index * 100 }}ms">
                <div class="h-48 overflow-hidden bg-slate-950 relative">
                    @if ($post->featured_image ?? $post->cover_image ?? null)
                        <img src="{{ Storage::url($post->featured_image ?? $post->cover_image) }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]" loading="lazy" />
                    @else
                        <div class="flex h-full w-full items-center justify-center bg-slate-900"></div>
                    @endif
                </div>

                <div class="flex flex-1 flex-col p-6 space-y-3 font-sans">
                    <div class="flex items-center gap-2 text-xs text-slate-500 font-mono">
                        <time datetime="{{ $post->published_at?->toIso8601String() ?? $post->created_at->toIso8601String() }}">
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </time>
                    </div>
                    <h3 class="text-base font-bold text-white group-hover:text-cyan-400 transition-colors line-clamp-2 font-display">
                        <a href="{{ url('/blog/' . $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="flex-1 text-xs text-slate-400 leading-relaxed line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif


{{-- ════════════════════════════════════════════════════════════════
     CONTACT CTA BANNER [LIGHT MIX]
════════════════════════════════════════════════════════════════ --}}
<section class="py-24 bg-gradient-to-b from-white to-slate-50 border-t border-slate-100" aria-labelledby="cta-heading">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8 text-center reveal">
        <div class="relative rounded-3xl border border-slate-200 bg-white px-8 py-14 sm:p-16 overflow-hidden shadow-xl shadow-slate-200/50">
            <div class="absolute -top-24 -left-24 h-64 w-64 rounded-full bg-cyan-100/30 filter blur-2xl" aria-hidden="true"></div>

            <div class="relative z-10 max-w-xl mx-auto space-y-6">
                <h2 id="cta-heading" class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight leading-none font-display">
                    Let's Build Your <br />
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-blue-600 to-cyan-600">Next Interface Evolution</span>
                </h2>
                <p class="text-sm text-slate-600 max-w-xs mx-auto leading-relaxed font-sans">
                    Submit your details today to align development cycles.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2 font-sans">
                    <a href="{{ url('/contact') }}" class="w-full sm:w-auto inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-3.5 text-sm font-semibold text-white shadow-md hover:brightness-110 transition-all">
                        Initiate Project Form
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection