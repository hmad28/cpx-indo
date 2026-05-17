<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'CPX') }} Dashboard</title>
        <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @stack('style')
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen bg-gradient-to-b from-gray-50 via-gray-50 to-gray-100">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white/70 backdrop-blur border-b border-gray-100 shadow-sm">
                    <div class="max-w-7xl 2xl:max-w-[100rem] mx-auto py-5 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>

            <footer class="mt-10 border-t border-gray-200 bg-white/60">
                <div class="max-w-7xl 2xl:max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-8 py-5 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-gray-500">
                    <p>© {{ date('Y') }} CP<span class="text-red-500 font-semibold">X</span> Indonesia · Sport Wear Premium Quality</p>
                    <p>Dashboard Admin v2 · Built with Laravel {{ app()->version() }}</p>
                </div>
            </footer>
        </div>
        <script src="https://unpkg.com/flowbite@latest/dist/flowbite.min.js"></script>
        <script src="//unpkg.com/alpinejs" defer></script>

        @stack('script')
    </body>
</html>
