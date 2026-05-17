<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CPX Official</title>
        <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-[radial-gradient(circle_at_top_left,rgba(220,38,38,0.2),transparent_28rem),linear-gradient(135deg,#111111_0%,#2b0f0f_48%,#fffaf3_48%,#f7f1e8_100%)] text-gray-950">
        <main class="mx-auto grid min-h-screen max-w-7xl items-center gap-10 px-6 py-10 lg:grid-cols-2">
            <section class="text-white">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 rounded-full border border-white/15 bg-white/10 px-4 py-2 backdrop-blur">
                    <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX" class="h-10 w-10 rounded-full object-cover">
                    <span class="text-sm font-black uppercase tracking-[0.28em]">CPX Official</span>
                </a>
                <h1 class="mt-10 max-w-2xl text-6xl font-black leading-none tracking-tight lg:text-7xl">
                    Custom jersey, dashboard modern, proses lebih rapi.
                </h1>
                <p class="mt-6 max-w-xl text-base leading-8 text-white/70">
                    Masuk untuk mengelola katalog, promo, best seller, testimoni, dan kontak WhatsApp CPX dari satu tempat.
                </p>
                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-red-600/20 transition hover:bg-red-700">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-3 text-sm font-black text-white shadow-lg shadow-red-600/20 transition hover:bg-red-700">
                            Log In
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 px-5 py-3 text-sm font-black text-white transition hover:bg-white hover:text-gray-950">
                            Register
                        </a>
                    @endauth
                </div>
            </section>

            <section class="rounded-[2rem] border border-white/60 bg-white/85 p-6 shadow-2xl backdrop-blur-xl md:p-8">
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-gray-950 p-5 text-white">
                        <p class="text-4xl font-black">01</p>
                        <h2 class="mt-8 text-xl font-black">Katalog</h2>
                        <p class="mt-2 text-sm text-white/65">Produk, foto, ukuran, dan kategori tampil lebih terstruktur.</p>
                    </div>
                    <div class="rounded-3xl bg-red-600 p-5 text-white">
                        <p class="text-4xl font-black">02</p>
                        <h2 class="mt-8 text-xl font-black">Promo</h2>
                        <p class="mt-2 text-sm text-white/75">Diskon aktif bisa dipantau langsung dari dashboard.</p>
                    </div>
                    <div class="rounded-3xl bg-white p-5 shadow-sm">
                        <p class="text-4xl font-black">03</p>
                        <h2 class="mt-8 text-xl font-black">Konten</h2>
                        <p class="mt-2 text-sm text-gray-500">FAQ dan testimoni punya pintasan pengelolaan.</p>
                    </div>
                    <div class="rounded-3xl bg-amber-400 p-5 text-gray-950">
                        <p class="text-4xl font-black">04</p>
                        <h2 class="mt-8 text-xl font-black">WhatsApp</h2>
                        <p class="mt-2 text-sm text-gray-800">CTA pelanggan bisa diarahkan ke nomor aktif.</p>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>
