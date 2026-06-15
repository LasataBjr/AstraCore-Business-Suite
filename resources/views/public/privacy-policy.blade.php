@extends('layouts.public')

@section('title', 'Privacy Policy — AstraCore')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HEADER HEADER SECTION
═══════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-navy-950 pt-32 pb-16 border-b border-navy-900">
    {{-- Animated grid background pattern matching the about page --}}
    <div class="about-hero-grid absolute inset-0 pointer-events-none" aria-hidden="true"></div>

    {{-- Subtle cyan/indigo glow element --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] rounded-full bg-indigo-500/5 blur-[100px]"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <p class="font-mono text-xs tracking-widest text-indigo-400 uppercase mb-4 opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.1s]">
            Legal Framework
        </p>
        
        <h1 class="font-display font-bold text-white tracking-tight leading-tight mb-6 text-4xl sm:text-5xl lg:text-6xl opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.22s]" style="font-family:'Syne', sans-serif">
            Privacy <span class="bg-gradient-to-r from-[#7485ff] via-[#5560f8] to-[#9db0ff] bg-clip-text text-transparent">Policy</span>
        </h1>

        <p class="font-sans text-sm text-slate-500 opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.34s]">
            Last Updated: <span class="font-mono text-indigo-300/80">{{ now()->format('F d, Y') }}</span>
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     DOCUMENT TEXT CONTENT AREA
═══════════════════════════════════════════════════ --}}
<section class="py-24 bg-slate-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Legal document wrap --}}
        <div class="relative bg-navy-900/40 border border-navy-800/80 rounded-2xl p-8 md:p-12 shadow-xl backdrop-blur-sm">
            
            {{-- Accent Corner Design Border Element --}}
            <div class="absolute -top-px -left-px w-12 h-12 border-t border-l border-indigo-500/30 rounded-tl-2xl pointer-events-none"></div>
            
            {{-- Modern stylized legal text utilizing customized styling controls --}}
            <div class="font-sans text-slate-300 space-y-10 leading-relaxed text-[15px]">
                
                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">01</span>
                        Introduction
                    </h2>
                    <p class="text-slate-400">
                        AstraCore Business Suite values your privacy and is committed to protecting your personal information. This Privacy Policy explains how we collect, use, and safeguard your data infrastructure details when you visit our website platforms.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">02</span>
                        Information We Collect
                    </h2>
                    <p class="text-slate-400">We may securely parse and store the following metadata details:</p>
                    <ul class="grid sm:grid-cols-2 gap-3 pl-2 pt-2">
                        @foreach([
                            'Full Name & Identity Signatures',
                            'Business Email Addresses',
                            'Direct Phone Numbers',
                            'Corporate/Company Structural Parameters',
                            'Inbound Project Form Submissions',
                            'Anonymous Web Metrics & Behavioral Analytics'
                        ] as $item)
                            <li class="flex items-center gap-2.5 text-sm text-slate-300 bg-navy-950/40 border border-navy-800 rounded-xl px-4 py-3">
                                <svg class="w-4 h-4 text-indigo-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                </svg>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">03</span>
                        How We Use Your Information
                    </h2>
                    <p class="text-slate-400">Your processed operations profile entries may be managed to:</p>
                    <ul class="space-y-3 pl-1">
                        @foreach([
                            'Respond to architecture requests and technical consultations.',
                            'Deploy active, bespoke digital systems or code engineering services.',
                            'Optimize user experience states, styling profiles, and processing speeds across AstraCore.',
                            'Provide strategic updates regarding product version launches or service revisions.',
                            'Maintain absolute application security and safeguard against threat actions.'
                        ] as $use)
                            <li class="flex items-start gap-3 text-slate-400 text-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 mt-2 shrink-0"></span>
                                <span>{{ $use }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">04</span>
                        Contact Forms
                    </h2>
                    <p class="text-slate-400">
                        Information submitted through our inquiry portals is cached securely using encrypted databases. It is utilized exclusively for engineering workflow validation and communication regarding your active technical requests.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">05</span>
                        Cookies
                    </h2>
                    <p class="text-slate-400">
                        Our frameworks use storage cookies to persist layout styling states, track dynamic dark-theme selections, and monitor structural analytical tracking performance across sessions.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">06</span>
                        Third-Party Services
                    </h2>
                    <p class="text-slate-400">
                        We safely route metadata coordinates through essential infrastructure operators like database cloud storage environments, automated Git integration hosts, and Google Analytics. They manipulate limited system telemetry parameters exclusively to render requested components.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">07</span>
                        Data Security
                    </h2>
                    <p class="text-slate-400">
                        We apply strong encryption methodologies, safe script sanitation practices, and parameterized protection routes to defend your client transactions from cross-site injection vectors or information leakage.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">08</span>
                        Data Retention
                    </h2>
                    <p class="text-slate-400">
                        We maintain record storage parameters for minimal lifecycle intervals. Elements are completely scrubbed from active storage states when operational validation wraps up or legal directives expire.
                    </p>
                </div>

                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">09</span>
                        Your Rights
                    </h2>
                    <p class="text-slate-400">
                        You preserve full control over your recorded data profiles. You have complete rights to request an administrative read, database structural update, or full database record wipe at any point.
                    </p>
                </div>

                {{-- Section 10: Dynamic Support Coordinates --}}
                <div class="pt-8 border-t border-navy-800/80 space-y-5">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">10</span>
                        Contact System Support
                    </h2>
                    <p class="text-slate-400">
                        Reach out directly to clear up structural questions or execute your database profile modification rights:
                    </p>

                    <div class="grid sm:grid-cols-3 gap-4 pt-2">
                        <div class="bg-navy-950/60 border border-navy-800 rounded-xl p-4 flex flex-col gap-1.5">
                            <span class="font-mono text-[10px] tracking-widest text-indigo-400 uppercase">Secure Email</span>
                            <a href="mailto:{{ $setting->email ?? 'info@astracore.com' }}" class="text-sm font-semibold text-white hover:text-indigo-400 transition-colors truncate">
                                {{ $setting->email ?? 'info@astracore.com' }}
                            </a>
                        </div>
                        <div class="bg-navy-950/60 border border-navy-800 rounded-xl p-4 flex flex-col gap-1.5">
                            <span class="font-mono text-[10px] tracking-widest text-indigo-400 uppercase">Comms Line</span>
                            <span class="text-sm font-semibold text-white">
                                {{ $setting->phone ?? '+977-9800000000' }}
                            </span>
                        </div>
                        <div class="bg-navy-950/60 border border-navy-800 rounded-xl p-4 flex flex-col gap-1.5">
                            <span class="font-mono text-[10px] tracking-widest text-indigo-400 uppercase">Studio Base</span>
                            <span class="text-sm font-semibold text-white truncate">
                                {{ $setting->address ?? 'Kathmandu, Nepal' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection