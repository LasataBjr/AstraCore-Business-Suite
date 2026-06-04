<!-- <aside class="w-64 min-h-screen bg-slate-950 text-white">
    <div class="p-6">
        <h1 class="font-display text-2xl font-bold">
            AstraCore
        </h1>
    </div>

    <nav class="px-4 font-sans">
        <a href="#" class="block py-2 px-3 rounded hover:bg-slate-850">
            Dashboard
        </a>

        <a href="#" class="block py-2 px-3 rounded hover:bg-slate-850">
            Services
        </a>

        <a href="#" class="block py-2 px-3 rounded hover:bg-slate-850">
            Projects
        </a>
    </nav>
</aside> -->
{{--
    Sidebar Partial
    Path: resources/views/layouts/partials/sidebar.blade.php
 
    Uses Alpine.js variables from parent x-data:
      - sidebarOpen      (mobile drawer toggle)
      - sidebarCollapsed (desktop icon-only mode)
--}}
 
<aside
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0',
        sidebarCollapsed ? 'lg:w-[70px]' : 'lg:w-64'
    ]"
    class="fixed inset-y-0 left-0 z-30 flex w-64 flex-col bg-[#1a2235] transition-all duration-300 ease-in-out"
    aria-label="Sidebar navigation"
>
 
    {{-- ── LOGO ────────────────────────────────── --}}
    <div class="flex h-16 flex-shrink-0 items-center justify-between border-b border-white/[0.07] px-4">
 
        {{-- Logo mark + text --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 min-w-0">
            <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-xl bg-indigo-500/20 ring-1 ring-indigo-500/30">
                <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>
            </div>
            <div x-show="!sidebarCollapsed" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="min-w-0">
                <p class="text-sm font-bold text-white tracking-wide font-display leading-tight">AstraCore</p>
                <p class="text-[10px] text-slate-500 leading-tight">Business Suite</p>
            </div>
        </a>
 
        {{-- Collapse button (desktop only) --}}
        <button
            @click="sidebarCollapsed = !sidebarCollapsed"
            x-show="!sidebarOpen"
            class="hidden lg:flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg text-slate-500 hover:bg-white/5 hover:text-slate-300 transition-colors"
            :title="sidebarCollapsed ? 'Expand sidebar' : 'Collapse sidebar'"
            aria-label="Toggle sidebar"
        >
            <svg :class="sidebarCollapsed ? 'rotate-180' : ''" class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"/>
            </svg>
        </button>
 
        {{-- Mobile close button --}}
        <button
            @click="sidebarOpen = false"
            class="lg:hidden flex h-7 w-7 items-center justify-center rounded-lg text-slate-500 hover:text-slate-300 transition-colors"
            aria-label="Close sidebar"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
 
    </div>
 
    {{-- ── NAVIGATION ──────────────────────────── --}}
    <nav class="flex-1 overflow-y-auto overflow-x-hidden py-4 space-y-0.5 scrollbar-thin scrollbar-track-transparent scrollbar-thumb-slate-700" aria-label="Main navigation">
 
        {{-- Group: Main --}}
        <div class="px-3">
            <p x-show="!sidebarCollapsed" class="mb-1.5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-600 select-none">Main</p>
 
            @php
                $navMain = [
                    ['route' => 'admin.dashboard',  'label' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'badge' => 0],
                    ['route' => 'admin.messages.index', 'label' => 'Messages', 'icon' => 'M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75', 'badge' => $unreadMessages ?? 0],
                ];
            @endphp
 
            @foreach ($navMain as $item)
                @include('layouts.partials.sidebar-item', $item)
            @endforeach
        </div>
 
        {{-- Group: Content --}}
        <div class="px-3 pt-4">
            <p x-show="!sidebarCollapsed" class="mb-1.5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-600 select-none">Content</p>
 
            @php
                $navContent = [
                    ['route' => 'admin.services.index',   'label' => 'Services',   'icon' => 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z', 'badge' => 0],
                    ['route' => 'admin.categories.index', 'label' => 'Categories', 'icon' => 'M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z', 'badge' => 0],
                    ['route' => 'admin.projects.index',   'label' => 'Projects',   'icon' => 'M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3', 'badge' => 0],
                    ['route' => 'admin.blog.index',       'label' => 'Blog Posts', 'icon' => 'M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z', 'badge' => 0],
                    ['route' => 'admin.blog-tags.index',  'label' => 'Blog Tags',  'icon' => 'M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z M6 6h.008v.008H6V6z', 'badge' => 0],
                ];
            @endphp
 
            @foreach ($navContent as $item)
                @include('layouts.partials.sidebar-item', $item)
            @endforeach
        </div>
 
        {{-- Group: People --}}
        <div class="px-3 pt-4">
            <p x-show="!sidebarCollapsed" class="mb-1.5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-600 select-none">People</p>
 
            @php
                $navPeople = [
                    ['route' => 'admin.team.index',         'label' => 'Team Members', 'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z', 'badge' => 0],
                    ['route' => 'admin.testimonials.index',  'label' => 'Testimonials', 'icon' => 'M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z', 'badge' => 0],
                    ['route' => 'admin.users.index',         'label' => 'Users',        'icon' => 'M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z', 'badge' => 0],
                ];
            @endphp
 
            @foreach ($navPeople as $item)
                @include('layouts.partials.sidebar-item', $item)
            @endforeach
        </div>
 
        {{-- Group: System --}}
        <div class="px-3 pt-4">
            <p x-show="!sidebarCollapsed" class="mb-1.5 px-3 text-[10px] font-semibold uppercase tracking-widest text-slate-600 select-none">System</p>
 
            @php
                $navSystem = [
                    ['route' => 'admin.settings.index', 'label' => 'Settings', 'icon' => 'M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'badge' => 0],
                ];
            @endphp
 
            @foreach ($navSystem as $item)
                @include('layouts.partials.sidebar-item', $item)
            @endforeach
        </div>
 
    </nav>
 
    {{-- ── USER PROFILE (bottom) ───────────────── --}}
    <div class="flex-shrink-0 border-t border-white/[0.07] p-3">
        <div class="flex items-center gap-3 rounded-xl px-2 py-2 hover:bg-white/5 transition-colors group cursor-pointer">
 
            {{-- Avatar initials --}}
            <div class="h-8 w-8 flex-shrink-0 rounded-lg bg-indigo-500/20 ring-1 ring-indigo-500/20 flex items-center justify-center text-xs font-semibold text-indigo-400 uppercase select-none">
                {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}{{ strtoupper(substr(strstr(Auth::user()->name ?? 'Ad', ' '), 1, 1) ?: substr(Auth::user()->name ?? 'Ad', 1, 1)) }}
            </div>
 
            <div x-show="!sidebarCollapsed" x-transition:enter="transition-opacity duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="flex-1 min-w-0">
                <p class="text-xs font-medium text-slate-300 truncate">{{ Auth::user()->name ?? 'Admin User' }}</p>
                <p class="text-[10px] text-slate-600 truncate">{{ Auth::user()->email ?? 'admin@astracore.com' }}</p>
            </div>
 
            <form method="POST" action="{{ route('logout') }}" x-show="!sidebarCollapsed">
                @csrf
                <button
                    type="submit"
                    title="Log out"
                    class="text-slate-600 hover:text-red-400 transition-colors"
                    aria-label="Log out"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
 
</aside>
 
{{--
    ── SIDEBAR NAV ITEM SUB-PARTIAL ────────────────────────────────────────────
    Included inline here so you don't need a separate file.
    But you CAN extract it to: layouts/partials/sidebar-item.blade.php
--}}