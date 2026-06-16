<section class="space-y-6">
    <header>
        <h3 class="text-lg font-bold text-red-800 tracking-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Purge Account Data') }}
        </h3>
        <p class="mt-1 text-sm text-slate-500 leading-relaxed">
            {{ __('Once your profile configuration is purged, all resources and underlying database structures will be permanently eliminated. Please extract any essential storage components first.') }}
        </p>
    </header>

    {{-- Trigger Destruction Button --}}
    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-5 py-3 text-xs font-mono uppercase tracking-wider font-bold text-white shadow-lg shadow-red-600/15 hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-150"
    >
        {{ __('Delete Account') }}
    </button>

    {{-- Confirmation Modal Framework --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-8 bg-white rounded-2xl">
            @csrf
            @method('delete')

            <h3 class="text-xl font-bold text-slate-800 tracking-tight" style="font-family: 'Poppins', sans-serif;">
                {{ __('Are you completely sure?') }}
            </h3>

            <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                {{ __('This operational step cannot be reversed. Please enter your structural security password to authorize system execution.') }}
            </p>

            <div class="mt-5">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <div class="relative max-w-md">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                        <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/>
                        </svg>
                    </div>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 transition focus:bg-white focus:outline-none focus:ring-4 focus:ring-red-500/5 @error('password', 'userDeletion') border-red-300 bg-red-50/50 focus:border-red-400 @else border-slate-200 focus:border-red-500 @enderror"
                        placeholder="{{ __('Confirm Password Address') }}"
                        required
                    />
                </div>
                @error('password', 'userDeletion')
                    <p class="mt-1.5 text-xs text-red-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-6 flex justify-end gap-3 border-t border-slate-100 pt-5">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-4 py-2.5 text-xs font-mono uppercase tracking-wider font-bold text-slate-600 hover:bg-slate-200 active:bg-slate-300 transition-colors focus:outline-none"
                >
                    {{ __('Cancel') }}
                </button>

                <button 
                    type="submit"
                    class="inline-flex items-center justify-center rounded-xl bg-red-600 px-4 py-2.5 text-xs font-mono uppercase tracking-wider font-bold text-white shadow-md shadow-red-600/10 hover:bg-red-500 active:bg-red-700 focus:outline-none"
                >
                    {{ __('Confirm Purge') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>