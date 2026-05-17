<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us | CPX Official</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
</head>
<body class="cpx-shell">
    <x-header></x-header>

    <main>
        <section id="hero" class="relative min-h-[720px] overflow-hidden bg-gray-950 pt-32 text-white" style="background-image: linear-gradient(90deg, rgba(0,0,0,.92), rgba(0,0,0,.4)), url('{{ asset('images/bg-hero-about.png') }}'); background-size: cover; background-position: center;">
            <!-- Angular decorative overlays -->
            <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/10 rotate-12 translate-x-20 -translate-y-20"></div>
            <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-red-600 via-red-600/50 to-transparent"></div>

            <div class="cpx-container flex min-h-[620px] items-center relative z-10">
                <div class="grid w-full gap-10 lg:grid-cols-2 lg:items-center">
                    <div>
                        <span class="cpx-eyebrow">Tentang CPX</span>
                        <h1 class="cpx-heading mt-5 text-8xl md:text-9xl"><span class="italic">CP<span class="text-red-500">X</span></span> Jersey</h1>
                        <h2 class="mt-4 text-lg font-semibold text-white/75 md:text-2xl">Custom Jersey - Kualitas Tinggi - Harga Terbaik</h2>
                        <p class="mt-4 max-w-xl text-white/68">
                            Dari lapangan kecil sampai panggung nasional, kami hadir untuk kamu yang ingin tampil beda dan percaya diri.
                            Buat jersey impianmu di sini - cepat, mudah, dan berkualitas.
                        </p>
                    </div>
                    <div class="flex justify-end gap-2 md:gap-5">
                        <div class="w-1/4 mt-10">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                        </div>
                        <div class="w-1/4 mt-20">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                        </div>
                        <div class="w-1/4 mt-30">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-lg shadow-2xl border border-white/10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="cpx-section">
            <div class="cpx-container">
                <div class="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                    <!-- TikTok Video Embed Side (Autoplay Enabled) -->
                    <div class="md:w-1/2 flex justify-center md:justify-start">
                        <div class="overflow-hidden rounded-lg border border-white/10 bg-gray-950 p-3 max-w-full w-full shadow-2xl">
                            <iframe 
                                src="https://www.tiktok.com/embed/v2/7237785236048776449?autoplay=1" 
                                style="max-width: 100%; width: 100%; height: 400px; border-radius: 0.5rem;" 
                                frameborder="0" 
                                scrolling="no" 
                                muted  {{-- Tambah muted untuk memungkinkan autoplay di lebih banyak browser --}}
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>

                    <!-- Visi & Misi Content Side (Tidak Berubah) -->
                    <div class="md:w-1/2 space-y-6">
                        <span class="cpx-eyebrow">Visi & Misi</span>
                        <h1 class="cpx-heading text-5xl md:text-6xl lg:text-7xl text-white">Visi & Misi Kami</h1>
                        
                        <div class="rounded-lg border border-white/10 bg-gray-950/50 p-5 border-l-4 border-l-red-600">
                            <h2 class="text-xl md:text-2xl font-semibold text-red-500">Visi Kami</h2>
                            <p class="mt-3 text-base md:text-lg text-white/75 leading-relaxed">Menjadi brand lokal kebanggaan Indonesia yang menyediakan jersey custom berkualitas tinggi untuk komunitas dan individu di seluruh penjuru negeri.</p>
                        </div>

                        <div class="rounded-lg border border-white/10 bg-gray-950/50 p-5 border-l-4 border-l-red-600">
                            <h2 class="text-xl md:text-2xl font-semibold text-red-500">Misi Kami</h2>
                            <ul class="mt-3 space-y-2 text-white/75 list-none pl-0">
                                <li class="flex items-start gap-2 text-sm md:text-base">
                                    <i class="fas fa-check text-red-600 mt-1 flex-shrink-0 text-sm md:text-base"></i>
                                    Menyediakan produk yang nyaman dan berkualitas.
                                </li>
                                <li class="flex items-start gap-2 text-sm md:text-base">
                                    <i class="fas fa-check text-red-600 mt-1 flex-shrink-0 text-sm md:text-base"></i>
                                    Mendukung komunitas olahraga lokal dengan pelayanan terbaik.
                                </li>
                                <li class="flex items-start gap-2 text-sm md:text-base">
                                    <i class="fas fa-check text-red-600 mt-1 flex-shrink-0 text-sm md:text-base"></i>
                                    Memberikan layanan desain custom yang fleksibel & mudah.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="cpx-section px-4 md:px-15">
            <x-faq :faqs="$faqs"></x-faq>
        </section>
    </main>

    <x-footer></x-footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const iframe = document.querySelector('iframe[src*="tiktok"]');
            if (iframe) {
                iframe.src = iframe.src + (iframe.src.includes('?') ? '&' : '?') + 'autoplay=1';
            }
        });
    </script>
     
    <x-script></x-script>
</body>
</html>
