<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CPX Official | {{ $product->name }}</title>
    <meta property="og:title" content="{{ $product->name }}" />
    <meta property="og:description" content="Beli {{ $product->name }} dengan harga terbaik di CPX Official" />
    <meta property="og:image" content="{{ asset('images/' . $product->image) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="product" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="cpx-shell">
    <main>
        <x-header></x-header>

        <section class="pt-32 pb-8 lg:pt-40 md:pb-15">
            <div class="cpx-container cpx-card p-4 md:flex md:gap-5 lg:p-6"> {{-- Background utama --}}
    
                <!-- Product info (Layout utama: Gallery + Deskripsi) -->
                <div class="lg:flex md:pb-16 md:max-w-xl lg:max-w-3xl 2xl:max-w-5xl gap-3 lg:gap-x-8 lg:py-0 w-full">
                    
                    <!-- Image Gallery dari product_images (Fokus Perubahan Ini) -->
                    <div class="md:w-[305px] lg:w-[320px] 2xl:w-[500px] mb-6 lg:mb-0 flex flex-col">
                        <!-- Main Image (selalu dari product->image, fallback jika kosong) -->
                        <div id="mainImageContainer" data-modal-target="readImage-{{ $product->id }}" data-modal-toggle="readImage-{{ $product->id }}" class="relative overflow-hidden rounded-[1.5rem] border border-black/10 bg-white shadow-xl">
                            <img id="mainImage" 
                                src="{{ asset('images/' . $product->image) }}"  {{-- Selalu dari field image di tabel products --}}
                                alt="{{ $product->name }} - Gambar Utama" 
                                class="w-full lg:h-[310px] 2xl:h-[500px] object-cover transition-transform duration-300 hover:scale-105 hover:cursor-pointer" />
                            {{-- Jika ada multiple images (termasuk product->image + tambahan), tambah indicator --}}
                            @if(isset($images) && $images->count() > 0)
                                <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">{{ 1 + $images->count() }} Gambar</div>
                            @endif
                        </div>

                        <div id="readImage-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl 2xl:max-w-5xl max-h-full">
                                <div class="relative p-4 bg-white rounded-lg shadow-lg border border-gray-200 sm:p-5">

                                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                        <div class="text-lg text-gray-900 md:text-xl text-black">
                                            <h3 class="font-semibold text-2xl">Gambar produk {{ $product->name }}</h3>
                                        </div>

                                        <div>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex transition-colors" data-modal-toggle="readImage-{{ $product->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="w-full flex flex-col md:flex-row justify-center gap-5">
                                        <!-- Main Image (selalu dari product->image, fallback jika kosong) -->
                                        <div id="mainImageContainer" data-modal-target="readImage-{{ $product->id }}" data-modal-toggle="readImage-{{ $product->id }}" class="relative rounded-lg overflow-hidden shadow-md border border-gray-200 bg-white">
                                            <img id="mainImageModal" 
                                                src="{{ asset('images/' . $product->image) }}"  {{-- Selalu dari field image di tabel products --}}
                                                alt="{{ $product->name }} - Gambar Utama" 
                                                class="w-full lg:h-[510px] 2xl:h-[800px] object-cover transition-transform duration-300 hover:scale-105 hover:cursor-pointer" />
                                            {{-- Jika ada multiple images (termasuk product->image + tambahan), tambah indicator --}}
                                            @if(isset($images) && $images->count() > 0)
                                                <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">{{ 1 + $images->count() }} Gambar</div>
                                            @endif
                                        </div>

                                        <!-- Thumbnails Gallery (product->image sebagai pertama, + path dari product_images, scrollable horizontal) -->
                                        <div class="flex flex-row md:flex-col gap-2 mt-4 overflow-x-auto pb-2 scrollbar-hide"> {{-- Selalu tampilkan thumbnails jika ada minimal 1 --}}
                                            {{-- Thumbnail pertama: selalu dari product->image --}}
                                            <div class="relative flex-shrink-0">
                                                <img src="{{ asset('images/' . $product->image) }}"  
                                                    alt="{{ $product->name }} - Thumbnail Utama" 
                                                    class="modalImage w-16 h-16 object-cover rounded border-2 border-red-600 cursor-pointer transition-all duration-200 hover:shadow-md flex-shrink-0 active-thumbnail" 
                                                    onclick="changeMainModalImage('{{ asset('images/' . $product->image) }}')" />
                                                {{-- Active indicator untuk thumbnail pertama --}}
                                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-red-600 rounded-full border-2 border-white"></div>
                                            </div>
                                            
                                            {{-- Thumbnails tambahan: dari product_images (jika ada) --}}
                                            @if(isset($images) && $images->isNotEmpty())
                                                @foreach($images as $image)
                                                    <div class="relative flex-shrink-0">
                                                        <img src="{{ asset('images/' . $image->path) }}"  
                                                            alt="{{ $product->name }} - Thumbnail {{ $loop->iteration }}" 
                                                            class="modalImage w-16 h-16 object-cover rounded border-2 border-gray-200 hover:border-red-600 cursor-pointer transition-all duration-200 hover:shadow-md flex-shrink-0" 
                                                            onclick="changeMainModalImage('{{ asset('images/' . $image->path) }}')" />
                                                        {{-- Active indicator hanya untuk yang pertama (product->image), sisanya tidak --}}
                                                    </div>
                                                @endforeach
                                            @endif
                                            
                                            {{-- Jika tidak ada tambahan, tampilkan pesan (tapi thumbnails tetap ada yang pertama) --}}
                                            @if(!isset($images) || $images->isEmpty())
                                                <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded border-2 border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-500">
                                                    Tambahan
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Thumbnails Gallery (product->image sebagai pertama, + path dari product_images, scrollable horizontal) -->
                        <div class="flex gap-2 mt-4 overflow-x-auto pb-2 scrollbar-hide"> {{-- Selalu tampilkan thumbnails jika ada minimal 1 --}}
                            {{-- Thumbnail pertama: selalu dari product->image --}}
                            <div class="relative flex-shrink-0">
                                <img src="{{ asset('images/' . $product->image) }}"  
                                    alt="{{ $product->name }} - Thumbnail Utama" 
                                    class="w-16 h-16 object-cover rounded border-2 border-red-600 cursor-pointer transition-all duration-200 hover:shadow-md flex-shrink-0 active-thumbnail" 
                                    onclick="changeMainImage('{{ asset('images/' . $product->image) }}')" />
                                {{-- Active indicator untuk thumbnail pertama --}}
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-red-600 rounded-full border-2 border-white"></div>
                            </div>
                            
                            {{-- Thumbnails tambahan: dari product_images (jika ada) --}}
                            @if(isset($images) && $images->isNotEmpty())
                                @foreach($images as $image)
                                    <div class="relative flex-shrink-0">
                                        <img src="{{ asset('images/' . $image->path) }}"  
                                            alt="{{ $product->name }} - Thumbnail {{ $loop->iteration }}" 
                                            class="w-16 h-16 object-cover rounded border-2 border-gray-200 hover:border-red-600 cursor-pointer transition-all duration-200 hover:shadow-md flex-shrink-0" 
                                            onclick="changeMainImage('{{ asset('images/' . $image->path) }}')" />
                                        {{-- Active indicator hanya untuk yang pertama (product->image), sisanya tidak --}}
                                    </div>
                                @endforeach
                            @endif
                            
                            {{-- Jika tidak ada tambahan, tampilkan pesan (tapi thumbnails tetap ada yang pertama) --}}
                            @if(!isset($images) || $images->isEmpty())
                                <div class="flex-shrink-0 w-16 h-16 bg-gray-100 rounded border-2 border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-500">
                                    Tambahan
                                </div>
                            @endif
                        </div>

                        <style>
                            .scrollbar-hide::-webkit-scrollbar { display: none; }
                            .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
                        </style>
                    </div>

                    <!-- Deskripsi Produk (Diperbaiki warna: Hitam untuk teks utama) -->
                    <div class="w-full md:w-[300px] lg:w-[400px] 2xl:w-[600px] pr-4 lg:border-r lg:border-black/10">
                        <div class="w-full flex flex-col items-start">
                            <h1 class="cpx-heading text-5xl tracking-tight text-black sm:text-6xl md:text-7xl">{{ $product->name }}</h1>
                            <p class="mt-3 rounded-full bg-red-600 px-3 py-1 text-xs font-black text-white xl:text-sm">{{ $product->category->name }}</p>
                        </div>

                        <div class="w-full py-4 lg:pt-3 lg:pr-8 lg:pb-5">
                            <!-- Kelebihan -->
                            <div class="mt-5 md:mt-3 lg:mt-10">
                                <h3 class="text-sm font-medium text-black mb-2">Kelebihan</h3>
                                <ul role="list" class="list-disc space-y-2 pl-5 text-sm text-gray-700">
                                    @foreach (json_decode($product->kelebihan ?? '[]') as $item)
                                        <li class="flex items-start">
                                            <svg class="w-3 h-3 text-red-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="leading-relaxed">{{ $item }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Detail Produk -->
                            <div class="mt-5 lg:mt-10">
                                <h2 class="text-sm font-medium text-black mb-2">Detail Produk</h2>
                                <div class="text-sm text-gray-700 leading-relaxed">{!! $product->description !!}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Options -->
                <div class="mt-6 lg:px-4 lg:mt-0">
                    <h2 class="sr-only">Product information</h2>

                    {{-- Tampilan Harga dengan Diskon --}}
                    @if(isset($hasDiscount) && $hasDiscount)
                        {{-- Harga Asli (Strikethrough, Abu-abu) --}}
                        <p class="text-2xl tracking-tight text-gray-500 line-through font-medium">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                        
                        {{-- Harga Diskon (Besar, Merah) --}}
                        <p class="text-3xl tracking-tight text-gray-900 font-semibold text-red-600">
                            Rp {{ number_format($discountedPrice, 0, ',', '.') }}
                        </p>
                        
                        {{-- Badge Diskon (Merah Muda) --}}
                        <div class="mt-2 inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 1h10v12H5V3zm2 3a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            Diskon {{ number_format($discountPercentage, 1) }}%
                        </div>
                    @else
                        {{-- Harga Normal (seperti sebelumnya) --}}
                        <p class="text-3xl tracking-tight text-gray-900 font-semibold text-red-600">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </p>
                    @endif

                    <!-- Reviews (kosong, bisa ditambah nanti) -->
                    <div class="mt-6">
                        <h3 class="sr-only">Reviews</h3>
                    </div>

                    <form action="{{ route('cart.add', $product->slug) }}" method="POST" class="mt-5 md:mt-10">
                        @csrf
                        {{-- Hidden input untuk pass harga diskon ke cart (opsional, handle di CartController) --}}
                        @if(isset($hasDiscount) && $hasDiscount)
                            <input type="hidden" name="discounted_price" value="{{ $discountedPrice }}">
                            <input type="hidden" name="discount_percentage" value="{{ $discountPercentage }}">
                        @endif

                        <!-- Sizes (tetap sama seperti kode kamu) -->
                        <div class="mt-5 md:mt-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-sm font-medium text-gray-900 text-black">Ukuran</h3>
                            </div>

                            <fieldset aria-label="Choose a size" class="my-4">
                                <div class="grid grid-cols-4 gap-3">
                                    @foreach($sizes as $size)
                                        <label class="group relative flex items-center justify-center rounded-md border border-gray-300 bg-white p-1 md:p-3 
                                                    has-checked:border-red-600 has-checked:bg-red-600 
                                                    has-focus-visible:outline-2 has-focus-visible:outline-offset-2 has-focus-visible:outline-red-600 
                                                    has-disabled:border-gray-400 has-disabled:bg-gray-200 has-disabled:opacity-25 hover:border-red-400 transition-colors">

                                            <input type="radio" 
                                                name="size" 
                                                value="{{ $size->name }}" 
                                                class="absolute inset-0 appearance-none focus:outline-none disabled:cursor-not-allowed" 
                                                required />

                                            <span class="text-sm font-medium uppercase group-has-checked:text-white text-gray-900">
                                                {{ $size->name }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </fieldset>

                            <button type="button" data-modal-target="readProductModal-{{ $product->id }}" data-modal-toggle="readProductModal-{{ $product->id }}" class="text-xs text-red-600 hover:text-red-800 hover:underline font-medium">Panduan Ukuran</button>

                            <!-- Modal Panduan Ukuran (tetap sama seperti kode kamu) -->
                            <div id="readProductModal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-xl max-h-full">
                                    <div class="relative p-4 bg-white rounded-lg shadow-lg border border-gray-200 sm:p-5">
                                        <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                            <div class="text-lg text-gray-900 md:text-xl text-black">
                                                <h3 class="font-semibold text-2xl">Panduan ukuran {{ $product->name }}</h3>
                                            </div>
                                            <div>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex transition-colors" data-modal-toggle="readProductModal-{{ $product->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-full">
                                            <img src="{{ asset('images/' . $product->size_image)  }}" 
                                                alt="Panduan Ukuran {{ $product->name }}" 
                                                class="w-full h-[512px] object-contain rounded border border-gray-200">
                                        </div>

                                        <div class="mt-8 bg-red-50 border-l-4 border-red-600 p-4 rounded-lg">
                                            <h2 class="text-lg font-semibold text-red-700 mb-2">Tips Memilih Ukuran:</h2>
                                            <ul class="list-disc pl-5 space-y-2 text-gray-700">
                                                <li>Jika ragu, pilih ukuran lebih besar agar lebih nyaman.</li>
                                                <li>Bandingkan dengan ukuran kaos yang biasa kamu pakai.</li>
                                                <li>Ukuran bisa sedikit berbeda (1–2 cm) tergantung metode produksi.</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Bagian Jumlah (tetap sama) --}}
                        <div class="w-full mt-4">
                            <div class="flex items-center">
                                <button type="button" id="decrement" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-50 hover:border-red-600 transition-colors">
                                    <svg class="h-3 w-3 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>

                                <input type="text" name="qty" id="qty" value="1" readonly class="w-12 text-center border-0 bg-transparent text-sm font-medium text-gray-900 mx-2" />

                                <button type="button" id="increment" class="inline-flex h-8 w-8 items-center justify-center rounded-md border border-gray-300 bg-white hover:bg-gray-50 hover:border-red-600 transition-colors">
                                    <svg class="h-3 w-3 text-gray-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="mt-4 md:mt-10 flex w-full items-center justify-center rounded-md bg-red-600 px-8 py-3 text-white hover:bg-red-700 transition-colors shadow-md">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            {{-- Modal Panduan Ukuran (Sederhana, bisa pakai Alpine.js atau JS) --}}
            <div id="sizeModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
                <div class="bg-white rounded-lg max-w-lg w-full max-h-[90vh] overflow-y-auto">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-black">Panduan Ukuran {{ $product->name }}</h3>
                            <button onclick="closeSizeModal()" class="text-gray-500 hover:text-black">&times;</button>
                        </div>
                        <img src="{{ asset('images/' . ($product->size_image ?? 'default-size-guide.jpg')) }}" alt="Panduan Ukuran" class="w-full h-64 object-contain rounded mb-4 border border-gray-200">
                        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded">
                            <h4 class="text-lg font-semibold text-red-700 mb-2">Tips:</h4>
                            <ul class="list-disc pl-5 text-gray-700 space-y-1">
                                <li>Jika ragu, pilih ukuran lebih besar.</li>
                                <li>Bandingkan dengan ukuran biasa Anda.</li>
                                <li>Selisih ukuran ±1-2 cm normal.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Lainnya -->
            {{-- <div class="mt-4 xl:mt-8 md:max-w-xl lg:max-w-6xl 2xl:max-w-7xl mx-auto">
                <h3 class="text-2xl font-semibold text-gray-900 :text-white">People also bought</h3>
                <div class="mt-6 w-full flex flex-wrap md:flex-nowrap md:gap-4 sm:mt-8">
                    @foreach ( $products as $product )
                        <div class="p-3 w-1/2 md:w-1/3 hover:border hover:border-black cursor-pointer shadow">
                            <div class="flex flex-col items-start relative">

                                <a href="{{ route('product-page', $product->slug) }}">
                                    <img src="../images/{{ $product->image }}" alt="" class="w-full h-[160px] sm:h-[280px] md:h-[230px] lg:h-[280px] 2xl:h-[348px] mb-2">
                                </a>

                                

                                <a href="{{ route('product-page', $product->slug) }}" class="text-xl md:text-2xl xl:text-4xl hover:underline w-30 md:w-64 2xl:w-80 truncate font-heading">{{ $product->name }}</a>

                                <div class="w-full flex flex-col items-start md:gap-2 lg:flex-row justify-between items-center mt-2">
                                    <h2 class="text-sm md:text-lg font-semibold text-red-500">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>
                                        <a href="https://wa.me/6281234567890?text=Halo%20kak,%20saya%20mau%20beli%20{{ urlencode($product->name) }}%20dengan%20harga%20Rp{{ number_format($product->price, 0, ',', '.') }}" 
                                    target="_blank"
                                    class="w-full md:w-auto text-center mt-2 md:mt-0 py-1 px-2 md:py-2 md:px-3 text-xs xl:text-base rounded border hover:bg-black hover:text-white transition duration-300">
                                    Beli Sekarang
                                    </a>
                                </div>

                                <h3 class="absolute top-1 left-1 text-xs xl:text-sm text-gray-200 mb-1 py-1 px-2 rounded bg-red-600/70 backdrop-blur-xs">{{ $product->category->name }}</h3>

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

            <section id="products" class="mt-4 xl:mt-10 md:max-w-xl lg:max-w-6xl 2xl:max-w-7xl mx-auto"
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
                        } else if (this.filter === 'accessories') {
                            items = items.filter(p => p.category === 'Accessories');
                        }
                        return items;
                    }
                }">
                <div class="container mx-auto">
                    <div class="w-full">
                        <div class="w-full mb-2">
                            <h1 class="text-4xl font-semibold">Produk lainnya</h1>
                        </div>

                        <!-- product grid -->
                        <div class="w-full py-4">
                            <div class="w-full grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <template x-for="product in filteredProducts" :key="product.id">
                                    <div class="p-3 hover:border hover:border-black cursor-pointer shadow" x-transition>
                                        <div class="flex flex-col items-start relative">

                                            <a :href="product.url" class="w-full">
                                                <img :src="'../images/' + product.image" alt="" class="w-full h-[160px] sm:h-[280px] md:h-[230px] lg:h-[280px] 2xl:h-[310px] mb-2">
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
            
        </section>

        <x-footer></x-footer>
    </main>

    <x-script></x-script>
    <script>
        // JS untuk Gallery: Ganti main image saat klik thumbnail
        // Fungsi untuk ganti gambar utama (sudah ada, tapi pastikan konsisten)
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            const thumbnails = document.querySelectorAll('.w-16');  // Semua thumbnails
            mainImage.src = imageSrc;
            mainImage.classList.add('transition-transform', 'duration-300');
            
            // Update active indicator: hilangkan semua, tambah ke yang diklik
            thumbnails.forEach(thumb => {
                thumb.classList.remove('border-red-600', 'active-thumbnail');
                thumb.classList.add('border-gray-200');
                // Hilangkan indicator
                const indicator = thumb.parentElement.querySelector('div.absolute');
                if (indicator) indicator.style.display = 'none';
            });
            
            // Tambah active ke thumbnail yang diklik
            event.target.classList.remove('border-gray-200');
            event.target.classList.add('border-red-600', 'active-thumbnail');
            const newIndicator = event.target.parentElement.querySelector('div.absolute') || 
                                event.target.parentElement.appendChild(document.createElement('div'));
            if (!newIndicator.classList.contains('absolute')) {
                newIndicator.className = 'absolute -bottom-1 -right-1 w-4 h-4 bg-red-600 rounded-full border-2 border-white';
            }
            newIndicator.style.display = 'block';
            
            // Efek zoom ringan
            mainImage.style.transform = 'scale(1.02)';
            setTimeout(() => { mainImage.style.transform = 'scale(1)'; }, 300);
        }

        function changeMainModalImage(imageSrc) {
            const mainImage = document.getElementById('mainImageModal');
            const thumbnails = document.querySelectorAll('.modalImage');  // Semua thumbnails
            mainImage.src = imageSrc;
            mainImage.classList.add('transition-transform', 'duration-300');
            
            // Update active indicator: hilangkan semua, tambah ke yang diklik
            thumbnails.forEach(thumb => {
                thumb.classList.remove('border-red-600', 'active-thumbnail');
                thumb.classList.add('border-gray-200');
                // Hilangkan indicator
                const indicator = thumb.parentElement.querySelector('div.absolute');
                if (indicator) indicator.style.display = 'none';
            });
            
            // Tambah active ke thumbnail yang diklik
            event.target.classList.remove('border-gray-200');
            event.target.classList.add('border-red-600', 'active-thumbnail');
            const newIndicator = event.target.parentElement.querySelector('div.absolute') || 
                                event.target.parentElement.appendChild(document.createElement('div'));
            if (!newIndicator.classList.contains('absolute')) {
                newIndicator.className = 'absolute -bottom-1 -right-1 w-4 h-4 bg-red-600 rounded-full border-2 border-white';
            }
            newIndicator.style.display = 'block';
            
            // Efek zoom ringan
            mainImage.style.transform = 'scale(1.02)';
            setTimeout(() => { mainImage.style.transform = 'scale(1)'; }, 300);
        }

        // JS untuk Quantity
        document.addEventListener('DOMContentLoaded', () => {
            const qtyInput = document.getElementById('qty');
            document.getElementById('decrement').addEventListener('click', () => {
                if (qtyInput.value > 1) qtyInput.value--;
            });
            document.getElementById('increment').addEventListener('click', () => {
                if (qtyInput.value < 99) qtyInput.value++;
            });
        });

        // JS untuk Modal (Sederhana)
        function openSizeModal(id) { document.getElementById('sizeModal').classList.remove('hidden'); }
        function closeSizeModal() { document.getElementById('sizeModal').classList.add('hidden'); }

        const price = {{ $hasDiscount ? $discountedPrice : $product->price }};
        function updateTotal() {
            const qty = document.getElementById('qty').value;
            // Asumsi ada <span id="total">, update: document.getElementById('total').textContent = 'Rp ' + (price * qty).toLocaleString();
        }
        document.getElementById('increment').onclick = () => { /* increment logic */ updateTotal(); };
        // Serupa untuk decrement
    </script>
</body>
</html>