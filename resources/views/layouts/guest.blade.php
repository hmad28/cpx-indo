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
        <div class="min-h-screen lg:grid lg:grid-cols-2">
            {{-- Left side: dark branding panel --}}
            <div class="hidden lg:flex lg:flex-col lg:justify-between bg-gray-950 relative overflow-hidden p-10">
                {{-- Angular red accent shapes (CSS only) --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-red-600/20 -translate-y-1/2 translate-x-1/2 rotate-45"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-red-600/10 translate-y-1/3 -translate-x-1/3 rotate-12"></div>
                <div class="absolute top-1/2 right-10 w-1 h-32 bg-red-500/40 -rotate-12"></div>
                <div class="absolute bottom-1/4 left-1/4 w-24 h-1 bg-red-500/30 rotate-45"></div>

                {{-- Logo and branding --}}
                <div class="relative z-10">
                    <a href="/" class="inline-flex items-center gap-3 border border-white/10 bg-white/5 px-4 py-2">
                        <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX" class="h-10 w-auto rounded-lg">
                        <span class="text-sm font-bold uppercase tracking-[0.28em] text-white">CPX Official</span>
                    </a>
                </div>

                {{-- Large Bebas Neue branding --}}
                <div class="relative z-10 my-auto">
                    <h1 class="text-7xl font-black leading-none tracking-tight text-white" style="font-family: 'Bebas Neue', sans-serif;">
                        PUSAT<br>KONTROL<br><span class="text-red-500">JERSEY.</span>
                    </h1>
                    <p class="mt-6 max-w-sm text-base leading-7 text-white/60">
                        Kelola katalog, promo, best seller, testimoni, dan jalur WhatsApp dengan tampilan baru yang lebih rapi.
                    </p>
                    <div class="mt-8 grid max-w-sm grid-cols-3 gap-3 text-sm">
                        <div class="border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-red-500">01</p>
                            <p class="mt-1 text-white/60">Produk</p>
                        </div>
                        <div class="border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-red-500">02</p>
                            <p class="mt-1 text-white/60">Promo</p>
                        </div>
                        <div class="border border-white/10 bg-white/5 p-4">
                            <p class="text-2xl font-black text-red-500">03</p>
                            <p class="mt-1 text-white/60">Konten</p>
                        </div>
                    </div>
                </div>

                {{-- Bottom accent line --}}
                <div class="relative z-10">
                    <div class="h-1 w-20 bg-red-500"></div>
                </div>
            </div>

            {{-- Right side: white auth form area --}}
            <div class="flex min-h-screen flex-col items-center justify-center bg-white px-4 py-8 lg:min-h-0">
                {{-- Mobile logo fallback --}}
                <div class="mb-8 flex justify-center lg:hidden">
                    <a href="/">
                        <x-application-logo class="h-16 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="w-full max-w-md">
                    <div class="border border-gray-200 bg-white p-6 shadow-xl sm:p-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
