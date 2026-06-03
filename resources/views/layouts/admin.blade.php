<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-100">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>@yield('title', 'Admin') — AstraCore</title>
    
        {{-- Tailwind via Vite --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    
        @stack('styles')
    </head>

    <body class="h-full">
        <!-- 💡 Main Layout Structure Wrapper -->
        <div class="flex h-full">
            
            <!-- 1. Include your sidebar component -->
            @include('layouts.partials.sidebar')

            <!-- 2. Main Content Right Panel Section -->
            <div class="flex-1 flex flex-col overflow-hidden">
                
                <!-- Main body viewport space -->
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                    <!-- 3. Dynamic target location for individual views -->
                    @yield('content')
                </main>

            </div>
        </div>

        @stack('scripts')
    </body>
</html>
