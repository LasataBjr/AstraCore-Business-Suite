<!-- <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

    <h1 class="text-xl font-display text-slate-850">
        Dashboard
    </h1>

    <div class="flex items-center gap-4">

        <span class="text-gray-600">
            Admin
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 hover:text-red-700">
                Logout
            </button>
        </form>

    </div>

</header>    -->
<header class="sticky top-0 z-10 flex h-16 flex-shrink-0 items-center gap-4 border-b border-slate-200 bg-white/95 backdrop-blur-md px-4 sm:px-6 lg:px-8">
 
    {{-- ── MOBILE HAMBURGER ────────────────────── --}}
    <button
        @click="sidebarOpen = true" 
        class="lg:hidden flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors"
        aria-label="Open navigation"
    >
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
    </button>
 
    {{-- ── PAGE TITLE + BREADCRUMB ─────────────── --}}
    <div class="flex-1 min-w-0">
        <h1 class="text-[15px] font-semibold text-slate-800 truncate font-display">
            @yield('page-title', 'Dashboard')
        </h1>
 
        {{-- Breadcrumb (optional) --}}
        @hasSection('breadcrumb')
            <nav class="flex items-center gap-1 text-[11px] text-slate-400 mt-0.5" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors">Home</a>
                @yield('breadcrumb')
            </nav>
        @endif
    </div>
 
    {{-- ── RIGHT SIDE ACTIONS ───────────────────── --}}
    <div class="flex items-center gap-2 flex-shrink-0">
 
        {{-- View site button --}}
        <a
            href="{{ url('/') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="hidden sm:inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-medium text-slate-500 hover:border-slate-300 hover:text-slate-700 transition-all"
        >
            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            View Site
        </a>
 
        {{-- Notification bell --}}
        <div class="relative" x-data="{ open: false }">
            <button
                @click="open = !open"
                class="relative flex h-9 w-9 items-center justify-center rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 transition-colors"
                aria-label="Notifications"
            >
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0"/>
                </svg>
                @if (($unreadMessages ?? 0) > 0)
                    <span class="absolute top-1.5 right-1.5 flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-indigo-500"></span>
                    </span>
                @endif
            </button>
 
            {{-- Notification dropdown --}}
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                class="absolute right-0 mt-2 w-72 rounded-xl border border-slate-200 bg-white shadow-lg shadow-slate-200/60 overflow-hidden"
                style="top: 100%;"
            >
                <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
                    <p class="text-sm font-semibold text-slate-700">Notifications</p>
                    @if (($unreadMessages ?? 0) > 0)
                        <span class="rounded-full bg-indigo-100 px-2 py-0.5 text-[10px] font-semibold text-indigo-700">{{ $unreadMessages }} new</span>
                    @endif
                </div>
             
                @if (($unreadMessages ?? 0) > 0)
                    <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-slate-50 transition-colors border-b border-slate-100">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-amber-100 text-amber-600 flex-shrink-0">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75"/>
                            </svg>
                        </span>
                        <span>You have <strong>{{ $unreadMessages }}</strong> unread message{{ $unreadMessages > 1 ? 's' : '' }}</span>
                    </a>
                @else
                    <p class="px-4 py-6 text-center text-sm text-slate-400">All caught up!</p>
                @endif
                <div class="px-4 py-2 bg-slate-50">
                    <a href="#" class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors">View all messages →</a>
                </div>
            </div>
        </div>
 
        {{-- User avatar + dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button
                @click="open = !open"
                class="flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-xs font-semibold text-indigo-700 hover:bg-indigo-200 transition-colors uppercase"
                aria-label="User menu"
                aria-haspopup="true"
            >
                <!-- // Show first 2 initials of user's name (e.g. "John Doe" => "JD", "Alice" => "A") -->
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->name ?? 'Ad', ' '), 1, 1) ?: substr(Auth::user()->name ?? 'Ad', 1, 1)) }} 
            </button>
 
            {{-- User dropdown --}}
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                class="absolute right-0 mt-2 w-56 rounded-xl border border-slate-200 bg-white shadow-lg shadow-slate-200/60 overflow-hidden"
                style="top: 100%;"
                role="menu"
            >
                {{-- User info --}}
                <div class="px-4 py-3 border-b border-slate-100">
                    <p class="text-sm font-semibold text-slate-700 truncate">{{ Auth::user()->name ?? 'Admin User' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email ?? 'admin@astracore.com' }}</p>
                </div>
 
                {{-- Menu items --}}
                <div class="py-1">
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2.5 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-slate-900 transition-colors" role="menuitem">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Profile Settings
                    </a>
                   
                </div>
 
                {{-- Logout --}}
                <div class="border-t border-slate-100 py-1">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="flex w-full items-center gap-2.5 px-4 py-2 text-sm text-red-500 hover:bg-red-50 hover:text-red-700 transition-colors"
                            role="menuitem"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                            </svg>
                            Log out
                        </button>
                    </form>
                </div>
            </div>
        </div>
 
    </div>
 
</header>