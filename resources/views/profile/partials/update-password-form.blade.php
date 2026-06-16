<section class="space-y-6">
    <header>
        <h3 class="text-lg font-bold text-slate-800 tracking-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Update Password') }}
        </h3>
        <p class="mt-1 text-sm text-slate-500 leading-relaxed">
            {{ __('Ensure your access node remains safe using a complex, high-entropy cryptographic sequence.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('put')

        {{-- Current Password Node --}}
        <div>
            <label for="update_password_current_password" class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5">
                Current Password
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                    </svg>
                </div>
                <input 
                    id="update_password_current_password" 
                    name="current_password" 
                    type="password" 
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5 @error('current_password', 'updatePassword') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-indigo-500 @enderror" 
                    autocomplete="current-password" 
                    placeholder="••••••••••"
                />
            </div>
            @error('current_password', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- New Password Node --}}
        <div>
            <label for="update_password_password" class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5">
                New Password
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>
                    </svg>
                </div>
                <input 
                    id="update_password_password" 
                    name="password" 
                    type="password" 
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5 @error('password', 'updatePassword') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-indigo-500 @enderror" 
                    autocomplete="new-password" 
                    placeholder="••••••••••"
                />
            </div>
            @error('password', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password Node --}}
        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5">
                Confirm Password
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <input 
                    id="update_password_password_confirmation" 
                    name="password_confirmation" 
                    type="password" 
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5 @error('password_confirmation', 'updatePassword') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-indigo-500 @enderror" 
                    autocomplete="new-password" 
                    placeholder="••••••••••"
                />
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
            @enderror
        </div>

        {{-- Action Operational Interface Block --}}
        <div class="flex items-center gap-4 pt-2">
            <button 
                type="submit" 
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-xs font-mono uppercase tracking-wider font-bold text-white shadow-lg shadow-indigo-600/15 hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150"
            >
                {{ __('Update Key') }}
            </button>

            @if (session('status') === 'password-updated')
                <p 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition:leave="transition ease-in duration-500" 
                    x-transition:leave-start="opacity-100" 
                    x-transition:leave-end="opacity-0" 
                    x-init="setTimeout(() => show = false, 2000)" 
                    class="text-xs font-mono font-bold text-emerald-600 uppercase tracking-wider"
                >
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>