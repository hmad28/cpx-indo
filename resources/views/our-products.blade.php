<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CPX Official</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
</head>
<body>
    <main>
        <x-header></x-header>

        <section id="products" class="py-10 md:pt-35 px-4 md:px-15"
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
                                            <img :src="'../images/' + product.image" alt="" class="w-full h-[160px] sm:h-[280px] md:h-[230px] lg:h-[280px] 2xl:h-[348px] mb-2">
                                        </a>
                                        
                                        <a :href="product.url" class="text-xl md:text-2xl xl:text-4xl hover:underline w-30 md:w-64 2xl:w-80 truncate font-heading" x-text="product.name"></a>
                                        
                                        {{-- Bagian Harga dengan Diskon (Update di sini) --}}
                                        <div class="w-full flex flex-col items-start md:gap-2  justify-between items-center md:mt-2">
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

                    
                </div>
            </div>
        </section>

        <x-footer></x-footer>
    </main>

    <x-script></x-script>
    <script>
        const qtyInput = document.getElementById('qty');
        const incrementBtn = document.getElementById('increment');
        const decrementBtn = document.getElementById('decrement');

        incrementBtn.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        decrementBtn.addEventListener('click', () => {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });
    </script>
</body>
</html>