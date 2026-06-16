<div class="js-cookie-consent cookie-consent fixed bottom-0 inset-x-0 w-full z-[100] animate-fade-in">
    {{-- High-Density Frosted White Shield Layer (Strictly limits background clutter) --}}
    <div class="bg-white/[0.07] border-t border-white/10 backdrop-blur-xl px-4 py-4 sm:px-6 lg:px-8 shadow-[0_-10px_40px_rgba(0,0,0,0.6)]">
        
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            
            {{-- Left Side: Icon & Descriptive Messaging Module --}}
            <div class="flex items-center gap-3 max-w-3xl">
                {{-- High-Contrast Light Accent Frame --}}
                <div class="p-2 rounded-lg bg-white/5 border border-white/10 text-indigo-400 shrink-0 hidden sm:block select-none pointer-events-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                
                <div class="space-y-0.5">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-indigo-400 font-mono">Data Privacy Notice</h4>
                  
                    <p class="text-xs sm:text-sm text-slate-500 font-sans font-medium leading-relaxed">
                        {!! trans('cookie-consent::texts.message') !!}
                    </p>
                </div>
            </div>
            
            {{-- Right Side: Solid, High-Contrast Action Button --}}
            <div class="shrink-0 flex items-center justify-end">
                <button class="js-cookie-consent-agree cookie-consent__agree w-full sm:w-auto px-6 py-2.5 rounded-md bg-indigo-600 hover:bg-indigo-500 text-xs font-bold text-white shadow-md active:scale-[0.99] transition-all tracking-wider uppercase">
                    {!! trans('cookie-consent::texts.agree') !!}
                </button>
            </div>

        </div>

    </div>
</div>