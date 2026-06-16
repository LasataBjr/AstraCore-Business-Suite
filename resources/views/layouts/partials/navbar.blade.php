<header
    x-data="{
        mobileOpen: false, // Controls mobile drawer visibility
        scrolled: false, // Tracks scroll position for header styling
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 40; // Threshold for header style change
            });
        }
    }"
    :class="scrolled ? 'bg-slate-950/80 backdrop-blur-md border-b border-white/5 shadow-xl shadow-black/40' : 'bg-transparent border-b border-transparent'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
    role="banner"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
 
            {{-- ── LOGO ARCHITECTURE ──────────────────────────────────── --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 group" aria-label="{{ $setting->site_name }} home">
                @if ($setting->logo)
                    <img src="{{ $setting->logo }}" alt="{{ $setting->site_name }} logo" class="h-9 w-auto object-contain"/>
                @else
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/10 border border-indigo-500/20 group-hover:bg-indigo-500/20 group-hover:border-indigo-500/40 transition-all duration-300 shadow-[0_0_20px_rgba(99,102,241,0.1)]">
                        <svg class="h-5 w-5 text-indigo-400 transform group-hover:scale-105 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                        </svg>
                    </div>
                @endif
                <div class="leading-tight">
                    <span class="block text-sm font-extrabold text-white tracking-wider uppercase group-hover:text-indigo-400 transition-colors duration-200" style="font-family: 'Poppins', sans-serif;">
                        {{ $setting->site_name }}
                    </span>
                    @if ($setting?->tagline)
                        <span class="block text-[10px] font-mono tracking-wide text-slate-400 leading-none mt-0.5 uppercase">{{ $setting->tagline }}</span>
                    @endif
                </div>
            </a>
 
            {{-- ── DESKTOP NAVIGATION MATRIX ────────────────────────────── --}}
            <nav class="hidden lg:flex items-center gap-1 bg-white/5 border border-white/5 rounded-2xl p-1 backdrop-blur-sm" aria-label="Main navigation">
                @foreach ([
                    ['Home',     '/',          'public.home',            ''],
                    ['About',    '/about',     'public.about',           'about*'],
                    ['Services', '/services',  'public.services*',       'services*'],
                    ['Projects', '/projects',  'public.projects*',       'projects*'],
                    ['Blogs',    '/blogposts', 'public.blogposts.index', 'blogposts*'],
                ] as [$label, $href, $route, $pathPattern])
                
                @php
                    // Evaluates true if named route matches or if structural URI pattern matches
                    $isActive = request()->routeIs($route) || ($pathPattern && request()->is($pathPattern));
                @endphp

                <a
                    href="{{ url($href) }}"
                    class="relative px-4 py-2 rounded-xl text-xs font-mono uppercase tracking-wider font-semibold transition-all duration-200
                        {{ $isActive
                            ? 'text-white bg-indigo-600 shadow-md shadow-indigo-600/10 border border-indigo-500/20'
                            : 'text-slate-300 hover:text-white border border-transparent hover:bg-white/5' }}"
                >
                    {{ $label }}
                </a>
                @endforeach
            </nav>
 
            {{-- ── CTA CONTROL + MOBILE ACTION CONTROLLERS ────────────────── --}}
            <div class="flex items-center gap-4">
 
                {{-- Action Pipeline Launch CTA --}}
                <a
                    href="{{ url('/contact') }}"
                    class="hidden sm:inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-xs font-mono uppercase tracking-wider font-bold shadow-lg transition-all duration-300 hover:-translate-y-0.5 group
                        {{ request()->routeIs('contact') || request()->is('contact*')
                            ? 'bg-indigo-500 text-white shadow-indigo-500/20'
                            : 'bg-indigo-600 text-white hover:bg-indigo-500 shadow-indigo-600/20' }}"
                >
                    Get in Touch
                    <i class="bi bi-arrow-right transform group-hover:translate-x-0.5 transition-transform text-xs"></i>
                </a>
 
                {{-- Mobile Drawer Interface Toggle Button --}}
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden flex h-11 w-11 items-center justify-center rounded-xl border border-slate-800 bg-slate-900/50 text-slate-300 hover:text-white hover:bg-slate-800 transition-colors"
                    :aria-expanded="mobileOpen.toString()"
                    aria-controls="mobile-menu"
                    aria-label="Toggle navigation"
                >
                    <svg x-show="!mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <svg x-show="mobileOpen" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
 
    {{-- ── MOBILE OVERLAY DRAWER ──────────────────────────────────── --}}
    <div
        id="mobile-menu"
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.outside="mobileOpen = false"
        class="lg:hidden border-t border-white/5 bg-slate-950/98 backdrop-blur-xl shadow-2xl"
        style="display:none"
    >
        <nav class="mx-auto max-w-7xl px-4 py-5 space-y-1.5" aria-label="Mobile navigation">
            @foreach ([
                ['Home',     '/',          'public.home',            ''],
                ['About',    '/about',     'public.about',           'about*'],
                ['Services', '/services',  'public.services*',       'services*'],
                ['Projects', '/projects',  'public.projects*',       'projects*'],
                ['Blogs',    '/blogposts', 'public.blogposts.index', 'blogposts*'],
                ['Contact',  '/contact',   'contact',                'contact*'],
            ] as [$label, $href, $route, $pathPattern])

            @php
                $isMobileActive = request()->routeIs($route) || ($pathPattern && request()->is($pathPattern));
            @endphp

            <a
                href="{{ url($href) }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-xs font-mono uppercase tracking-wider font-semibold transition-all
                    {{ $isMobileActive
                        ? 'bg-indigo-600/10 text-indigo-400 border border-indigo-500/20'
                        : 'text-slate-300 border border-transparent hover:bg-white/5 hover:text-white' }}"
            >
                {{ $label }}
                @if ($isMobileActive)
                    <span class="ml-auto h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                @endif
            </a>
            @endforeach
        </nav>
 
        {{-- Mobile Operational Launch CTA --}}
        <div class="mx-auto max-w-7xl px-4 pb-6">
            <a
                href="{{ url('/contact') }}"
                class="flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-xs font-mono uppercase tracking-wider font-bold text-white hover:bg-indigo-500 transition-colors"
            >
                Get in Touch <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</header>
 
{{-- Precise Height Spacer Compensation Node --}}
<div class="h-20"></div>