<nav x-data="{ open: false }" class="bg-slate-900 border-b border-slate-800 shadow-lg shadow-slate-950/20 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                
                {{-- ── BRAND IDENTITY ELEMENT (LINKS BACK TO HOME) ──────── --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/admin/dashboard') }}" class="group flex items-center gap-3 focus:outline-none">
                        @if (isset($setting) && $setting->logo)
                            <img src="{{ $setting->logo }}" alt="{{ $setting->site_name ?? 'App' }} logo" class="h-9 w-auto object-contain transition-transform duration-300 group-hover:scale-105"/>
                        @else
                            {{-- Minimalist Abstract Vector Logo Token --}}
                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-500/10 border border-indigo-500/30 group-hover:bg-indigo-500/20 group-hover:border-indigo-400/40 transition-all duration-300 shadow-[0_0_20px_rgba(99,102,241,0.15)]">
                                <svg class="h-4 w-4 text-indigo-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Site Title Component --}}
                        <span class="font-bold text-base text-slate-100 tracking-tight transition-colors group-hover:text-white hidden sm:block" style="font-family: 'Poppins', sans-serif;">
                            {{ $setting->site_name ?? config('app.name', 'Laravel') }}
                        </span>
                    </a>
                </div>
            </div>

            {{-- ── INTERACTIVE SETTINGS DROPDOWN (DESKTOP) ─────────── --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2.5 px-3 py-2 rounded-xl border border-slate-800 bg-slate-950/40 text-sm font-medium text-slate-400 transition-all duration-150 hover:bg-slate-950/80 hover:text-slate-200 focus:outline-none focus:ring-4 focus:ring-slate-800/50">
                            {{-- Avatar Placeholder Node --}}
                            <div class="h-5 w-5 rounded-md bg-indigo-500 text-[10px] font-mono font-bold text-white flex items-center justify-center uppercase select-none shadow-sm shadow-indigo-500/20">
                                {{ mb_substr(Auth::user()->name, 0, 1) }}
                            </div>
                            
                            <div class="max-w-[120px] truncate text-xs font-semibold tracking-tight">{{ Auth::user()->name }}</div>

                            <svg class="fill-current h-3.5 w-3.5 text-slate-500 transition-transform duration-200" :class="{'transform rotate-180': open}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-3 py-2 border-b border-slate-100 bg-slate-50/50 rounded-t-lg">
                            <p class="text-[10px] font-mono uppercase tracking-wider text-slate-400 font-semibold">Active Account</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="text-slate-600 hover:text-slate-900 font-medium text-xs flex items-center gap-2">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            {{ __('Profile Settings') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:text-red-700 hover:bg-red-50/50 font-medium text-xs flex items-center gap-2">
                                <svg class="h-4 w-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- ── HAMBURGER INTERFACE CONTROLLER (MOBILE) ─────────── --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-slate-400 hover:text-slate-200 hover:bg-slate-800 focus:outline-none transition duration-150">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ── MOBILE RESPONSIVE CANVAS MENU PANEL ───────────────────── --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-slate-900 border-t border-slate-800 transition-all">
        <div class="py-4 bg-slate-950/40 px-4">
            <div class="flex items-center gap-3">
                <div class="h-8 w-8 rounded-xl bg-indigo-500 text-xs font-mono font-bold text-white flex items-center justify-center uppercase shadow-sm">
                    {{ mb_substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <div class="font-bold text-sm text-slate-200 leading-none">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-xs text-slate-500 mt-1.5 leading-none">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-4 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="rounded-xl text-xs text-slate-400 font-medium border-none hover:bg-slate-800 hover:text-slate-200">
                    {{ __('Profile Settings') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="rounded-xl text-xs text-red-400 font-semibold border-none hover:bg-red-950/30 hover:text-red-300">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>