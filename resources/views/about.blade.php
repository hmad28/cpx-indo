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
<body>
    <x-header></x-header>

    <main>
        <section id="hero" class="hero pt-20 md:pt-30 pb-10 md:pb-20 md:h-screen px-8 md:px-15 flex items-center bg-zinc-900" style="background-image: url('{{ asset('images/bg-hero-about.png') }}'); background-size: cover;">
            <div class="container mx-auto">
                <div class="w-full md:flex items-center">
                    <div class="md:w-1/2 pt-20 sm:pt-0">
                        <h1 class="text-white text-6xl font-bold mb-4"><span class="italic ml-15 sm:ml-0">CP<span class="text-red-500">X</span></span> Jersey</h1>
                        <h2 class="text-lg md:text-2xl mb-2 text-gray-400 font-semibold">Custom Jersey • Kualitas Tinggi • Harga Terbaik</h2>
                        <p class="text-gray-400">
                            Dari lapangan kecil sampai panggung nasional, kami hadir untuk kamu yang ingin tampil beda dan percaya diri.
                            Buat jersey impianmu di sini — cepat, mudah, dan berkualitas.
                        </p>
                    </div>
                    <div class="md:w-1/2 flex justify-end gap-2 md:gap-5">
                        <div class="w-1/4 mt-10">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                        </div>
                        <div class="w-1/4 mt-20">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                        </div>
                        <div class="w-1/4 mt-30">
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-1.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                            <div class="w-full mb-2 md:mb-5">
                                <img src="{{ asset('images/about-3.jpg') }}" alt="" class="rounded-2xl">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="about" class="bg-white py-8 md:py-12 lg:py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row items-center gap-6 md:gap-12">
                    <!-- TikTok Video Embed Side (Autoplay Enabled) -->
                    <div class="md:w-1/2 flex justify-center md:justify-start">
                        <div class="bg-white rounded-lg border border-black shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden max-w-full w-full">
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
                        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-black leading-tight">Visi & Misi Kami</h1>
                        
                        <div class="space-y-4">
                            <h2 class="text-xl md:text-2xl font-semibold text-red-600">Visi Kami</h2>
                            <p class="text-base md:text-lg text-black/80 leading-relaxed">Menjadi brand lokal kebanggaan Indonesia yang menyediakan jersey custom berkualitas tinggi untuk komunitas dan individu di seluruh penjuru negeri.</p>
                        </div>

                        <div class="space-y-4">
                            <h2 class="text-xl md:text-2xl font-semibold text-red-600 mt-4 md:mt-6">Misi Kami</h2>
                            <ul class="space-y-2 text-black/80 list-none pl-0">
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

        <section id="faq" class="px-4 md:px-15">
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