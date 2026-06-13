<header
    x-data="{
        mobileOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 40;
            });
        }
    }"
    :class="scrolled ? 'bg-slate-900/95 backdrop-blur-md shadow-lg shadow-black/20' : 'bg-transparent'"
    class="fixed inset-x-0 top-0 z-50 transition-all duration-300"
    role="banner"
>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-18 items-center justify-between py-4">
 
            {{-- ── LOGO ──────────────────────────────────── --}}
            <a href="#" class="flex items-center gap-3 group" aria-label="{{ $setting->site_name }} home">
                @if ($setting->logo)
                    <img src="{{ $setting->logo }}" alt="{{ $setting->site_name }} logo" class="h-9 w-auto"/>
                @else
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/20 ring-1 ring-indigo-500/40 group-hover:bg-indigo-500/30 transition-colors">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                        </svg>
                    </div>
                @endif
                <div class="leading-tight">
                    <span class="block text-sm font-bold text-white tracking-wide" style="font-family:'Syne',sans-serif">
                        {{ $setting->site_name }}
                    </span>
                    @if ($setting?->tagline)
                    <span class="block text-[10px] text-slate-400 leading-none">{{ $setting->tagline }}</span>
                    @endif
                </div>
            </a>
 
            {{-- ── DESKTOP NAV ────────────────────────────── --}}
            <nav class="hidden lg:flex items-center gap-1" aria-label="Main navigation">
                @foreach ([
                    ['Home',     '/',          'public.home'],
                    ['About',    '/about',     'public.about'],
                    ['Services', '/services',  'public.services'],
                    ['Projects', '/projects',  'public.projects'],
                    ['Blog',     '/blog',      'public.blog'],
                   
                ] as [$label, $href, $route])
                <a
                    href="{{ url($href) }}"
                    class="relative px-4 py-2 rounded-lg text-sm font-medium transition-all duration-150
                        {{ request()->routeIs($route)
                            ? 'text-white bg-white/10'
                            : 'text-slate-300 hover:text-white hover:bg-white/8' }}"
                >
                    {{ $label }}
                    @if (request()->routeIs($route))
                    <span class="absolute bottom-0.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-indigo-400"></span>
                    @endif
                </a>
                @endforeach
            </nav>
 
            {{-- ── CTA + MOBILE TOGGLE ────────────────────── --}}
            <div class="flex items-center gap-3">
 
                {{-- CTA button --}}
                <a
                    href="#"
                    class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white
                        hover:bg-indigo-500 active:bg-indigo-700 transition-colors shadow-sm shadow-indigo-900/30"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                    Get in Touch
                </a>
 
                {{-- Mobile hamburger --}}
                <button
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden flex h-10 w-10 items-center justify-center rounded-xl text-slate-300 hover:text-white hover:bg-white/10 transition-colors"
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
 
    {{-- ── MOBILE DRAWER ──────────────────────────────────── --}}
    <div
        id="mobile-menu"
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @click.outside="mobileOpen = false"
        class="lg:hidden border-t border-white/10 bg-slate-900/98 backdrop-blur-xl"
        style="display:none"
    >
        <nav class="mx-auto max-w-7xl px-4 py-4 space-y-1" aria-label="Mobile navigation">
            @foreach ([
                ['Home',     '/',          'public.home'],
                ['About',    '/about',     'public.about'],
                ['Services', '/services',  'public.services'],
                ['Projects', '/projects',  'public.projects'],
                ['Blog',     '/blog',      'public.blog'],
                ['Team',     '/team',      'public.team'],
                ['Contact',  '/contact',   'public.contact'],
            ] as [$label, $href, $route])
            <a
                href="{{ url($href) }}"
                @click="mobileOpen = false"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-medium transition-all
                    {{ request()->routeIs($route)
                        ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/20'
                        : 'text-slate-300 hover:bg-white/8 hover:text-white' }}"
            >
                {{ $label }}
                @if (request()->routeIs($route))
                <svg class="ml-auto h-4 w-4 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
                </svg>
                @endif
            </a>
            @endforeach
        </nav>
 
        {{-- Mobile CTA --}}
        <div class="mx-auto max-w-7xl px-4 pb-5">
            <a
                href="{{ url('/contact') }}"
                class="flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-500 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75"/>
                </svg>
                Get in Touch
            </a>
        </div>
    </div>
</header>
 
{{-- Spacer so content doesn't hide under fixed navbar --}}
<div class="h-[72px]"></div>