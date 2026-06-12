<footer class="bg-slate-900 text-slate-300 mt-20">

    <div class="max-w-7xl mx-auto px-6 py-14">

        <div class="grid md:grid-cols-3 gap-10">

            {{-- Company --}}
            <div>

                <h3 class="text-white font-bold text-lg mb-4">
                    {{ $setting->site_name ?? 'AstraCore' }}
                </h3>

                <p class="text-sm">
                    {{ $setting->tagline ?? 'Modern Web Development Agency' }}
                </p>

            </div>

            {{-- Contact --}}
            <div>

                <h4 class="font-semibold text-white mb-4">
                    Contact
                </h4>

                <div class="space-y-2 text-sm">

                    <p>{{ $setting->email }}</p>

                    <p>{{ $setting->phone }}</p>

                    <p>{{ $setting->address }}</p>

                </div>

            </div>

            {{-- Social --}}
            <div>

                <h4 class="font-semibold text-white mb-4">
                    Follow Us
                </h4>

                <div class="flex gap-4">

                    @if($setting->facebook)
                        <a href="{{ $setting->facebook }}">Facebook</a>
                    @endif

                    @if($setting->linkedin)
                        <a href="{{ $setting->linkedin }}">LinkedIn</a>
                    @endif

                    @if($setting->instagram)
                        <a href="{{ $setting->instagram }}">Instagram</a>
                    @endif

                </div>

            </div>

        </div>

        <div class="border-t border-slate-800 mt-10 pt-6 text-center text-sm">

            {{ $setting->footer_text }}

        </div>

    </div>

</footer>