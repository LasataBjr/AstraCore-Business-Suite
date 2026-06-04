<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'AstraCore') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Decorative grid pattern for left panel */
            .grid-pattern {
                background-image:
                    linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
                background-size: 40px 40px;
            }
    
            /* Glowing orb effect */
            .orb {
                position: absolute;
                border-radius: 9999px;
                filter: blur(80px);
                pointer-events: none;
            }
    
            /* Fade-in-up animation */
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(18px); }
                to   { opacity: 1; transform: translateY(0); }
            }
            .animate-fade-in-up {
                animation: fadeInUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
            }
            .delay-100 { animation-delay: 0.10s; }
            .delay-200 { animation-delay: 0.20s; }
            .delay-300 { animation-delay: 0.30s; }
            .delay-400 { animation-delay: 0.40s; }

        </style>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-300">
 
<div class="min-h-screen flex">
 
    {{-- ============================================================
         LEFT PANEL — Branding / Decorative
    ============================================================ --}}
    <div class="hidden lg:flex lg:w-[45%] xl:w-[50%] relative flex-col bg-[#0f172a] grid-pattern overflow-hidden">
 
        {{-- Glowing orbs --}}
        <div class="orb w-[500px] h-[500px] bg-indigo-600/20 top-[-100px] left-[-150px]"></div>
        <div class="orb w-[350px] h-[350px] bg-violet-600/15 bottom-[50px] right-[-80px]"></div>
        <div class="orb w-[200px] h-[200px] bg-indigo-400/10 bottom-[200px] left-[100px]"></div>
 
        {{-- Top logo --}}
        <div class="relative z-10 p-10">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-500/20 ring-1 ring-indigo-500/40">
                    <svg class="h-5 w-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-white tracking-wide" style="font-family:'Syne',sans-serif">AstraCore</p>
                    <p class="text-[10px] text-slate-500 leading-none">Business Suite</p>
                </div>
            </div>
        </div>
 
        {{-- Center hero text --}}
        <div class="relative z-10 flex-1 flex flex-col justify-center px-12 xl:px-16">
            <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-indigo-500/20 bg-indigo-500/10 px-4 py-1.5 text-xs font-medium text-indigo-300 w-fit">
                <span class="h-1.5 w-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                 Secure Account Access
            </div>
 
            <h1 class="text-4xl xl:text-5xl font-bold text-white leading-[1.15] mb-5" style="font-family:'Syne',sans-serif">
               Welcome to your<br />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">
                    digital workspace
                </span>
            </h1>
 
            <p class="text-slate-400 text-base leading-relaxed max-w-sm mb-10">
                Sign in to manage your personalized services, view real-time project updates, or configure system settings.
            </p>
 
            {{-- Feature list --}}
            <div class="space-y-3.5">
                @foreach ([
                    ['Services & Innovations', 'Explore current offerings and core developments'],
                    ['Interactive Content', 'Stay connected with recent updates and articles'],
                    ['Collaborative Ecosystem', 'A centralized space built for our entire community'],
                    ['Support & Preferences', 'Manage your security profile and direct responses'],
                ] as [$title, $desc])
                <div class="flex items-start gap-3">
                    <div class="mt-0.5 flex h-5 w-5 flex-shrink-0 items-center justify-center rounded-full bg-indigo-500/20">
                        <svg class="h-3 w-3 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-200">{{ $title }}</p>
                        <p class="text-xs text-slate-500">{{ $desc }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
 
        {{-- Bottom caption --}}
        <div class="relative z-10 px-12 xl:px-16 pb-10">
            <p class="text-xs text-slate-600">&copy; {{ date('Y') }} AstraCore Business Suite. All rights reserved.</p>
        </div>
 
        {{-- Decorative border-right glow --}}
        <div class="absolute inset-y-0 right-0 w-px bg-gradient-to-b from-transparent via-indigo-500/30 to-transparent"></div>
    </div>
 
    {{-- ============================================================
         RIGHT PANEL — Auth Form Slot
    ============================================================ --}}
    <div class="flex flex-1 flex-col justify-center bg-white px-6 py-12 sm:px-10 lg:px-14 xl:px-20">
 
        {{-- Mobile logo (only shown on small screens) --}}
        <div class="mb-8 flex items-center gap-3 lg:hidden">
            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-100">
                <svg class="h-5 w-5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-bold text-slate-800" style="font-family:'Syne',sans-serif">AstraCore</p>
                <p class="text-[10px] text-slate-400">Business Suite</p>
            </div>
        </div>
 
        {{-- Form container — max width keeps it readable --}}
        <div class="mx-auto w-full max-w-sm">
            {{ $slot }}
        </div>
 
        {{-- Back to website link --}}
        <div class="mx-auto mt-8 w-full max-w-sm">
            <a
                href="{{ url('/') }}"
                class="flex items-center gap-1.5 text-xs text-slate-400 hover:text-slate-600 transition-colors"
            >
                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Back to website
            </a>
        </div>
    </div>
 
</div>
 
</body>
</html>
