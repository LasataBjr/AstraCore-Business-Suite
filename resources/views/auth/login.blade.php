{{--
    Login Page
    Path: resources/views/auth/login.blade.php
    Uses: layouts/guest.blade.php (x-guest-layout)

    Fully custom-styled — replaces all Breeze default components.
    Works inside your two-column guest.blade.php layout.
--}}

<x-guest-layout>

    {{-- ── SESSION STATUS (e.g. password reset success) ───── --}}
    @if (session('status'))
        <div class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <svg class="h-4 w-4 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('status') }}
        </div>
    @endif

    {{-- ── HEADING ─────────────────────────────────────────── --}}
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-slate-800 font-display leading-tight">
            Welcome back
        </h2>
        <p class="mt-1.5 text-sm text-slate-500">
            Sign in to your AstraCore admin panel
        </p>
    </div>

    {{-- ── FORM ────────────────────────────────────────────── --}}
    <form
        method="POST"
        action="{{ route('login') }}"
        x-data="{ showPassword: false }"
        class="space-y-5"
    >
        @csrf

        {{-- Email --}}
        <div>
            <label
                for="email"
                class="block text-sm font-medium text-slate-700 mb-1.5"
            >
                Email address
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="admin@example.com"
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 transition
                        focus:bg-white focus:outline-none focus:ring-2
                        @error('email')
                            border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                        @else
                            border-slate-200 focus:border-indigo-400 focus:ring-indigo-100
                        @enderror"
                />
            </div>
            @error('email')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-slate-700">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition-colors"
                    >
                        Forgot password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </div>
                <input
                    id="password"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••••"
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-11 text-sm text-slate-800 placeholder-slate-400 transition
                        focus:bg-white focus:outline-none focus:ring-2
                        @error('password')
                            border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                        @else
                            border-slate-200 focus:border-indigo-400 focus:ring-indigo-100
                        @enderror"
                />
                {{-- Show / hide toggle --}}
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-600 transition-colors"
                    :aria-label="showPassword ? 'Hide password' : 'Show password'"
                >
                    {{-- Eye icon --}}
                    <svg x-show="!showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{-- Eye-slash icon --}}
                    <svg x-show="showPassword" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex cursor-pointer items-center gap-2.5 group">
                <div class="relative flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="peer h-4 w-4 cursor-pointer rounded border-slate-300 text-indigo-600 transition
                            focus:ring-2 focus:ring-indigo-100 focus:ring-offset-0"
                    />
                </div>
                <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors select-none">
                    Remember me
                </span>
            </label>
        </div>

        {{-- Submit button --}}
        <button
            type="submit"
            class="relative w-full overflow-hidden rounded-xl bg-indigo-600 px-4 py-3 text-sm font-semibold text-white shadow-sm
                hover:bg-indigo-700 active:bg-indigo-800
                focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                transition-all duration-150
                group"
        >
            <span class="flex items-center justify-center gap-2">
                <svg class="h-4 w-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9"/>
                </svg>
                Sign in to AstraCore
            </span>
        </button>

    </form>

    {{-- ── DIVIDER ─────────────────────────────────────────── --}}
    <div class="my-6 flex items-center gap-3">
        <div class="flex-1 border-t border-slate-200"></div>
        <span class="text-xs text-slate-400 font-medium">SECURE ADMIN ACCESS</span>
        <div class="flex-1 border-t border-slate-200"></div>
    </div>

    {{-- ── TRUST BADGES ────────────────────────────────────── --}}
    <div class="flex items-center justify-center gap-5 text-xs text-slate-400">
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
            </svg>
            SSL Encrypted
        </div>
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            Auth Protected
        </div>
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            CSRF Verified
        </div>
    </div>

</x-guest-layout>