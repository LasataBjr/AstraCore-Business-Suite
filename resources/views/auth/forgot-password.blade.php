<x-guest-layout>

    {{-- ── SESSION STATUS (Success Notification) ────────────────── --}}
    @if (session('status'))
        <div class="mb-5 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            <svg class="h-4 w-4 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span class="font-medium">{{ session('status') }}</span>
        </div>
    @endif

    {{-- ── HEADING ARCHITECTURE ─────────────────────────────────── --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800 tracking-tight leading-tight" style="font-family: 'Poppins', sans-serif;">
            Reset password
        </h2>
        <p class="mt-2 text-sm text-slate-500 leading-relaxed">
            {{ __('No problem. Enter your email address and we will send over a secure link to configure a new one.') }}
        </p>
    </div>

    {{-- ── RECOVERY TRANSMISSION FORM ───────────────────────────── --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        {{-- Email Address Field Node --}}
        <div>
            <label
                for="email"
                class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5"
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
                    placeholder="admin@example.com"
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 transition
                        focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5
                        @error('email')
                            border-red-300 bg-red-50/50 focus:border-red-400 focus:ring-red-500/5
                        @else
                            border-slate-200 focus:border-indigo-500
                        @enderror"
                />
            </div>
            
            @error('email')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600 font-medium">
                    <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                    </svg>
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Action Control Interface Block --}}
        <div class="flex items-center justify-between gap-4 pt-1">
            <a
                href="{{ route('login') }}"
                class="text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors inline-flex items-center gap-1.5 group"
            >
                <svg class="h-3.5 w-3.5 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
                </svg>
                Back to sign in
            </a>

            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-xs font-mono uppercase tracking-wider font-bold text-white shadow-lg shadow-indigo-600/15
                    hover:bg-indigo-500 active:bg-indigo-700
                    focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2
                    transition-all duration-150"
            >
                Send link
            </button>
        </div>
    </form>

    {{-- ── DIVIDER ─────────────────────────────────────────── --}}
    <div class="my-6 flex items-center gap-3">
        <div class="flex-1 border-t border-slate-200"></div>
        <span class="text-[10px] font-mono text-slate-400 font-semibold tracking-widest">SECURE SYSTEM</span>
        <div class="flex-1 border-t border-slate-200"></div>
    </div>

    {{-- ── SYSTEM SAFETY BADGES ─────────────────────────────────── --}}
    <div class="flex items-center justify-center gap-5 text-[11px] font-mono uppercase text-slate-400 font-medium">
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/>
            </svg>
            SSL
        </div>
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
            </svg>
            AUTH
        </div>
        <div class="flex items-center gap-1.5">
            <svg class="h-3.5 w-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            CSRF
        </div>
    </div>

</x-guest-layout>