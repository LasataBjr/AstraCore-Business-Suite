@extends('layouts.public')

@section('title', 'Terms & Conditions — AstraCore')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO HEADER SECTION
═══════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-navy-950 pt-32 pb-16 border-b border-navy-900">
    {{-- Animated drift grid pattern --}}
    <div class="about-hero-grid absolute inset-0 pointer-events-none" aria-hidden="true"></div>

    {{-- Subtle glowing background ambient --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[300px] rounded-full bg-indigo-500/5 blur-[100px]"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <p class="font-mono text-xs tracking-widest text-indigo-400 uppercase mb-4 opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.1s]">
            Operating Rules
        </p>
        
        <h1 class="font-display font-bold text-white tracking-tight leading-tight mb-6 text-4xl sm:text-5xl lg:text-6xl opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.22s]" style="font-family:'Syne', sans-serif">
            Terms & <span class="bg-gradient-to-r from-[#7485ff] via-[#5560f8] to-[#9db0ff] bg-clip-text text-transparent">Conditions</span>
        </h1>

        <p class="font-sans text-sm text-slate-400 max-w-md mx-auto leading-relaxed opacity-0 transform translate-y-4 animate-[fadeUp_0.5s_ease_forwards_0.34s]">
            Please read these terms carefully before engaging with our digital architecture and services.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     TERMS CONTENT AREA
═══════════════════════════════════════════════════ --}}
<section class="py-24 bg-slate-950 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        
        {{-- Main Document Card Wrapper --}}
        <div class="relative bg-navy-900/40 border border-navy-800/80 rounded-2xl p-8 md:p-12 shadow-xl backdrop-blur-sm space-y-10">
            
            {{-- Technical Corner Border Element --}}
            <div class="absolute -top-px -left-px w-12 h-12 border-t border-l border-indigo-500/30 rounded-tl-2xl pointer-events-none"></div>
            
            <div class="font-sans text-slate-300 space-y-10 leading-relaxed text-[15px]">
                
                {{-- 1. Acceptance of Terms --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">01</span>
                        Acceptance of Terms
                    </h2>
                    <p class="text-slate-400">
                        By accessing and leveraging this web platform, you definitively accept and agree to remain strictly bound by these Terms and Conditions. If you mismatch or disagree with any structural piece of these deployment metrics, please cleanly discontinue system use.
                    </p>
                </div>

                {{-- 2. Services --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">02</span>
                        Services
                    </h2>
                    <p class="text-slate-400">
                        We provide high-fidelity web development, full-stack software architecture engineering, dedicated cloud consulting, and modular digital solutions. Any precise engineering project agreements, scope frameworks, pricing matrices, and production deadlines will be fully governed by individual separate contracts signed directly between AstraCore and its clients.
                    </p>
                </div>

                {{-- 3. Intellectual Property --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">03</span>
                        Intellectual Property
                    </h2>
                    <p class="text-slate-400">
                        All application content deployed on this environment—including layout interfaces, specialized typography variables, vectorized graphic styles, brand marks, underlying source code blocks, and rich media files—is the exclusive layout property of AstraCore unless explicitly stated otherwise. Everything is thoroughly locked and defended under prevailing copyright frameworks.
                    </p>
                </div>

                {{-- 4. User Responsibilities --}}
                <div class="space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">04</span>
                        User Responsibilities
                    </h2>
                    <p class="text-slate-400">As a structural system operator, you explicitly pledge to:</p>
                    
                    <ul class="grid sm:grid-cols-2 gap-3 pt-1">
                        @foreach([
                            'Provide valid, authentic metadata details inside contact form structures.',
                            'Refrain from reverse-engineering or attempting to break database assets.',
                            'Avoid pushing toxic exploit vectors, injection layers, or hostile malware.',
                            'Maintain alignment with all active municipal and global cyber laws.'
                        ] as $responsibility)
                            <li class="flex items-start gap-3 text-sm text-slate-300 bg-navy-950/40 border border-navy-800 rounded-xl px-4 py-3">
                                <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
                                </svg>
                                <span class="text-slate-400 leading-snug">{{ $responsibility }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- 5. Third-Party Links --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">05</span>
                        Third-Party Links
                    </h2>
                    <p class="text-slate-400">
                        Our internal design configurations might branch out into links pointing toward external target systems. AstraCore exercises zero technical management over those platforms and accepts no accountability for their structural safety, layout rules, or specific user parsing routines.
                    </p>
                </div>

                {{-- 6. Limitation of Liability --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">06</span>
                        Limitation of Liability
                    </h2>
                    <p class="text-slate-400">
                        Under no operational standard shall AstraCore be held legally accountable for any accidental server drops, consequential data losses, performance drops, or commercial deviations caused by interacting with this website architecture or utilizing our external product releases.
                    </p>
                </div>

                {{-- 7. Privacy --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">07</span>
                        Privacy
                    </h2>
                    <p class="text-slate-400">
                        Your system navigation behavior is concurrently validated and governed under our comprehensive Privacy Policy framework. We highly advise a systematic audit of that structure to evaluate data compression and telemetry safeguards.
                    </p>
                </div>

                {{-- 8. Modifications --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">08</span>
                        Modifications
                    </h2>
                    <p class="text-slate-400">
                        We preserve the clean systemic authority to swap, modify, or deprecate segments of these Operating Rules at absolute discretion without tracking upfront notices. Persisting in active script execution post-revision verifies your legal handshake with the updated policy.
                    </p>
                </div>

                {{-- 9. Governing Law --}}
                <div class="space-y-3">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">09</span>
                        Governing Law
                    </h2>
                    <p class="text-slate-400">
                        These structural terms, operations matrices, and transaction protocols are natively parsed, analyzed, and controlled in total conformity with the sovereign cyber statutes and judicial courts of **Nepal**.
                    </p>
                </div>

                {{-- 10. Contact Information --}}
                <div class="pt-8 border-t border-navy-800/80 space-y-4">
                    <h2 class="font-display font-bold text-white text-xl sm:text-2xl flex items-center gap-3">
                        <span class="font-mono text-xs font-medium text-indigo-400 bg-indigo-500/10 px-2 py-1 rounded-md border border-indigo-500/20">10</span>
                        Contact System Admin
                    </h2>
                    <p class="text-slate-400 text-sm">
                        If you encounter structural conflicts with these operating guidelines or seek high-level contract validation clarity, open a secure stream to our team directly:
                    </p>

                    <div class="pt-2">
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl border border-indigo-500/30 bg-indigo-500/10 text-indigo-300 font-mono text-xs hover:bg-indigo-500 hover:text-white transition-all duration-200">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 01-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                            Secure Contact Stream
                        </a>
                    </div>
                </div>

            </div>

            {{-- Footer Timestamp Row --}}
            <div class="pt-6 border-t border-navy-800/60 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <p class="font-sans text-xs text-slate-500">
                    System Architecture ID: <span class="font-mono text-slate-600">AC-2026-TERMS</span>
                </p>
                <p class="font-sans text-xs text-slate-500">
                    Last Compiled: <span class="font-mono text-indigo-300/60">{{ now()->format('F d, Y') }}</span>
                </p>
            </div>

        </div>

    </div>
</section>

@endsection