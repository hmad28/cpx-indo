<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart | CPX Official</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="cpx-shell">
    <main>
        <x-header></x-header>

        <section class="pt-32 pb-8 antialiased lg:pb-16 lg:pt-40">
            <div class="cpx-container max-w-7xl 2xl:max-w-[1500px]">
                <div class="mb-8 rounded-[2rem] bg-gray-950 p-7 text-white shadow-2xl md:p-10">
                    <span class="cpx-eyebrow border-white/15 bg-white/10 text-white">Checkout</span>
                    <h2 class="cpx-heading mt-4 text-6xl md:text-8xl">Shopping Cart</h2>
                    <p class="mt-4 max-w-2xl text-white/65">Review pesanan jersey kamu sebelum lanjut checkout ke WhatsApp admin.</p>
                </div>

                <div class="mt-6 flex flex-col lg:flex-row gap-6 lg:gap-4 2xl:gap-8 justify-center">
                    <!-- Cart Items -->
                    <div class="lg:max-w-[800px] 2xl:max-w-[1200px] w-full">
                        <div class="space-y-4">
                            @forelse ($cart as $id => $item)
                                <div class="cpx-card p-4 transition hover:-translate-y-1 lg:p-6">
                                    <div class="flex flex-col md:flex-row md:items-start md:justify-between md:gap-6 space-y-4 md:space-y-0">
                                        
                                        <div class="flex gap-4 items-start md:items-center flex-1 min-w-0">
                                            <a href="{{ route('product-page', $item['slug']) }}" class="shrink-0">
                                                <img class="h-24 w-24 object-cover rounded-lg border border-gray-200 hover:border-red-600 transition-colors duration-200" 
                                                    src="{{ asset('images/' . $item['image']) }}" 
                                                    alt="{{ $item['name'] }}" />
                                            </a>
                                            <div class="flex-1 min-w-0 space-y-2">
                                                <a href="{{ route('product-page', $item['slug']) }}" class="block text-lg font-bold text-black hover:text-red-600 transition-colors duration-200 font-heading truncate">{{ $item['name'] }}</a>
                                                <p class="text-sm text-gray-600">Size: {{ $item['size'] ?? '-' }}</p>
                                                <div class="flex items-center gap-2">
                                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="flex items-center text-sm font-medium text-red-600 hover:text-red-700 hover:underline transition-colors duration-200" aria-label="Remove item">
                                                            <i class="fas fa-trash mr-1 text-sm"></i>
                                                            Remove
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex items-center justify-between md:justify-end gap-4 md:gap-6 flex-shrink-0">
                                            <div class="flex items-center border border-gray-200 rounded-md overflow-hidden">
                                                <button type="button" data-input-counter-decrement="qty-{{ $id }}" class="px-3 py-2 bg-white hover:bg-gray-50 hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 transition-all duration-200" aria-label="Decrease quantity">
                                                    <i class="fas fa-minus text-gray-600 text-sm"></i>
                                                </button>
                                                <input type="text" id="qty-{{ $id }}" data-input-counter 
                                                    class="w-12 text-center border-0 bg-transparent text-sm font-bold text-black focus:outline-none" 
                                                    value="{{ $item['qty'] }}" readonly />
                                                <button type="button" data-input-counter-increment="qty-{{ $id }}" class="px-3 py-2 bg-white hover:bg-gray-50 hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 transition-all duration-200" aria-label="Increase quantity">
                                                    <i class="fas fa-plus text-gray-600 text-sm"></i>
                                                </button>
                                            </div>
                                            
                                            {{-- Update: Tampilan Harga dengan Diskon (Responsive Hierarchy) --}}
                                            <div class="text-right min-w-[120px] space-y-1">
                                                @if(isset($item['has_discount']) && $item['has_discount'])
                                                    {{-- Harga Asli (Strikethrough, Abu-abu Kecil) --}}
                                                    <p class="text-sm text-gray-400 line-through font-normal">
                                                        Rp {{ number_format($item['original_price'], 0, ',', '.') }}
                                                    </p>
                                                    {{-- Harga Diskon (Merah Bold Besar) --}}
                                                    <p class="text-lg font-bold text-red-600">
                                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                    </p>
                                                    {{-- Badge Diskon (Kecil, Merah Muda, Hover Shadow) --}}
                                                    <div class="inline-flex items-center justify-center px-2 py-0.5 rounded-full text-xs font-semibold 
                                                                bg-red-50 border border-red-200 text-red-700 shadow-sm hover:shadow-md
                                                                transition-all duration-200">
                                                        <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                        </svg>
                                                        {{ $item['discount_percentage'] }}% OFF
                                                    </div>
                                                @else
                                                    {{-- Harga Normal (Merah Bold) --}}
                                                    <p class="text-lg font-bold text-red-600">
                                                        Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="cpx-card text-center py-12">
                                    <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-lg text-gray-600 font-medium">Keranjang kamu kosong.</p>
                                    <a href="/#products" class="mt-4 inline-block text-red-600 hover:text-red-700 hover:underline text-sm">Mulai Belanja</a>
                                </div>
                            @endforelse
                        </div>

                        <!-- People Also Bought -->
                        {{-- <div class="mt-4 xl:mt-8">
                            <h3 class="text-2xl font-semibold text-gray-900 :text-white">People also bought</h3>
                            <div class="mt-6 w-full grid grid-cols-2 md:grid-cols-3 gap-4 sm:mt-8">
                                @foreach ( $products as $product )
                                    <div class="p-3 w-full hover:border hover:border-black cursor-pointer shadow">
                                        <div class="flex flex-col items-start relative">
                                            <a href="{{ route('product-page', $product->slug) }}" class="w-full">
                                                <img src="../images/{{ $product->image }}" alt="" class="w-full mb-2 h-[160px] sm:h-[200px] md:h-[232px] lg:h-[220px] xl:h-[220px] 2xl:h-[330px]">
                                            </a>
                                            <h3 class="text-xs xl:text-sm text-gray-200 mb-1 md:mb-4 2xl:mb-2 py-1 px-2 rounded bg-red-500">{{ $product->category->name }}</h3>
                                            <a href="{{ route('product-page', $product->slug) }}" class="text-sm md:text-2xl xl:text-4xl hover:underline w-30 md:w-56 2xl:w-80 truncate font-heading">{{ $product->name }}</a>
                                            <div class="w-full flex flex-col items-start md:gap-2 lg:flex-row justify-between items-center mt-2">
                                                <h2 class="text-sm md:text-lg font-semibold text-red-500">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                                                    <a href="https://wa.me/6285172003667?text=Halo%20kak,%20saya%20mau%20beli%20{{ urlencode($product->name) }}%20dengan%20harga%20Rp{{ number_format($product->price, 0, ',', '.') }}" 
                                                target="_blank"
                                                class="w-full md:w-auto text-center mt-2 md:mt-0 py-1 px-2 md:py-2 md:px-3 text-xs xl:text-base rounded border hover:bg-black hover:text-white transition duration-300">
                                                Beli Sekarang
                                                </a>
                                            </div>
                                            <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="absolute w-6 h-6 md:w-8 md:h-8 flex justify-center items-center right-0 border border-gray-500 rounded-full text-gray-500 hover:border-black hover:text-black">
                                                @csrf
                                                <button type="submit">
                                                    <i class="fa-solid fa-cart-plus text-xs"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}

                        <section id="products" class="mt-4 xl:mt-8"
                            x-data="{
                                filter: 'all',
                                products: {{ $products->map(fn($p) => [
                                    'id' => $p->id,
                                    'slug' => $p->slug,
                                    'name' => $p->name,
                                    'price' => number_format($p->price, 0, ',', '.'), // Harga asli formatted (fallback)
                                    'original_price' => $p->original_price, // Raw number asli untuk calc
                                    'image' => $p->image,
                                    'category' => $p->category->name,
                                    'is_best_seller' => (bool) $p->is_best_seller,
                                    'is_new' => (bool) $p->is_new,
                                    'created_at' => $p->created_at ? $p->created_at->timestamp : 0,
                                    'url' => route('product-page', $p->slug),
                                    'cartUrl' => route('cart.add', $p->slug),
                                    // Field diskon baru
                                    'has_discount' => (bool) $p->has_discount,
                                    'discount_percentage' => $p->discount_percentage,
                                    'discounted_price_formatted' => $p->discounted_price_formatted,
                                    'discounted_price' => $p->discounted_price,
                                    'display_price' => $p->display_price
                                ]) }},
                                get filteredProducts() {
                                    let items = this.products;

                                    if (this.filter === 'best') {
                                        items = items.filter(p => p.is_best_seller);
                                    } else if (this.filter === 'new') {
                                        items = [...items].sort((a, b) => b.created_at - a.created_at);
                                    } else if (this.filter === 'custom') {
                                        items = items.filter(p => p.category === 'Custom Jersey');
                                    } else if (this.filter === 'accessories') {
                                        items = items.filter(p => p.category === 'Accessories');
                                    }
                                    return items;
                                }
                            }">
                            <div class="container mx-auto">
                                <div class="w-full">
                                    <div class="w-full mb-2">
                                        <h1 class="cpx-heading text-5xl">Produk lainnya</h1>
                                    </div>

                                    <!-- product grid -->
                                    <div class="w-full py-4">
                                        <div class="w-full grid grid-cols-2 md:grid-cols-3 gap-4">
                                            <template x-for="product in filteredProducts" :key="product.id">
                                                <div class="cpx-product-card p-3 cursor-pointer" x-transition>
                                                    <div class="flex flex-col items-start relative">

                                                        <a :href="product.url" class="w-full">
                                                            <img :src="'../images/' + product.image" alt="" class="mb-3 h-[160px] w-full rounded-2xl object-cover sm:h-[280px] md:h-[230px] 2xl:h-[348px]">
                                                        </a>
                                                        
                                                        <a :href="product.url" class="text-xl md:text-2xl xl:text-4xl hover:underline w-30 md:w-56 2xl:w-80 truncate font-heading" x-text="product.name"></a>
                                                        
                                                        <div class="w-full flex flex-col items-start md:gap-2 justify-between items-center md:mt-2">
                                                            {{-- Jika ada diskon --}}
                                                            <div x-show="product.has_discount" 
                                                                class="w-full flex flex-col 2xl:flex-row 2xl:gap-4 justify-between items-end md:items-start space-y-2 md:space-y-0 transition-all duration-200 ease-in-out"
                                                                x-transition:enter="transform opacity-0 scale-95"
                                                                x-transition:enter-start="opacity-0 scale-95"
                                                                x-transition:enter-end="opacity-100 scale-100"
                                                                x-transition:leave="transform opacity-100 scale-100"
                                                                x-transition:leave-start="opacity-100 scale-100"
                                                                x-transition:leave-end="opacity-0 scale-95">
                                                                
                                                                {{-- Harga Asli (Strikethrough, abu-abu kecil) --}}
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

                                                                {{-- Badge Diskon --}}
                                                                <div class="inline-flex items-center justify-center px-3 py-1.5 md:px-2 md:py-1 rounded-full text-xs md:text-sm font-semibold 
                                                                            bg-red-50 border border-red-200 text-red-700 shadow-sm hover:shadow-md
                                                                            transition-all duration-200 self-end">
                                                                    <svg class="w-3 h-3 md:w-4 md:h-4 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span x-text="product.discount_percentage + '% OFF'" class="uppercase tracking-wide"></span>
                                                                </div>
                                                            </div>

                                                            {{-- Jika tidak ada diskon --}}
                                                            <div x-show="!product.has_discount">
                                                                <h2 class="text-lg md:text-lg font-semibold text-red-500">Rp <span x-text="product.price"></span></h2>
                                                            </div>

                                                            {{-- Tombol Beli Sekarang --}}
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
                                                                :aria-label="'Tambah ' + product.name + ' ke keranjang'">
                                                                <i class="fa-solid fa-cart-plus text-xs md:text-sm transition-colors duration-200"></i>
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

                    </div>

                    <!-- Order Summary -->
                    <div class="lg:max-w-[400px] w-full lg:sticky lg:top-6 h-fit space-y-6">
                        <div class="rounded-lg border border-gray-200 bg-white p-4 sm:p-6 shadow-md">
                            <h3 class="text-xl font-bold text-black mb-4">Ringkasan Pesanan</h3>
                            @php
                                $total = collect($cart)->sum(fn($item) => $item['qty'] * $item['price']); // Pakai discounted price
                            @endphp
                            
                            <!-- Table View (Desktop) - Updated dengan Diskon -->
                            <div class="hidden lg:block">
                                <table class="w-full text-sm text-gray-700">
                                    <thead class="bg-gray-50 text-xs uppercase text-gray-900 border-b border-gray-200">
                                        <tr>
                                            <th class="py-3 px-3 text-left font-medium w-1/2">Produk</th>
                                            <th class="py-3 px-3 text-center font-medium w-1/6">Size</th>
                                            <th class="py-3 px-3 text-center font-medium w-1/6">Qty</th>
                                            <th class="py-3 px-3 text-right font-medium w-1/6">Harga</th>
                                            <th class="py-3 px-3 text-right font-medium w-1/6">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach ($cart as $id => $item)
                                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                                <td class="py-3 px-3 font-medium text-black font-heading relative group max-w-[180px] md:max-w-[220px]">
                                                    <span class="block break-words line-clamp-2" title="{{ $item['name'] }}">
                                                        {{ Str::limit($item['name'], 35, '...') }}
                                                    </span>
                                                    {{-- Tooltip (Tetap sama) --}}
                                                    <div class="absolute z-50 hidden group-hover:block bg-black text-white text-sm px-3 py-1.5 rounded-md shadow-lg font-medium leading-tight max-w-md min-w-[150px] top-0 left-full ml-2 border border-red-600 overflow-hidden">
                                                        <div class="line-clamp-2">
                                                            {{ $item['name'] }}
                                                        </div>
                                                        <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-0 h-0 border-t-4 border-r-4 border-b-4 border-transparent border-r-black"></div>
                                                    </div>
                                                </td>
                                                <td class="py-3 px-3 text-center text-gray-600">{{ $item['size'] ?? '-' }}</td>
                                                <td class="py-3 px-3 text-center" id="qty-text-{{ $id }}">{{ $item['qty'] }}</td>
                                                
                                                {{-- Update: Kolom Harga dengan Diskon (Compact untuk Table) --}}
                                                <td class="py-3 px-3 text-right space-y-0.5">
                                                    @if(isset($item['has_discount']) && $item['has_discount'])
                                                        <span class="text-xs text-gray-400 line-through block">
                                                            Rp {{ number_format($item['original_price'], 0, ',', '.') }}
                                                        </span>
                                                        <span class="text-sm font-bold text-red-600 block">
                                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                        </span>
                                                        <div class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-semibold 
                                                                    bg-red-50 border border-red-200 text-red-700 shadow-sm">
                                                            <svg class="w-3 h-3 mr-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            {{ $item['discount_percentage'] }}% OFF
                                                        </div>
                                                    @else
                                                        <span class="text-sm font-bold text-red-600">
                                                            Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="py-3 px-3 text-right font-bold text-red-600" id="subtotal-{{ $id }}">
                                                    Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- List View (Mobile) - Updated dengan Diskon -->
                            <div class="lg:hidden space-y-4">
                                @foreach ($cart as $id => $item)
                                    <div class="border border-gray-200 rounded-lg p-3 bg-gray-50 hover:bg-white transition-colors duration-150">
                                        <p class="font-bold text-black text-base font-heading truncate">{{ $item['name'] }}</p>
                                        <p class="text-sm text-gray-600 mt-1">Size: {{ $item['size'] ?? '-' }}</p>
                                        <div class="flex justify-between items-center text-sm mt-2 text-gray-700 py-1">
                                            <span class="font-medium">Qty:</span>
                                            <span class="font-bold text-black" id="qty-text-{{ $id }}">{{ $item['qty'] }}</span>
                                        </div>
                                        
                                        {{-- Update: Harga dengan Diskon (Stacked Mobile) --}}
                                        <div class="space-y-1 mt-2">
                                            @if(isset($item['has_discount']) && $item['has_discount'])
                                                <div class="text-sm text-gray-400 line-through">
                                                    Harga asli: Rp {{ number_format($item['original_price'], 0, ',', '.') }}
                                                </div>
                                                <div class="text-base font-bold text-red-600">
                                                    Harga diskon: Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </div>
                                                <div class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold 
                                                            bg-red-50 border border-red-200 text-red-700 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    {{ $item['discount_percentage'] }}% OFF
                                                </div>
                                            @else
                                                <div class="text-base font-bold text-red-600">
                                                    Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="flex justify-between items-center text-sm font-bold text-red-600 py-1 border-t border-gray-200 mt-2 pt-2">
                                            <span>Subtotal:</span>
                                            <span id="subtotal-{{ $id }}">
                                                Rp {{ number_format($item['qty'] * $item['price'], 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="pt-4 border-t border-gray-200 mt-4">
                                <dl class="flex justify-between items-center text-sm font-bold text-lg">
                                    <dt class="text-black">Total</dt>
                                    <dd class="text-red-600 font-bold" id="total-cart">
                                        Rp {{ number_format($total, 0, ',', '.') }}
                                    </dd>
                                </dl>
                            </div>
                            
                            @if (!empty($cart))
                                <a href="{{ route('cart.checkout') }}" 
                                target="_blank"
                                class="flex w-full gap-3 items-center justify-center rounded-lg bg-green-600 px-5 py-3 text-sm font-bold text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-600 transition-all duration-200 shadow-md mt-4">
                                    <svg role="img" viewBox="0 0 24 24" class="w-4 h-4" fill="white" xmlns="http://www.w3.org/2000/svg"><title>WhatsApp</title><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
                                    Checkout via WhatsApp
                                </a>
                            @endif
                            <div class="text-center pt-2">
                                <a href="/#products" class="text-red-600 hover:text-red-700 hover:underline text-sm font-medium transition-colors duration-200">Belanja Lagi</a>
                            </div>
                        </div>
                    </div>
                </div>
    
            </div>
        </section>

        <x-footer></x-footer>
    </main>

    <x-script></x-script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Tombol decrement
            document.querySelectorAll('[data-input-counter-decrement]').forEach(button => {
                button.addEventListener('click', () => {
                    const inputId = button.getAttribute('data-input-counter-decrement');
                    const input = document.getElementById(inputId);
                    let currentQty = parseInt(input.value);

                    if (currentQty > 1) {
                        const newQty = currentQty - 1;
                        updateQty(inputId.replace('qty-', ''), newQty);
                    }
                });
            });

            // Tombol increment
            document.querySelectorAll('[data-input-counter-increment]').forEach(button => {
                button.addEventListener('click', () => {
                    const inputId = button.getAttribute('data-input-counter-increment');
                    const input = document.getElementById(inputId);
                    let currentQty = parseInt(input.value);
                    const newQty = currentQty + 1;

                    updateQty(inputId.replace('qty-', ''), newQty);
                });
            });
        });

        function updateQty(productId, newQty) {
            // Loading state
            const qtyInput = document.getElementById('qty-' + productId);
            const buttons = document.querySelectorAll('[data-input-counter-decrement="qty-' + productId + '"], [data-input-counter-increment="qty-' + productId + '"]');
            buttons.forEach(btn => btn.style.opacity = '0.5');
            qtyInput.style.opacity = '0.5';

            fetch("{{ route('cart.updateQty') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: productId,
                    qty: newQty
                })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Update UI
                    qtyInput.value = newQty;
                    document.getElementById('qty-text-' + productId).innerText = newQty;
                    document.getElementById('subtotal-' + productId).innerHTML = "Rp " + data.subtotal;
                    document.getElementById('total-cart').innerHTML = "Rp " + data.total;
                }
                // Reset loading
                buttons.forEach(btn => btn.style.opacity = '1');
                qtyInput.style.opacity = '1';
            })
            .catch(() => {
                // Reset on error
                buttons.forEach(btn => btn.style.opacity = '1');
                qtyInput.style.opacity = '1';
                alert('Gagal update keranjang. Coba lagi.');
            });
        }
    </script>
</body>
</html>
