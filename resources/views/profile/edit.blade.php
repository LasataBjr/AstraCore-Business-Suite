<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-slate-800 tracking-tight leading-tight" style="font-family: 'Poppins', sans-serif;">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50/50 min-h-[calc(100vh-5rem)]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            
            {{-- Profile Information Card Container --}}
            <div class="p-6 sm:p-8 bg-white border border-slate-100 rounded-2xl shadow-sm transition-all duration-200 hover:shadow-md/5">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Security Updates Card Container --}}
            <div class="p-6 sm:p-8 bg-white border border-slate-100 rounded-2xl shadow-sm transition-all duration-200 hover:shadow-md/5">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Account Destruction Danger Zone Card Container --}}
            <div class="p-6 sm:p-8 bg-white border border-red-100 bg-gradient-to-b from-white to-red-50/10 rounded-2xl shadow-sm">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>