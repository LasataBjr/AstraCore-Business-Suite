<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23818cf8' stroke-width='1.8'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z'/%3E%3C/svg%3E">
    <title>@yield('title', 'Admin') — AstraCore</title>

    {{-- Google Fonts: DM Sans (body) + Syne (display) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@600;700&display=swap" rel="stylesheet" />

    {{-- Vite (Tailwind CSS + Alpine JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

{{--
    Alpine x-data on body:
      sidebarOpen      → controls mobile drawer
      sidebarCollapsed → controls desktop collapse
--}}
<body
    class="h-full bg-slate-50 font-sans antialiased text-slate-800"
    x-data="{ sidebarOpen: false, sidebarCollapsed: false }"
>

    {{-- =====================================================
         MOBILE OVERLAY (tap outside to close sidebar)
    ====================================================== --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/40 lg:hidden"
        aria-hidden="true"
    ></div>

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}
    @include('layouts.partials.sidebar')

    {{-- =====================================================
         MAIN CONTENT WRAPPER
         Shifts right on desktop based on sidebar state
    ====================================================== --}}
    <div
        class="flex min-h-full flex-col transition-all duration-300 ease-in-out"
        :class="sidebarCollapsed ? 'lg:pl-[70px]' : 'lg:pl-64'"
    >

        {{-- =====================================================
             HEADER / TOP BAR
        ====================================================== --}}
        @include('layouts.partials.header')

        {{-- =====================================================
             FLASH MESSAGES
        ====================================================== --}}
        <div class="px-4 sm:px-6 lg:px-8 mt-4 space-y-3">

            @if (session('success'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-transition:leave="transition-opacity duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                    role="alert"
                >
                    <svg class="h-4 w-4 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-emerald-400 hover:text-emerald-600 transition-colors" aria-label="Dismiss">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition:leave="transition-opacity duration-500"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="flex items-center gap-3 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                    role="alert"
                >
                    <svg class="h-4 w-4 flex-shrink-0 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto text-red-400 hover:text-red-600 transition-colors" aria-label="Dismiss">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                    <p class="font-medium mb-1">Please fix the following errors:</p>
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

        {{-- =====================================================
             PAGE CONTENT
        ====================================================== --}}
        <main class="flex-1 px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>

        {{-- =====================================================
             FOOTER
        ====================================================== --}}
        <footer class="border-t border-slate-200 bg-white px-4 sm:px-6 lg:px-8 py-4">
            <p class="text-xs text-slate-400">
                &copy; {{ date('Y') }} <span class="font-medium text-slate-500">AstraCore Business Suite</span>. All rights reserved.
            </p>
        </footer>

    </div>{{-- end main wrapper --}}

    @stack('scripts')

</body>
</html>