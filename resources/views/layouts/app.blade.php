<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>CPX Dashboard</title>
        <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('style')
    </head>
    <body class="font-sans antialiased text-gray-950">
        <div class="min-h-screen cpx-admin-shell">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="border-b border-black/5 bg-white/75 shadow-sm backdrop-blur-xl">
                    <div class="max-w-7xl mx-auto py-7 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        @stack('script')
    </body>
</html>
