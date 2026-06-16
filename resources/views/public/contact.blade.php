@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')

{{-- ═══════════════════════════════════════════════════
     HERO SEGMENT
═══════════════════════════════════════════════════ --}}
<section class="relative bg-slate-950 pt-32 pb-20 overflow-hidden text-white">
    {{-- Ambient Tech Grid Background Layer --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1e293b_1px,transparent_1px),linear-gradient(to_bottom,#1e293b_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_100%,#000_70%,transparent_100%)] opacity-40 pointer-events-none"></div>
    
    <div class="container mx-auto px-6 relative z-10 text-center max-w-3xl space-y-4">
        <span class="font-mono text-xs text-indigo-400 uppercase tracking-widest font-bold block">
            Connect Ecosystem
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight" style="font-family: 'Poppins', sans-serif;">
            Contact Us
        </h1>
        <p class="text-slate-400 text-base md:text-lg max-w-xl mx-auto leading-relaxed">
            Have a project in mind or need technical assistance? Let's discuss your next system configuration.
        </p>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════
     INTERFACE SPLIT GRID SECTION
═══════════════════════════════════════════════════ --}}
<section class="py-20 bg-white relative">
    <div class="max-w-6xl mx-auto px-6">
        
        {{-- Session Execution Feedback Node --}}
        @if(session('success'))
            <div class="mb-10 rounded-2xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 flex items-center gap-3 shadow-sm">
                <i class="bi bi-check-circle-fill text-emerald-500 text-lg"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-start">

            {{-- Left Side: Contact Information Architecture --}}
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <h2 class="text-xs font-mono text-indigo-600 uppercase tracking-widest font-bold mb-2">
                        Communication Channels
                    </h2>
                    <h3 class="text-2xl font-bold text-slate-900 tracking-tight" style="font-family: 'Poppins', sans-serif;">
                        Get In Touch
                    </h3>
                </div>

                <div class="space-y-4">
                    {{-- Email Node --}}
                    <div class="flex items-start gap-4 p-5 bg-slate-50/60 border border-slate-100 rounded-2xl transition-all duration-300 hover:border-slate-200/80">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 shadow-sm">
                            <i class="bi bi-envelope text-lg"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400">Email Routing</h4>
                            <p class="text-slate-700 font-medium break-all">asassha03@gmail.com</p>
                        </div>
                    </div>

                    {{-- Phone Node --}}
                    <div class="flex items-start gap-4 p-5 bg-slate-50/60 border border-slate-100 rounded-2xl transition-all duration-300 hover:border-slate-200/80">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 shadow-sm">
                            <i class="bi bi-telephone text-lg"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400">Direct Line</h4>
                            <p class="text-slate-700 font-medium">+977-9800000000</p>
                        </div>
                    </div>

                    {{-- Location Node --}}
                    <div class="flex items-start gap-4 p-5 bg-slate-50/60 border border-slate-100 rounded-2xl transition-all duration-300 hover:border-slate-200/80">
                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 shadow-sm">
                            <i class="bi bi-geo-alt text-lg"></i>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-xs font-mono uppercase tracking-wider text-slate-400">HQ Coordinate</h4>
                            <p class="text-slate-700 font-medium">Kathmandu, Nepal</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Dynamic Form Transmission Controller --}}
            <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-100 shadow-xl shadow-slate-100/40">
                
                <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-5">
                        {{-- Name Field --}}
                        <div class="space-y-2">
                            <label for="name" class="block text-xs font-mono uppercase tracking-wider text-slate-500 font-semibold">
                                Name
                            </label>
                            <input 
                                type="text" 
                                id="name"
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="John Doe"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/5 @error('name') border-red-300 focus:border-red-500 focus:ring-red-500/5 @enderror"
                                required
                            >
                            @error('name')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email Field --}}
                        <div class="space-y-2">
                            <label for="email" class="block text-xs font-mono uppercase tracking-wider text-slate-500 font-semibold">
                                Email
                            </label>
                            <input 
                                type="email" 
                                id="email"
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="john@example.com"
                                class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/5 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500/5 @enderror"
                                required
                            >
                            @error('email')
                                <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Phone Field --}}
                    <div class="space-y-2">
                        <label for="phone" class="block text-xs font-mono uppercase tracking-wider text-slate-500 font-semibold">
                            Phone <span class="text-slate-400 font-normal">(Optional)</span>
                        </label>
                        <input 
                            type="text" 
                            id="phone"
                            name="phone" 
                            value="{{ old('phone') }}" 
                            placeholder="+977-98..."
                            class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/5 @error('phone') border-red-300 focus:border-red-500 focus:ring-red-500/5 @enderror"
                        >
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Subject Field --}}
                    <div class="space-y-2">
                        <label for="subject" class="block text-xs font-mono uppercase tracking-wider text-slate-500 font-semibold">
                            Subject
                        </label>
                        <input 
                            type="text" 
                            id="subject"
                            name="subject" 
                            value="{{ old('subject') }}" 
                            placeholder="Project Scope Consultation"
                            class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/5 @error('subject') border-red-300 focus:border-red-500 focus:ring-red-500/5 @enderror"
                            required
                        >
                        @error('subject')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Message Field --}}
                    <div class="space-y-2">
                        <label for="message" class="block text-xs font-mono uppercase tracking-wider text-slate-500 font-semibold">
                            Message Payload
                        </label>
                        <textarea 
                            id="message"
                            name="message" 
                            rows="5" 
                            placeholder="Provide operational details regarding your request..."
                            class="w-full border border-slate-200 rounded-xl px-4 py-3 text-sm transition-all duration-200 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/5 @error('message') border-red-300 focus:border-red-500 focus:ring-red-500/5 @enderror"
                            required
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit Action Button --}}
                    <div class="pt-2">
                        <button 
                            type="submit" 
                            class="w-full flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-semibold tracking-wide transition-all duration-300 shadow-lg shadow-indigo-600/20 hover:-translate-y-0.5 group"
                        >
                            Transmit Message 
                            <i class="bi bi-send transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-200 text-xs"></i>
                        </button>
                    </div>

                </form>

            </div>

        </div>

    </div>
</section>

@endsection