<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', $settings->site_name ?? 'AstraCore Business Suite')
    </title>

    {{-- Favicon --}}
    @if(!empty($settings->favicon))
        <link rel="icon" href="{{ asset('storage/'.$settings->favicon) }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="bg-white text-slate-800 antialiased">

    {{-- Header --}}
    @include('layouts.partials.navbar')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.partials.footer')

    @stack('scripts')

</body>
</html>