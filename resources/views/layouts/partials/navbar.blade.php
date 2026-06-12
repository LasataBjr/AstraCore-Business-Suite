<header class="sticky top-0 z-50 bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto px-6">

        <div class="h-16 flex items-center justify-between">

            {{-- Logo --}}
            <a href="#"
               class="flex items-center gap-3">

                @if(!empty($settings->logo))
                    <img src="{{ asset('storage/'.$settings->logo) }}"
                         class="h-10 w-auto">
                @endif

                <span class="font-bold text-xl">
                    {{ $settings->site_name ?? 'AstraCore' }}
                </span>
            </a>

            {{-- Navigation --}}
            <nav class="hidden md:flex items-center gap-8">

                <a href="#"
                   class="hover:text-indigo-600">
                    Home
                </a>

                <a href="#"
                   class="hover:text-indigo-600">
                    Services
                </a>

                <a href="#"
                   class="hover:text-indigo-600">
                    Projects
                </a>

                <a href="#"
                   class="hover:text-indigo-600">
                    Blog
                </a>

                <a href="#"
                   class="hover:text-indigo-600">
                    Contact
                </a>

            </nav>

            <a href="#"
               class="hidden md:inline-flex bg-indigo-600 text-white px-4 py-2 rounded-xl">
                Get Quote
            </a>

        </div>

    </div>
</header>