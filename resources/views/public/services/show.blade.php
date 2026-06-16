@extends('layouts.public')

@section('title', $service->title)

@section('content')

{{-- ═══════════════════════════════════════════════════
     ASYMMETRIC SPLIT HERO SECTOR
═══════════════════════════════════════════════════ --}}
<section class="relative bg-slate-950 pt-32 pb-24 overflow-hidden text-white">
    {{-- Ambient Tech Grid Background Layer --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_100%,#000_70%,transparent_100%)] opacity-40 pointer-events-none"></div>
    
    <div class="container mx-auto px-6 relative z-10">
        
        {{-- Navigation Return Controller Anchor --}}
        <div class="mb-8">
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 font-mono text-xs font-bold uppercase tracking-wider text-slate-400 hover:text-indigo-400 transition-colors duration-200 group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                </svg>
                Back to Services
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            {{-- Left Content Payload Column --}}
            <div class="lg:col-span-7 space-y-6">
                <div class="flex items-center gap-3">
                    <span class="font-mono text-xs uppercase tracking-widest px-3 py-1 bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 rounded-md">
                        {{ $service->category->name ?? 'CAPABILITY MODULE' }}
                    </span>
                    @if($service->is_featured)
                        <span class="flex items-center gap-1.5 font-mono text-[11px] uppercase tracking-wider text-amber-400 bg-amber-500/10 border border-amber-500/20 px-2.5 py-0.5 rounded">
                            <span class="h-1.5 w-1.5 rounded-full bg-amber-400 animate-pulse"></span> Premium Tier
                        </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight" style="font-family: 'Poppins', sans-serif;">
                    {{ $service->title }}
                </h1>

                <p class="text-slate-400 text-lg md:text-xl leading-relaxed max-w-2xl">
                    @if($service->short_description)
                        {{ $service->short_description }}
                    @else
                        Professional, high-performance capability engineered to scale your operational workflows seamlessly.
                    @endif
                </p>

                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="#explore-blueprint" class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold tracking-wide transition-all duration-300 shadow-lg shadow-indigo-600/20 hover:-translate-y-0.5">
                        Explore Specifications
                    </a>
                    <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 border border-slate-800 hover:border-slate-700 text-slate-300 hover:text-white text-sm font-semibold tracking-wide transition-all duration-300">
                        Request Quote
                    </a>
                </div>
            </div>

            {{-- Right Asset Visualization Column --}}
            <div class="lg:col-span-5 relative">
                @if($service->image)
                    <div class="relative group rounded-3xl overflow-hidden border border-slate-800 shadow-2xl bg-slate-900 aspect-[4/3] lg:aspect-square">
                        <img 
                            src="{{ asset('storage/'.$service->image) }}" 
                            class="w-full h-full object-cover transition-transform duration-750 group-hover:scale-105" 
                            alt="{{ $service->title }}"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-60"></div>
                    </div>
                @else
                    {{-- Premium Tech Isometric Visual Fallback Placeholder --}}
                    <div class="w-full aspect-square rounded-3xl border border-slate-800/80 bg-gradient-to-br from-slate-900 to-slate-950 flex flex-col items-center justify-center p-8 text-center shadow-2xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(99,102,241,0.05),transparent_60%)]"></div>
                        <div class="h-16 w-16 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-4 shadow-[0_0_30px_rgba(99,102,241,0.15)]">
                            <i class="{{ $service->icon ?? 'bi bi-cpu' }} text-3xl"></i>
                        </div>
                        <h4 class="text-sm font-mono text-slate-400 tracking-wider uppercase mb-1">Module ID Token</h4>
                        <p class="text-xs font-mono text-slate-600">SYS-{{ Str::upper(Str::random(6)) }} // READY</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     MAIN DOCUMENTATION GRID SECTION
═══════════════════════════════════════════════════ --}}
<section id="explore-blueprint" class="py-24 bg-white relative">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            
            {{-- Left Primary Body: Rich Text Engine Column --}}
            <div class="lg:col-span-8 space-y-8">
                <div class="border-b border-slate-100 pb-4">
                    <h2 class="text-xs font-mono text-indigo-600 uppercase tracking-widest font-bold">Functional Overview</h2>
                </div>
                
                {{-- Clean Typographical Engine Layout context --}}
                <div class="prose prose-slate prose-lg max-w-none 
                            prose-headings:font-bold prose-headings:tracking-tight prose-headings:text-slate-900
                            prose-h2:text-2xl prose-h3:text-xl
                            prose-p:text-slate-600 prose-p:leading-relaxed
                            prose-a:text-indigo-600 hover:prose-a:text-indigo-500
                            prose-strong:text-slate-900 prose-ul:list-disc prose-ol:list-decimal">
                    {!! $service->description !!}
                </div>
            </div>

            {{-- Right Sticky Utility Control Sidebar Column --}}
            <div class="lg:col-span-4 lg:sticky lg:top-28 h-fit space-y-6">
                
                {{-- Feature Matrix Card Anchor Box --}}
                <div class="rounded-3xl border border-slate-100 bg-slate-50/50 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-md shadow-indigo-600/10">
                            <i class="{{ $service->icon ?? 'bi bi-layers-half' }} text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-900">Pipeline Config</h3>
                            <p class="text-xs text-slate-400">Structural service parameters</p>
                        </div>
                    </div>

                    <ul class="space-y-3.5 border-t border-slate-200/60 pt-5 text-sm">
                        <li class="flex items-center justify-between text-slate-600">
                            <span class="text-slate-400 flex items-center gap-2"><i class="bi bi-tag text-xs"></i> Classification</span>
                            <span class="font-medium text-slate-800">{{ $service->category->name ?? 'Standard' }}</span>
                        </li>
                        <li class="flex items-center justify-between text-slate-600">
                            <span class="text-slate-400 flex items-center gap-2"><i class="bi bi-shield-check text-xs"></i> SLA Integrity</span>
                            <span class="font-medium text-slate-800">99.9% Operational</span>
                        </li>
                        <li class="flex items-center justify-between text-slate-600">
                            <span class="text-slate-400 flex items-center gap-2"><i class="bi bi-patch-check text-xs"></i> Availability</span>
                            <span class="inline-flex items-center gap-1.5 text-xs bg-emerald-50 text-emerald-700 px-2.5 py-0.5 rounded-full font-medium">
                                <span class="h-1 w-1 rounded-full bg-emerald-500"></span> Deployment Active
                            </span>
                        </li>
                    </ul>
                </div>

                {{-- Context Action Sidebar Micro Banner --}}
                <div class="rounded-3xl bg-slate-950 p-6 text-white relative overflow-hidden shadow-xl">
                    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,rgba(99,102,241,0.15),transparent_70%)] pointer-events-none"></div>
                    <h3 class="text-lg font-bold mb-2">Accelerate Implementation</h3>
                    <p class="text-xs text-slate-400 leading-relaxed mb-6">Ready to provision this node within your business environment architecture?</p>
                    <a href="{{ route('contact') }}" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-white hover:bg-slate-100 text-slate-950 text-xs font-mono tracking-wider uppercase font-bold transition-all duration-300">
                        Initiate Launch <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     RELATED SERVICES DECKS SEGMENT
═══════════════════════════════════════════════════ --}}
@if($relatedServices->count())
<section class="py-24 bg-slate-50 border-t border-slate-100">
    <div class="container mx-auto px-6">
        
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-12">
            <div>
                <span class="font-mono text-xs text-indigo-600 uppercase tracking-widest font-bold block mb-2">Cross-Reference Matrix</span>
                <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight" style="font-family: 'Poppins', sans-serif;">Related Capabilities</h2>
            </div>
            <a href="{{ route('services.index') }}" class="inline-flex items-center gap-2 text-xs font-mono tracking-wider uppercase font-bold text-slate-600 hover:text-indigo-600 transition-colors duration-300 group">
                View Catalog 
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-px bg-slate-200/80 rounded-3xl overflow-hidden border border-slate-200/80 shadow-sm">
            @foreach($relatedServices as $item)
                <div class="group relative flex flex-col justify-between p-8 bg-white transition-all duration-500 ease-out hover:bg-slate-50/50">
                    <div>
                        <div class="flex items-start justify-between gap-4 mb-6">
                            <div class="h-10 w-10 items-center justify-center rounded-xl bg-slate-50 border border-slate-200 text-slate-700 flex group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 group-hover:scale-105">
                                <i class="{{ $item->icon ?? 'bi bi-cpu' }} text-md"></i>
                            </div>
                            <span class="font-mono text-[10px] uppercase tracking-widest px-2 py-0.5 rounded border bg-slate-100 border-slate-200 text-slate-500">
                                {{ $item->category->name ?? 'MODULE' }}
                            </span>
                        </div>

                        <h3 class="text-lg font-bold tracking-tight text-slate-900 mb-2 transition-colors duration-300 group-hover:text-indigo-500" style="font-family: 'Poppins', sans-serif;">
                            {{ $item->title }}
                        </h3>

                        <p class="text-sm leading-relaxed text-slate-500 mb-8">
                            {{ Str::limit(strip_tags($item->description), 110) }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('services.show', $item->slug) }}" class="inline-flex items-center gap-2 text-xs font-mono tracking-wider uppercase font-semibold text-slate-600 hover:text-indigo-600 transition-all duration-300">
                            Explore Module <i class="bi bi-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════════
     CLOSING CONTEXT CALL TO ACTION (CTA)
═══════════════════════════════════════════════════ --}}
<section class="bg-indigo-600 py-24 text-white relative overflow-hidden">
    {{-- Fluid Circular Backplate Gradients --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500 rounded-full blur-3xl opacity-30 pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-700 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

    <div class="container mx-auto px-6 relative z-10 max-w-4xl text-center space-y-6">
        <h2 class="text-3xl md:text-5xl font-extrabold tracking-tight" style="font-family: 'Poppins', sans-serif;">
            Ready to integrate this system architecture?
        </h2>
        <p class="text-indigo-100 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            Let's construct an optimized solution. Connect directly with our engineering advisory ecosystem for detailed scoping.
        </p>
        <div class="pt-4">
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-white hover:bg-slate-50 text-indigo-600 font-bold text-sm tracking-wide shadow-xl shadow-indigo-900/20 transition-all duration-300 hover:-translate-y-0.5 group">
                Establish Direct Consultation 
                <i class="bi bi-arrow-right transform group-hover:translate-x-0.5 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

@endsection