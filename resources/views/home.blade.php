<!DOCTYPE html>
<html lang="en"  style="scroll-behavior: smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
    <title>CPX Official | Sport Wear Premium Quality</title>
</head>
<body class=" font-body">
    <x-header></x-header>

    <main>
        <section id="main" class="relativ pt-19 w-full md:h-screen overflow-hidden md:pt-0 md:mt-20 2xl:mt-25">
            <div id="slider1" class="flex w-full h-full transition-transform duration-700 ease-in-out">
                <img src="{{ asset('images/main1.png') }}" class="w-full flex-shrink-0 object-cover" />
                <img src="{{ asset('images/main2.png') }}" class="w-full flex-shrink-0 object-cover" />
                <img src="{{ asset('images/main3.png') }}" class="w-full flex-shrink-0 object-cover" />
            </div>

            <!-- Navigation dots -->
            <div id="dots" class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-3">
                <!-- JS will generate dots -->
            </div>

            {{-- <div class="absolute inset-0 bg-black/50 flex flex-col mt-10 justify-center items-center text-center px-4">
                <div class="text-white max-w-6xl">
                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl mb-4 font-bold leading-tight">
                        Buat Jersey Impian, Tampil Percaya Diri di Setiap Pertandingan!
                    </h1>
                    <p class="mb-6 text-lg sm:text-xl">
                        Perusahaan pembuat jersey terpercaya dengan ratusan tim olahraga yang sudah mempercayakan desainnya kepada kami.
                    </p>
                    <a href="#products" class="border border-white hover:bg-red-500 py-3 px-6 rounded-2xl cursor-pointer duration-300 hover:shadow-xl hover:shadow-red-300">
                        Pesan Sekarang!
                    </a>
                </div>
            </div> --}}
        </section>

        <section id="about" class="py-20 px-4 md:px-15 overflow-hidden">
            <div class="container mx-auto">
                <div class="w-full md:flex">
                    <div class="w-full md:w-1/2 mb-5 md:mb-0">
                        <div class="w-full">
                            <img src="{{ asset('images/about3.jpg') }}" alt="" class="shadow-lg w-full">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 flex flex-col justify-center gap-8 px-4 md:px-8">
                        <div class="w-full mb-5 md:mb-0">
                            <h2 class="text-xl md:text-2xl mb-3 md:mb-0">About</h2>
                            <h1 class="text-6xl font-bold"><span class="italic">CP<span class="text-red-500">X</span></span> INDONESIA</h1>
                        </div>
                        <div class="w-full flex flex-col gap-5 mb-5 md:mb-0">
                            <p>Kami bukan sekadar jual jersey — kami hadir buat kamu yang punya semangat sportivitas dan gaya. Di CPX, setiap jahitan jersey kami dirancang buat kasih performa dan kenyamanan maksimal. Dari jersey bola, futsal, basket, sampai e-sport, semua bisa custom sesuai keinginan kamu.</p>

                            <p>Dengan pengalaman bertahun-tahun di industri ini, kami telah dipercaya oleh ratusan tim futsal, sepak bola, basket, hingga komunitas e-sport di seluruh Indonesia.</p>

                            <div>
                                <span>Misi Kami</span>
                                <ul class="list-disc pl-5 flex flex-col gap-2">
                                    <li class="mt-2">Memberikan kebebasan desain agar setiap tim punya ciri khas unik.</li>
                                    <li>Menggunakan bahan premium dan nyaman dipakai.</li>
                                    <li>Menjamin proses produksi cepat dan pengiriman tepat waktu.</li>
                                    <li>Memberikan pelayanan yang ramah dan konsultasi desain gratis.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="w-full">
                            <div class="w-full flex gap-3">
                                <div class="w-1/3">
                                    <img src="{{ asset('images/about2.jpg') }}" alt="" class="shadow-lg">
                                </div>
                                <div class="w-1/3">
                                    <img src="{{ asset('images/about1.jpg') }}" alt="" class="shadow-lg">
                                </div>
                                <div class="w-1/3">
                                    <img src="{{ asset('images/about4.jpg') }}" alt="" class="shadow-lg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="slider2" class="relative overflow-hidden  mt-[52px] sm:mt-0">
            <div class="slider2">
                <div class="slide relative bg-black text-white md:bg-right w-full xl:h-screen flex items-center">
                    <img src="{{ asset('images/slider1.png') }}" alt="" >
                </div>
                <div class="slide bg-black text-white md:bg-right w-full xl:h-screen hidden">
                    <img src="{{ asset('images/slider2.png') }}" alt="">
                </div>
                <div class="slide bg-black text-white md:bg-right w-full xl:h-screen hidden">
                    <img src="{{ asset('images/slider3.png') }}" alt="">
                </div>
                <div class="slide bg-black text-white md:bg-right w-full xl:h-screen hidden">
                    <img src="{{ asset('images/slider4.png') }}" alt="">
                </div>
            </div>
            <div class="absolute inset-x-0 top-5 flex justify-between items-center px-3 md:px-6">
                <button id="prev" class="text-slate-100 text-sm md:text-2xl p-2 rounded shadow-md bg-zinc-900 hover:bg-gray-200 hover:text-black duration-300">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
                <button id="next" class="text-slate-100 text-sm md:text-2xl p-2 rounded shadow-md bg-zinc-900 hover:bg-gray-200 hover:text-black duration-300">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 transform flex space-x-2">
                <button class="indicator w-2 md:w-3 h-2 md:h-3 bg-white rounded-full"></button>
                <button class="indicator w-2 md:w-3 h-2 md:h-3 bg-gray-400 rounded-full"></button>
                <button class="indicator w-2 md:w-3 h-2 md:h-3 bg-gray-400 rounded-full"></button>
                <button class="indicator w-2 md:w-3 h-2 md:h-3 bg-gray-400 rounded-full"></button>
            </div>
        </section>

        <section id="products" class="py-10 md:py-20 px-4 md:px-15"
            x-data="{
                filter: 'all',
                products: {{ $products->map(fn($p) => [
                    'id' => $p->id,
                    'slug' => $p->slug,
                    'name' => $p->name,
                    'price' => number_format($p->price, 0, ',', '.'), // Harga asli formatted (fallback)
                    'original_price' => $p->price, // Raw number asli untuk calc
                    'image' => $p->image,
                    'category' => $p->category->name,
                    'is_best_seller' => (bool) $p->is_best_seller,
                    'is_new' => (bool) $p->is_new, // Existing, tapi tambah ke array jika belum
                    'created_at' => $p->created_at ? $p->created_at->timestamp : 0,
                    'url' => route('product-page', $p->slug),
                    'cartUrl' => route('cart.add', $p->slug),
                    // Field diskon baru (dari map di route)
                    'has_discount' => (bool) $p->has_discount,
                    'discount_percentage' => $p->discount_percentage,
                    'discounted_price_formatted' => number_format($p->discounted_price, 0, ',', '.'), // Formatted untuk x-text
                    'discounted_price' => $p->discounted_price, // Raw number untuk WA/calc
                    'display_price' => $p->display_price // Raw untuk konsistensi
                ]) }},
                
                get filteredProducts() {
                    let items = this.products;

                    if (this.filter === 'best') {
                        items = items.filter(p => p.is_best_seller);
                    } else if (this.filter === 'new') {
                        items = [...items].sort((a, b) => b.created_at - a.created_at);
                    } else if (this.filter === 'custom') {
                        items = items.filter(p => p.category === 'Custom Jersey');
                    } 
                    
                    return items;
                }
            }">
            <div class="container mx-auto">
                <div class="w-full">
                    <div class="w-full mb-5">
                        <h1 class="text-4xl font-semibold mb-3">Our Products Design</h1>
                        <div class="w-[50%] h-[1px] bg-zinc-900"></div>
                    </div>

                    <!-- filter buttons (tetap sama) -->
                    <div class="w-full flex gap-2 md:gap-5">
                        <template x-for="type in ['all','best','new','custom']" :key="type">
                            <button
                                @click="filter = type"
                                :class="filter === type ? 'bg-black text-white border-black' : 'border border-white'"
                                class="py-1 px-2 text-xs md:text-base md:py-2 md:px-4 cursor-pointer hover:border hover:border-black capitalize">
                                <span x-text="type === 'best' ? 'Best Seller' : (type === 'custom' ? 'Custom Design' : (type === 'new' ? 'New' : 'All'))"></span>
                            </button>
                        </template>
                    </div>

                    <!-- product grid -->
                    <div class="w-full py-8">
                        <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                            <template x-for="product in filteredProducts" :key="product.id">
                                <div class="p-3 hover:border hover:border-black cursor-pointer shadow" x-transition>
                                    <div class="flex flex-col items-start relative">
                                        <a :href="product.url" class="w-full">
                                            <img :src="'../images/' + product.image" alt="" class="w-full h-[200px] sm:h-[280px] md:h-[230px] lg:h-[280px] 2xl:h-[348px] mb-2">
                                        </a>
                                        <a :href="product.url" class="text-sm md:text-2xl xl:text-4xl hover:underline w-30 md:w-64 2xl:w-80 truncate font-heading" x-text="product.name"></a>
                                        
                                        {{-- Bagian Harga dengan Diskon (Update di sini) --}}
                                        <div class="w-full flex flex-col items-start md:gap-2  justify-between items-center mt-2">
                                            {{-- Kondisi Diskon --}}
                                            {{-- Tampilan Harga Diskon (Improved: Responsive Hierarchy dengan Badge Pop) --}}
                                            <div x-show="product.has_discount" 
                                                class="w-full flex flex-col md:flex-row md:gap-4 justify-between items-end md:items-start space-y-2 md:space-y-0 transition-all duration-200 ease-in-out"
                                                x-transition:enter="transform opacity-0 scale-95"
                                                x-transition:enter-start="opacity-0 scale-95"
                                                x-transition:enter-end="opacity-100 scale-100"
                                                x-transition:leave="transform opacity-100 scale-100"
                                                x-transition:leave-start="opacity-100 scale-100"
                                                x-transition:leave-end="opacity-0 scale-95">
                                                
                                                {{-- Bagian Prices (Selalu Col, Responsive Size) --}}
                                                <div class="flex flex-col items-start space-y-0.5 w-full md:w-auto">
                                                    {{-- Harga Asli (Strikethrough: Kecil, Abu-abu, Subtle) --}}
                                                    <span class="text-xs md:text-sm text-gray-400 line-through font-normal tracking-wide">
                                                        Rp <span x-text="product.price"></span>
                                                    </span>
                                                    {{-- Harga Diskon (Prominent: Besar, Merah Bold, Emphasis) --}}
                                                    <span class="text-base md:text-lg lg:text-xl font-bold text-red-600 tracking-tight">
                                                        Rp <span x-text="product.discounted_price_formatted"></span>
                                                    </span>
                                                </div>
                                                
                                                {{-- Badge Diskon (Eye-Catching: Rounded, Shadow, Align Right/Bottom) --}}
                                                <div class="inline-flex items-center justify-center px-3 py-1.5 md:px-2 md:py-1 rounded-full text-xs md:text-sm font-semibold 
                                                            bg-red-50 border border-red-200 text-red-700 shadow-sm hover:shadow-md
                                                            transition-all duration-200 self-end">
                                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span x-text="product.discount_percentage + '% OFF'" class="text-xs md:taxt-base uppercase tracking-wide"></span>
                                                </div>
                                            </div>
                                            
                                            {{-- Harga Normal (Fallback, jika tidak ada diskon) --}}
                                            <div x-show="!product.has_discount">
                                                <h2 class="text-lg md:text-lg font-semibold text-red-500">Rp <span x-text="product.price"></span></h2>
                                            </div>

                                            {{-- Tombol Beli Sekarang (Update Link WA dengan Harga Diskon) --}}
                                            @foreach($productCardNumbers as $wa)
                                                <a 
                                                    :href="`{{ $wa->whatsapp_url }}Halo%20kak,%20saya%20mau%20beli%20${encodeURIComponent(product.name)}%20dengan%20harga%20Rp${product.has_discount ? product.discounted_price : product.original_price}`"
                                                    class="w-full text-center mt-2 md:mt-0 py-1 px-2 md:py-2 md:px-3 text-xs xl:text-base rounded border hover:bg-black hover:text-white transition duration-300" 
                                                    target="_blank"
                                                >
                                                    Beli Sekarang 1
                                                </a>
                                            @endforeach

                                        </div>
                                        
                                        <h3 class="absolute top-1 left-1 text-xs xl:text-sm text-gray-200 mb-1 py-1 px-2 rounded bg-red-600/70 backdrop-blur-xs" x-text="product.category"></h3>

                                        {{-- Form Cart (Improved UI/UX: Modern Circle dengan Hover Merah) --}}
                                        <form :action="product.cartUrl" method="POST"
                                            class="absolute right-1 top-1"
                                            x-data="{ isSubmitting: false }"
                                            @submit="isSubmitting = true">
                                            @csrf
                                            {{-- Hidden inputs untuk diskon (tetap) --}}
                                            <input type="hidden" name="discounted_price" :value="product.has_discount ? product.discounted_price : product.original_price">
                                            <input type="hidden" name="discount_percentage" :value="product.discount_percentage">
                                            
                                            <button type="submit"
                                                :disabled="isSubmitting"
                                                class="relative w-8 h-8 flex justify-center items-center bg-white border-2 border-gray-300 rounded-lg shadow-md hover:shadow-lg
                                                        text-gray-700 hover:border-red-500 hover:bg-red-50 hover:text-red-600
                                                        focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white
                                                        active:scale-95 active:bg-red-100 transition-all duration-200
                                                        md:hover:bg-red-600 md:hover:text-white md:hover:border-red-600
                                                        disabled:opacity-50 disabled:cursor-not-allowed"
                                                :aria-label="'Tambah ' + product.name + ' ke keranjang'"> {{-- Fix: Gunakan :aria-label dynamic Alpine --}}
                                                <i class="fa-solid fa-cart-plus text-xs md:text-sm transition-colors duration-200"></i>
                                                
                                                {{-- Optional: Loading Spinner --}}
                                                <div x-show="isSubmitting" class="absolute inset-0 flex items-center justify-center">
                                                    <i class="fa-solid fa-spinner fa-spin text-xs text-red-500"></i>
                                                </div>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>

                    <div class="w-full">
                        <button class="py-2 px-4 text-xs xl:text-base rounded border hover:bg-black hover:text-white transition duration-300"><a href="/our-products">Lihat Produk Lainnya 
                        <i class="fa-solid fa-arrow-right"></i></a></button>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <x-footer></x-footer>

    <x-script></x-script>

    <script>
         document.addEventListener("DOMContentLoaded", () => {
            // ===== Slider Main =====
            (function sliderMain() {
                const slider = document.getElementById("slider1");
                const slides = slider.children;
                const dotsContainer = document.getElementById("dots");
                let current = 0;
                let interval;

                // generate dots
                for (let i = 0; i < slides.length; i++) {
                    const dot = document.createElement("div");
                    dot.className = "w-3 h-3 rounded-full bg-white/50 cursor-pointer transition-all";
                    dot.dataset.index = i;
                    dot.onclick = () => goToSlide(i, true);
                    dotsContainer.appendChild(dot);
                }

                function updateDots() {
                    [...dotsContainer.children].forEach((dot, i) => {
                        dot.className =
                            "w-3 h-3 rounded-full cursor-pointer transition-all " +
                            (i === current ? "bg-white scale-125" : "bg-white/40");
                    });
                }

                function goToSlide(index, manual = false) {
                    current = (index + slides.length) % slides.length;
                    slider.style.transform = `translateX(-${current * 100}%)`;
                    updateDots();
                    if (manual) {
                        clearInterval(interval);
                        startAutoSlide();
                    }
                }

                function startAutoSlide() {
                    interval = setInterval(() => goToSlide(current + 1), 4000);
                }

                startAutoSlide();

                // drag support
                let startX = 0, isDragging = false;
                slider.addEventListener("mousedown", e => { startX = e.pageX; isDragging = true; clearInterval(interval); });
                slider.addEventListener("mouseup", e => {
                    if (!isDragging) return;
                    let diff = e.pageX - startX;
                    if (diff > 50) goToSlide(current - 1, true);
                    else if (diff < -50) goToSlide(current + 1, true);
                    isDragging = false;
                });
                slider.addEventListener("mouseleave", () => { isDragging = false; });
                slider.addEventListener("touchstart", e => { startX = e.touches[0].clientX; isDragging = true; clearInterval(interval); });
                slider.addEventListener("touchend", e => {
                    if (!isDragging) return;
                    let diff = e.changedTouches[0].clientX - startX;
                    if (diff > 50) goToSlide(current - 1, true);
                    else if (diff < -50) goToSlide(current + 1, true);
                    isDragging = false;
                });
            })();

            // ===== Slider Kelebihan2 =====
            (function sliderKelebihan2() {
                const slides = document.querySelectorAll("#slider2 .slide");
                const prevButton = document.getElementById("prev");
                const nextButton = document.getElementById("next");
                const indicators = document.querySelectorAll("#slider2 .indicator");
                let currentSlide = 0;

                function showSlide(index) {
                    slides.forEach((slide, i) => slide.classList.toggle("hidden", i !== index));
                    indicators.forEach((indicator, i) => {
                        indicator.classList.toggle("bg-white", i === index);
                        indicator.classList.toggle("bg-gray-400", i !== index);
                    });
                }

                prevButton.addEventListener("click", () => { currentSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1; showSlide(currentSlide); });
                nextButton.addEventListener("click", () => { currentSlide = currentSlide === slides.length - 1 ? 0 : currentSlide + 1; showSlide(currentSlide); });
                indicators.forEach((indicator, i) => indicator.addEventListener("click", () => { currentSlide = i; showSlide(currentSlide); }));

                showSlide(currentSlide);

                setInterval(() => { currentSlide = (currentSlide + 1) % slides.length; showSlide(currentSlide); }, 5000);
            })();
        });

    </script>
</body>
</html>