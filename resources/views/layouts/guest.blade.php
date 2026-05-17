<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>CPX Official</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-950 antialiased">
        <div class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(220,38,38,0.24),transparent_26rem),linear-gradient(135deg,#111111_0%,#2a0d0d_46%,#f7f1e8_46%,#fffaf3_100%)] px-4 py-8">
            <div class="mx-auto grid min-h-[calc(100vh-4rem)] w-full max-w-6xl items-center gap-8 lg:grid-cols-[1.05fr_0.95fr]">
                <div class="hidden text-white lg:block">
                    <a href="/" class="inline-flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 backdrop-blur">
                        <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX" class="h-10 w-auto rounded-full">
                        <span class="text-sm font-bold uppercase tracking-[0.28em]">CPX Official</span>
                    </a>
                    <h1 class="mt-10 max-w-xl text-6xl font-black leading-none tracking-tight">
                        Masuk ke pusat kontrol jersey custom.
                    </h1>
                    <p class="mt-5 max-w-lg text-base leading-7 text-white/70">
                        Kelola katalog, promo, best seller, testimoni, dan jalur WhatsApp dengan tampilan baru yang lebih rapi.
                    </p>
                    <div class="mt-8 grid max-w-xl grid-cols-3 gap-3 text-sm">
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <p class="text-2xl font-black">01</p>
                            <p class="mt-1 text-white/70">Produk</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <p class="text-2xl font-black">02</p>
                            <p class="mt-1 text-white/70">Promo</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/10 p-4 backdrop-blur">
                            <p class="text-2xl font-black">03</p>
                            <p class="mt-1 text-white/70">Konten</p>
                        </div>
                    </div>
                </div>

                <div class="w-full">
                    <div class="mb-6 flex justify-center lg:hidden">
                        <a href="/">
                            <x-application-logo class="h-16 w-auto fill-current text-gray-800" />
                        </a>
                    </div>

                    <div class="rounded-[2rem] border border-white/60 bg-white/85 p-6 shadow-2xl backdrop-blur-xl sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
