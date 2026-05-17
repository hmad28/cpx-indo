<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Custom | CPX Official</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
</head>
<body class="cpx-shell">
    <x-header></x-header>
    <main>
        <section id="hero" class="relative min-h-screen overflow-hidden bg-gray-950 pt-32 text-white" style="background-image: linear-gradient(110deg, rgba(0,0,0,.88), rgba(0,0,0,.28)), url('{{ asset('images/bg-hero-about.png') }}'); background-size: cover; background-position: center;">
            <div class="cpx-container grid min-h-[720px] items-center gap-10 py-12 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <span class="cpx-eyebrow border-white/15 bg-white/10 text-white">Custom Jersey</span>
                    <h1 class="cpx-heading mt-5 max-w-3xl text-7xl md:text-8xl">Desain Jersey Sesuai Gayamu!</h1>
                    <p class="mt-6 max-w-2xl text-base leading-8 text-white/70 md:text-lg">Tunjukkan identitas tim, komunitas, atau gaya personalmu lewat jersey custom yang bisa kamu atur sendiri dari warna, logo, sampai detail nama & nomor.</p>
                    <a href="#custom-action" class="cpx-btn-primary mt-8 mr-3">
                        Custom sekarang
                    </a>
                    {{-- <a href="#" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                        Konsultasi sekarang!
                    </a>  --}}

                    @foreach($customJerseyNumber as $wa)
                        <a 
                            href="{{ $wa->whatsapp_url }}"
                            id="custom-action"
                            class="cpx-btn-secondary mt-3 text-gray-950" target="_blank">
                            Konsultasi sekarang!
                        </a>
                    @endforeach
                    
                </div>
                <div class="block lg:mt-0 lg:col-span-5 lg:flex">
                    <div class="rounded-[2rem] border border-white/10 bg-white/10 p-5 shadow-2xl backdrop-blur">
                        <img src="{{ asset('images/jersey-custom-final.png') }}" alt="mockup" class="drop-shadow-2xl">
                    </div>
                </div>                
            </div>
        </section>
    </main>
    <x-footer></x-footer>
    <x-script></x-script>
</body>
</html>