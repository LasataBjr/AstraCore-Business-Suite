

@php
    $setting  = app(\App\Models\SiteSetting::class)::first();
    $siteName  = $setting?->site_name  ?? config('app.name', 'AstraCore');
    $tagline   = $setting?->tagline    ?? 'Building modern digital experiences';
    $email     = $setting?->email      ?? null;
    $phone     = $setting?->phone      ?? null;
    $address   = $setting?->address    ?? null;
    $facebook  = $setting?->facebook   ?? null;
    $linkedin  = $setting?->linkedin   ?? null;
    $instagram = $setting?->instagram  ?? null;
    $logo      = $setting?->logo ? Storage::url($setting->logo) : null;
    $footerTxt = $setting?->footer_text ?? '© ' . date('Y') . ' ' . $siteName . '. All rights reserved.';
@endphp

<footer class="bg-[#0f172a] text-slate-400" role="contentinfo">

    {{-- ── DECORATIVE TOP BORDER ─────────────────────────── --}}
    <div class="h-px bg-gradient-to-r from-transparent via-indigo-500/40 to-transparent"></div>


    {{-- ── MAIN FOOTER GRID ────────────────────────────────── --}}
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-5">

            {{-- ── Brand column (2/5) ──────────────────────── --}}
            <div class="lg:col-span-2">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-5 group" aria-label="{{ $siteName }} home">
                    @if ($logo)
                        <img src="{{ $logo }}" alt="{{ $siteName }}" class="h-9 w-auto"/>
                    @else
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/20 ring-1 ring-indigo-500/30 group-hover:bg-indigo-500/30 transition-colors">
                            <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                            </svg>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm font-bold text-white" style="font-family:'Syne',sans-serif">{{ $siteName }}</p>
                        <p class="text-[10px] text-slate-500">Business Suite</p>
                    </div>
                </a>

                <p class="text-sm text-slate-400 leading-relaxed max-w-xs mb-6">
                    {{ $tagline }}. We craft thoughtful digital solutions for modern businesses.
                </p>

                {{-- Contact info --}}
                <div class="space-y-2.5 text-sm">
                    @if ($email)
                    <a href="mailto:{{ $email }}" class="flex items-center gap-2.5 text-slate-400 hover:text-indigo-400 transition-colors">
                        <svg class="h-4 w-4 flex-shrink-0 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                        </svg>
                        {{ $email }}
                    </a>
                    @endif
                    @if ($phone)
                    <a href="tel:{{ preg_replace('/\D/', '', $phone) }}" class="flex items-center gap-2.5 text-slate-400 hover:text-indigo-400 transition-colors">
                        <svg class="h-4 w-4 flex-shrink-0 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/>
                        </svg>
                        {{ $phone }}
                    </a>
                    @endif
                    @if ($address)
                    <div class="flex items-start gap-2.5">
                        <svg class="h-4 w-4 flex-shrink-0 text-slate-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/>
                        </svg>
                        <span class="text-slate-400 leading-relaxed">{{ $address }}</span>
                    </div>
                    @endif
                </div>

                {{-- Social icons --}}
                @if ($facebook || $linkedin || $instagram)
                <div class="mt-6 flex items-center gap-2">
                    @if ($linkedin)
                    <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-400 hover:border-indigo-500/40 hover:bg-indigo-500/10 hover:text-indigo-400 transition-all"
                        aria-label="{{ $siteName }} on LinkedIn">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                    @endif
                    @if ($facebook)
                    <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-400 hover:border-blue-500/40 hover:bg-blue-500/10 hover:text-blue-400 transition-all"
                        aria-label="{{ $siteName }} on Facebook">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    @endif
                    @if ($instagram)
                    <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer"
                        class="flex h-9 w-9 items-center justify-center rounded-xl border border-white/10 bg-white/5 text-slate-400 hover:border-pink-500/40 hover:bg-pink-500/10 hover:text-pink-400 transition-all"
                        aria-label="{{ $siteName }} on Instagram">
                        <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>

            {{-- ── Company links ────────────────────────── --}}
            <div>
                <h4 class="mb-5 text-xs font-semibold uppercase tracking-widest text-slate-500">Company</h4>
                <ul class="space-y-3 text-sm" role="list">
                    @foreach ([
                        ['Home',     '/'],
                        ['About Us', '/about'],
                        ['Our Team', '/team'],
                        ['Contact',  '/contact'],
                    ] as [$label, $href])
                    <li>
                        <a href="{{ url($href) }}" class="text-slate-400 hover:text-indigo-400 transition-colors">{{ $label }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Services links ───────────────────────── --}}
            <div>
                <h4 class="mb-5 text-xs font-semibold uppercase tracking-widest text-slate-500">Services</h4>
                <ul class="space-y-3 text-sm" role="list">
                    @foreach ([
                        ['All Services', '/services'],
                        ['Our Projects', '/projects'],
                    ] as [$label, $href])
                    <li>
                        <a href="{{ url($href) }}" class="text-slate-400 hover:text-indigo-400 transition-colors">{{ $label }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- ── Resources links ──────────────────────── --}}
            <div>
                <h4 class="mb-5 text-xs font-semibold uppercase tracking-widest text-slate-500">Resources</h4>
                <ul class="space-y-3 text-sm" role="list">
                    @foreach ([
                        ['Blog',         '/blog'],
                        ['Privacy Policy','/privacy-policy'],
                        ['Terms & Conditions', '/terms-conditions'],
                    ] as [$label, $href])
                    <li>
                        <a href="{{ url($href) }}" class="text-slate-400 hover:text-indigo-400 transition-colors">{{ $label }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>

    {{-- ── BOTTOM BAR ──────────────────────────────────────── --}}
    <div class="border-t border-white/[0.06]">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-5">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                {{-- Copyright --}}
                <p class="text-xs text-slate-500">{{ $footerTxt }}</p>

                {{-- Back to top --}}
                <button
                    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    class="inline-flex items-center gap-1.5 text-xs text-slate-500 hover:text-indigo-400 transition-colors self-start sm:self-auto"
                    aria-label="Back to top"
                >
                    Back to top
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

</footer>