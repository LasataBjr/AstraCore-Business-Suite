<section class="space-y-6">
    <header>
        <h3 class="text-lg font-bold text-slate-800 tracking-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Profile Information') }}
        </h3>
        <p class="mt-1 text-sm text-slate-500 leading-relaxed">
            {{ __("Update your account's public identity records and authentication routing endpoints.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-5">
        @csrf
        @method('patch')

        {{-- Name Input Node --}}
        <div>
            <label for="name" class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5">
                Full Name
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                    </svg>
                </div>
                <input 
                    id="name" 
                    name="name" 
                    type="text" 
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5 @error('name', 'updateProfileInformation') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-indigo-500 @enderror" 
                    value="{{ old('name', $user->name) }}" 
                    required 
                    autofocus 
                    autocomplete="name" 
                />
            </div>
            @error('name', 'updateProfileInformation')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600 font-medium">
                    {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Email Input Node --}}
        <div>
            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-slate-600 font-semibold mb-1.5">
                Email Address
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                    </svg>
                </div>
                <input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-indigo-500/5 @error('email', 'updateProfileInformation') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-indigo-500 @enderror" 
                    value="{{ old('email', $user->email) }}" 
                    required 
                    autocomplete="username" 
                />
            </div>
            @error('email', 'updateProfileInformation')
                <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600 font-medium">
                    {{ $message }}
                </p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 rounded-xl bg-amber-50 border border-amber-200 flex items-start gap-2.5">
                    <svg class="h-4 w-4 text-amber-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    <div class="text-xs text-amber-800">
                        <p class="font-semibold">{{ __('Your email address remains unverified.') }}</p>
                        <button form="send-verification" class="mt-1 text-indigo-600 hover:text-indigo-800 font-bold underline transition-colors focus:outline-none">
                            {{ __('Click here to re-send execution payload.') }}
                        </button>
                    </div>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <p class="mt-2 text-xs font-semibold text-emerald-600 flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        {{ __('A refined verification gateway has been dispatched to your endpoint.') }}
                    </p>
                @endif
            @endif
        </div>

        {{-- Action Processing Elements --}}
        <div class="flex items-center gap-4 pt-2">
            <button 
                type="submit" 
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-xs font-mono uppercase tracking-wider font-bold text-white shadow-lg shadow-indigo-600/15 hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-150"
            >
                {{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
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