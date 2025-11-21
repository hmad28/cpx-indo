<x-app-layout>
    @push('style')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="text-gray-900 p-5">
                    <section class=" p-3 sm:p-0 antialiased">
                        <h2 class="text-xl font-bold pl-4 mb-4">Products</h2>
                        <div class="md:max-w-screen-xl 2xl:max-w-full">
                            <div class="bg-white relative border sm:rounded-lg overflow-hidden">

                                {{-- Success & Error --}}
                                @if(session('success'))
                                    <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                {{-- Search & Button --}}
                                <div class="flex flex-col md:flex-row items-center md:justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                                    <div class="w-full md:w-1/2">
                                        <form class="flex items-center" method="GET">
                                            <label for="simple-search" class="sr-only">Search Product</label>
                                            <div class="relative w-full">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 
                                                            1110.89 3.476l4.817 4.817a1 1 0 
                                                            01-1.414 1.414l-4.816-4.816A6 
                                                            6 0 012 8z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="simple-search" name="keyword"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                                        focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2"
                                                    placeholder="Search product">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 
                                                items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                        <button type="button" id="createProductModalButton"
                                            data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 
                                                focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 
                                                    110 2h-5v5a1 1 0 
                                                    11-2 0v-5H4a1 1 0 
                                                    110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Add product
                                        </button>
                                    </div>
                                </div>

                                <div class="hidden md:block my-4 xl:px-2 md:max-w-6xl 2xl:max-w-7xl mx-auto">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6">
                                        @forelse ($products as $product)
                                            <div class="bg-white shadow-md rounded-lg p-5 flex flex-col relative h-full border border-gray-200 hover:border-black hover:shadow-lg transition-all duration-300 overflow-hidden">
                                                
                                                {{-- Gambar Produk --}}
                                                <div class="mb-4">
                                                    @if($product->image)
                                                        <img src="{{ asset('images/'.$product->image) }}" 
                                                            alt="Main {{ $product->name }}"
                                                            class="w-full h-48 object-cover rounded-md mb-3">
                                                    @endif

                                                    {{-- Gambar Tambahan --}}
                                                    @if($product->images->isNotEmpty())
                                                        <div class="flex flex-wrap gap-2">
                                                            @foreach($product->images->take(4) as $img) {{-- Batasi 4 gambar untuk menghindari overflow --}}
                                                                <img src="{{ asset('images/'.$img->path) }}" 
                                                                    alt="Additional {{ $product->name }}"
                                                                    class="w-16 h-16 object-cover rounded-md border border-gray-300 hover:border-gray-400 transition-colors">
                                                            @endforeach
                                                            @if($product->images->count() > 4)
                                                                <div class="w-16 h-16 bg-gray-100 rounded-md flex items-center justify-center text-xs text-gray-500 font-medium">
                                                                    +{{ $product->images->count() - 4 }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                </div>

                                                {{-- Info Produk --}}
                                                <div class="flex flex-col flex-grow">
                                                    {{-- Badge Kategori --}}
                                                    @if($product->category)
                                                        <span class="inline-block text-xs font-semibold text-red-800 bg-red-100 px-2 py-1 rounded-full w-fit mb-3 uppercase tracking-wide">
                                                            {{ $product->category->name }}
                                                        </span>
                                                    @else
                                                        <span class="inline-block text-xs font-semibold text-gray-500 bg-gray-100 px-2 py-1 rounded-full w-fit mb-3 uppercase tracking-wide">
                                                            Uncategorized
                                                        </span>
                                                    @endif

                                                    {{-- Nama Produk --}}
                                                    <h3 class="text-lg font-bold text-black mb-2 line-clamp-2 leading-tight">
                                                        {{ $product->name }}
                                                    </h3>

                                                    {{-- Harga --}}
                                                    <p class="text-red-600 font-semibold text-lg mb-3">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </p>

                                                    {{-- Ukuran --}}
                                                    @if($product->sizes->isNotEmpty())
                                                        <div class="flex flex-wrap gap-2 mb-3">
                                                            @foreach($product->sizes as $size)
                                                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full border border-gray-300 hover:bg-gray-200 transition-colors">
                                                                    {{ $size->name }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <p class="text-gray-500 text-xs italic mb-3">Tidak ada ukuran tersedia</p>
                                                    @endif

                                                    {{-- Panduan Ukuran --}}
                                                    @if($product->size_image)
                                                        <div class="mb-3">
                                                            <img src="{{ asset('images/'.$product->size_image) }}" 
                                                                alt="Size guide {{ $product->name }}"
                                                                class="w-20 h-20 object-contain rounded border border-gray-300">
                                                        </div>
                                                    @endif

                                                    {{-- Deskripsi --}}
                                                    @if($product->description)
                                                        <div class="text-sm text-gray-700 mb-3 line-clamp-3 leading-relaxed">
                                                            {!! Str::limit(strip_tags($product->description), 120) !!}
                                                        </div>
                                                    @endif

                                                    {{-- Kelebihan --}}
                                                    @php
                                                        $kelebihanArray = json_decode($product->kelebihan, true) ?? [];
                                                    @endphp
                                                    @if(!empty($kelebihanArray))
                                                        <ul class="text-xs text-gray-600 mb-4 space-y-1 line-clamp-3 max-h-16 overflow-hidden">
                                                            @foreach (array_slice($kelebihanArray, 0, 3) as $item) {{-- Batasi 3 item --}}
                                                                <li class="flex items-start">
                                                                    <svg class="w-3 h-3 text-red-500 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="leading-relaxed">{{ $item }}</span>
                                                                </li>
                                                            @endforeach
                                                            @if(count($kelebihanArray) > 3)
                                                                <li class="text-xs text-gray-500 italic">... dan {{ count($kelebihanArray) - 3 }} lagi</li>
                                                            @endif
                                                        </ul>
                                                    @endif

                                                    {{-- Spacer untuk tombol di bawah --}}
                                                    <div class="flex-grow"></div>

                                                    {{-- Action Buttons --}}
                                                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                                        <a href="{{ route('product-page', $product->slug) }}" 
                                                        class="text-sm text-black font-medium hover:text-red-600 transition-colors">
                                                            Preview →
                                                        </a>
                                                        <div class="flex gap-2">
                                                            <button type="button" 
                                                                    data-modal-target="updateProductModal-{{ $product->id }}" 
                                                                    data-modal-toggle="updateProductModal-{{ $product->id }}" 
                                                                    class="text-xs px-3 py-1.5 border border-gray-300 rounded-md text-gray-700 font-medium hover:bg-gray-50 hover:border-black transition-all">
                                                                Edit
                                                            </button>
                                                            <button type="button" 
                                                                    data-modal-target="deleteModal-{{ $product->id }}" 
                                                                    data-modal-toggle="deleteModal-{{ $product->id }}" 
                                                                    class="text-xs px-3 py-1.5 border border-red-300 rounded-md text-red-600 font-medium hover:bg-red-50 hover:border-red-500 transition-all">
                                                                Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            {{-- Empty State: Belum ada produk --}}
                                                <div class="col-span-full bg-white border border-black rounded-lg p-8 md:p-12 text-center shadow-md"> {{-- col-span-full agar span seluruh grid; tema putih-hitam; responsive padding --}}
                                                    <div class="space-y-4">
                                                        <i class="fas fa-box-open text-4xl md:text-6xl text-gray-400 mb-4"></i> {{-- Icon box kosong; ukuran responsive; subtle gray untuk tidak dominan --}}
                                                        <h3 class="text-xl md:text-2xl font-bold text-black">Belum Ada Produk</h3> {{-- Heading bold black --}}
                                                        <p class="text-sm md:text-base text-black/70 max-w-md mx-auto">Database produk masih kosong. Mulai tambahkan produk baru untuk menampilkan di sini.</p> {{-- Pesan subtle black/70; centered dan limited width --}}
                                                        <button type="button" id="createProductModalButton"
                                                            data-modal-target="createProductModal" data-modal-toggle="createProductModal"
                                                            class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 
                                                                focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                                <path clip-rule="evenodd" fill-rule="evenodd"
                                                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 
                                                                    110 2h-5v5a1 1 0 
                                                                    11-2 0v-5H4a1 1 0 
                                                                    110-2h5V4a1 1 0 011-1z" />
                                                            </svg>
                                                            Add product
                                                        </button>
                                                    </div>
                                                </div>
                                        @endforelse
                                    </div>
                                </div>

                                {{-- MOBILE CARDS --}}
                                <div class="block md:hidden p-4 space-y-4">
                                    @foreach ($products as $product)
                                        <div class="bg-white border rounded-lg p-3 shadow">
                                            <div class="flex items-center space-x-3">
                                                <img src="../images/{{ $product->image }}" class="w-16 h-16 rounded object-cover">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $product->category->name ?? 'None' }}</p>
                                                    <p class="text-blue-600 font-bold">
                                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700 line-clamp-2">
                                                {!! $product->description !!}
                                            </div>
                                            <div class="mt-2 flex flex-wrap gap-1">
                                                @if($product->sizes->isNotEmpty())
                                                    @foreach($product->sizes as $size)
                                                        <span class="bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded">
                                                            {{ $size->name }}
                                                        </span>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="mt-3 flex justify-end gap-1">
                                                {{-- Actions dropdown atau tombol langsung --}}
                                                    <button type="button" data-modal-target="updateProductModal-{{ $product->id }}" data-modal-toggle="updateProductModal-{{ $product->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200"> <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" /> </svg></button> 
                                                    <button type="button" data-modal-target="readProductModal-{{ $product->id }}" data-modal-toggle="readProductModal-{{ $product->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200"> <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" /> </svg></button> 
                                                    <button type="button" data-modal-target="deleteModal-{{ $product->id }}" data-modal-toggle="deleteModal-{{ $product->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 text-red-500 :hover:text-red-400"> <svg class="w-4 h-4" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"> <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" /> </svg></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                {{-- Pagination --}}
                                @if ($products->hasPages())
                                    <div class="p-3">
                                        {{ $products->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>
                    <!-- End block -->

                    <!-- Create modal -->
                    <div id="createProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 :text-white">Add Product</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-target="createProductModal" data-modal-toggle="createProductModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="post-form" class="post-form">
                                    @csrf
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Nama Produk</label>
                                            <input type="text" name="name" id="name" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 placeholder:text-black/50 transition-colors duration-200" placeholder="Masukkan nama produk" required>
                                        </div>
                                        <div>
                                            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Harga</label>
                                            <input type="number" name="price" id="price" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 placeholder:text-black/50 transition-colors duration-200" placeholder="Masukkan harga" required>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Gambar</label>
                                            <input 
                                            class="filepond-product @error('images') border-red-500 @enderror  block w-full text-sm text-black border border-black/30 rounded-lg cursor-pointer bg-white/50 p-3 transition-colors duration-200" 
                                            id="images" 
                                            name="images[]" 
                                            type="file" 
                                            multiple 
                                            accept="image/png, image/jpg, image/jpeg">
                                            @error('image')
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                            <p class="text-xs text-black/60 mt-1">Pilih beberapa gambar (PNG, JPG, JPEG). Maksimal 5MB per file.</p>
                                        </div>
                                        
                                        <div>
                                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Kategori Produk</label>
                                            <select id="category" name="category_id" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 transition-colors duration-200">
                                                <option selected="">Select category</option>
                                                @foreach ($categories as $category )
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div>
                                            <label for="sizes" class="block mb-2 text-sm font-medium text-gray-900">Pilih Ukuran</label>
                                            @php
                                                $selectedSizes = old('sizes', isset($product) ? $product->sizes->pluck('id')->toArray() : []);
                                            @endphp

                                            @foreach($sizes as $size)
                                                <label class="inline-flex items-center mr-4">
                                                    <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                                        @checked(in_array($size->id, $selectedSizes)) class="form-checkbox h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                                    <span class="ml-1">{{ $size->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Panduan Ukuran</label>
                                            <input class="filepond-size @error('avatar') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500  @enderror block w-full text-sm text-black border border-black/30 rounded-lg cursor-pointer bg-white/50 p-3 transition-colors duration-200" aria-describedby="avatar_help" id="size_image" name="size_image" type="file" accept="image/png, image/jpg, image/jpeg">
                                            @error('size_image')
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                            <p id="size_image_help" class="text-xs text-black/60 mt-1">Unggah gambar panduan ukuran (PNG, JPG, JPEG).</p>
                                        </div>
                                        <div class="sm:col-span-2">
                                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Deskripsi</label>
                                            <textarea id="description" name="description" rows="4" class="description hidden p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Deskripsi Produk (MAKS. 2000 Karakter)"></textarea>
                                            <div id="editor-create" class="editor">{!! old('description') !!}</div>
                                            @error('description')
                                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div x-data="{ advantages: [] }">
                                            <!-- Tombol Tambah -->
                                            <label for="kelebihan" class="block mb-2 mt-18 text-sm font-medium text-gray-900">Kelebihan Produk</label>
                                            <button
                                                id="kelebihan"
                                                type="button"
                                               @click="advantages.push('')"
                                                class="bg-gray-200 text-gray-900 px-3 py-1 rounded mb-2 mt-1 text-sm"
                                            >
                                                + Tambah Kelebihan
                                            </button>
                                            <template id="kelebihan" x-for="(advantage, index) in advantages" :key="index">
                                                <div class="mb-2 flex items-center gap-2">
                                                    <input
                                                        type="text"
                                                        id="kelebihan"
                                                        name="kelebihan[]"
                                                        x-model="advantages[index]"
                                                        placeholder="Kelebihan produk..."
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500"
                                                    >

                                                    <!-- Tombol Hapus -->
                                                    <button
                                                        type="button"
                                                        @click="advantages.splice(index, 1)"
                                                        class="text-red-500 font-bold px-2 hover:text-red-700"
                                                        title="Hapus"
                                                    >
                                                        ✕
                                                    </button>
                                                </div>
                                            </template>

                                            
                                        </div>

                                    </div>
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">
                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Add new product
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Update modal -->
                    @foreach ($products as $product)
                        <div id="updateProductModal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5 z-[999]">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 :text-white">Update Product</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-toggle="updateProductModal-{{ $product->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{ route('products.update', $product->slug) }}" method="POST" enctype="multipart/form-data" class="post-form">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                            <div>
                                                <label for="name-{{ $product->id }}" class="block mb-2 text-sm font-semibold text-black">Nama Produk</label>
                                                <input type="text" name="name" id="name-{{ $product->id }}" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 placeholder:text-black/50 transition-colors duration-200" value="{{ old('name', $product->name) }}" required>
                                            </div>
                                            
                                            <div>
                                                <label for="price-{{ $product->id }}" class="block mb-2 text-sm font-semibold text-black">Harga</label>
                                                <input type="number" name="price" id="price-{{ $product->id }}" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 placeholder:text-black/50 transition-colors duration-200" value="{{ old('price', $product->price) }}" required>
                                            </div>
                                            
                                            <div class="sm:col-span-2">
                                                <label for="images-{{ $product->id }}" class="block mb-2 text-sm font-semibold text-black">Gambar Produk</label>
                                                <input 
                                                    class="filepond filepond-update-{{ $product->id }} @error('images') border-red-500 ring-2 ring-red-500 @enderror block w-full text-sm text-black border border-black/30 rounded-lg cursor-pointer bg-white/50 p-3 transition-colors duration-200" 
                                                    id="images-{{ $product->id }}" 
                                                    name="images[]" 
                                                    type="file" 
                                                    multiple 
                                                    accept="image/png, image/jpg, image/jpeg, image/webp"
                                                    data-max-files="8"
                                                    data-allow-reorder="true">
                                                @error('images')
                                                    <p class="text-red-600 text-sm mt-1 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                                {{-- Preload existing images: Tampilkan sebagai thumbnails --}}
                                                <div class="existing-images-preview mt-3 flex flex-wrap gap-3" id="existing-preview-{{ $product->id }}">
                                                    @foreach ($product->images as $image)
                                                        @if($image->path && file_exists(public_path('images/'.$image->path)))
                                                            <div class="existing-image-item relative w-20 h-20 bg-gray-100 rounded-lg overflow-hidden border border-black/20 shadow-sm hover:shadow-md transition-shadow duration-200" 
                                                                data-image-id="{{ $image->id }}" 
                                                                data-image-path="{{ $image->path }}">
                                                                <img src="{{ asset('images/' . $image->path) }}" alt="Existing image" class="w-full h-full object-cover">
                                                                <button type="button" class="absolute top-1 right-1 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold hover:bg-red-700 transition-colors duration-200 shadow-md" 
                                                                        onclick="markImageForDeletion({{ $product->id }}, {{ $image->id }})" title="Hapus gambar ini">
                                                                    ✕
                                                                </button>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <p class="text-xs text-black/60 mt-2">Gambar existing ditampilkan di atas. Tambahkan gambar baru melalui uploader. Maksimal 8 file.</p>
                                            </div>
                                            
                                            <div>
                                                <label for="category_id-{{ $product->id }}" class="block mb-2 text-sm font-semibold text-black">Kategori Produk</label>
                                                <select id="category_id-{{ $product->id }}" name="category_id" class="bg-white border border-black/30 text-black text-sm rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 block w-full p-3 transition-colors duration-200">
                                                    <option value="">Pilih kategori</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div>
                                                <label class="block mb-2 text-sm font-semibold text-black">Pilih Ukuran</label>
                                                @php
                                                    $selectedSizes = old('sizes', $product->sizes->pluck('id')->toArray());
                                                @endphp
                                                <div class="flex flex-wrap gap-3">
                                                    @foreach($sizes as $size)
                                                        <label class="inline-flex items-center cursor-pointer">
                                                            <input type="checkbox" name="sizes[]" value="{{ $size->id }}"
                                                                {{ in_array($size->id, $selectedSizes) ? 'checked' : '' }}
                                                                class="form-checkbox h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                                            <span class="ml-2 text-sm text-black hover:text-red-600 transition-colors duration-200">{{ $size->name }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <div class="sm:col-span-2">
                                                <label for="size_image-{{ $product->id }}" class="block mb-2 text-sm font-semibold text-black">Panduan Ukuran</label>
                                                <input 
                                                    class="filepond filepond-size-update-{{ $product->id }} @error('size_image') border-red-500 ring-2 ring-red-500 @enderror block w-full text-sm text-black border border-black/30 rounded-lg cursor-pointer bg-white/50 p-3 transition-colors duration-200" 
                                                    id="size_image-{{ $product->id }}" 
                                                    name="size_image" 
                                                    type="file" 
                                                    accept="image/png, image/jpg, image/jpeg, image/webp">
                                                @error('size_image')
                                                    <p class="text-red-600 text-sm mt-1 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                                {{-- Preload existing size_image --}}
                                                @if($product->size_image && file_exists(public_path('images/' . $product->size_image)))
                                                    <div class="existing-size-preview mt-3 flex items-center gap-3">
                                                        <img src="{{ asset('images/' . $product->size_image) }}" alt="Existing size guide" class="w-32 h-32 object-cover rounded-lg border border-black/20 shadow-sm">
                                                        <button type="button" onclick="markSizeImageForDeletion({{ $product->id }})" class="text-red-600 hover:text-red-800 font-semibold hover:bg-red-100 px-3 py-1 rounded-lg transition-colors duration-200">Hapus panduan ukuran</button>
                                                    </div>
                                                @endif
                                                <p class="text-xs text-black/60 mt-2">Unggah gambar panduan ukuran baru jika diperlukan (PNG, JPG, JPEG, WebP).</p>
                                            </div>
                                            
                                            <div class="sm:col-span-2">
                                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Deskripsi</label>
                                                <textarea id="description" name="description" rows="5" class="description hidden p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Write a description...">{{ old('description', $product->description) }}</textarea>
                                                <div id="editor-update-{{ $product->id }}" class="editor">{!! old('description', $product->description) !!}</div> {{-- Tambah ID unik --}}
                                                @error('description')
                                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @php
                                                $kelebihanArray = json_decode($product->kelebihan, true) ?? [];
                                                // Pastikan array bersih: filter empty strings
                                                $kelebihanArray = array_filter($kelebihanArray, function($item) {
                                                    return !empty(trim($item));
                                                });
                                                // Jika array kosong setelah filter, tambahkan satu item kosong untuk UX (minimal satu field)
                                                if (empty($kelebihanArray)) {
                                                    $kelebihanArray = [''];
                                                }
                                            @endphp

                                            <div 
                                                x-data='{
                                                    advantages: {!! json_encode($kelebihanArray) !!},
                                                    addAdvantage() { this.advantages.push(""); },
                                                    removeAdvantage(index) { 
                                                        if (this.advantages.length > 1) { 
                                                            this.advantages.splice(index, 1); 
                                                        } else { 
                                                            this.advantages[index] = ""; 
                                                        } 
                                                    }
                                                }' 
                                                class="sm:col-span-2 space-y-4"
                                            >
                                                <!-- Label: Desain lebih clean dengan warna hitam/putih -->
                                                <label class="block text-sm mt-15 font-medium text-black dark:text-white">Kelebihan Produk</label>
                                                
                                                <!-- Tombol Tambah: Warna hitam sebagai aksen utama, dengan ikon untuk UX lebih baik -->
                                                <button
                                                    type="button"
                                                    @click="addAdvantage()"
                                                    class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-black rounded-lg hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition-colors duration-200 shadow-sm"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                    </svg>
                                                    Tambah Kelebihan
                                                </button>

                                                <!-- Daftar Kelebihan: Render dinamis dengan transisi halus -->
                                                <template x-for="(advantage, index) in advantages" :key="index">
                                                    <div 
                                                        x-transition:enter="transition ease-out duration-200"
                                                        x-transition:enter-start="opacity-0 transform -translate-x-2 scale-95"
                                                        x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                                                        x-transition:leave="transition ease-in duration-150"
                                                        x-transition:leave-start="opacity-100 transform translate-x-0 scale-100"
                                                        x-transition:leave-end="opacity-0 transform -translate-x-2 scale-95"
                                                        class="flex items-center gap-3 p-3 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-150"
                                                    >
                                                        <!-- Input: Clean design, binding aman, warna putih/hitam -->
                                                        <input
                                                            type="text"
                                                            name="kelebihan[]"
                                                            x-model="advantages[index]"
                                                            placeholder="Masukkan kelebihan produk..."
                                                            class="flex-1 bg-transparent border-0 text-black text-sm rounded-md focus:ring-2 focus:ring-black focus:border-transparent px-3 py-2 outline-none dark:text-white dark:placeholder-gray-400 dark:focus:ring-gray-300 transition-colors duration-150"
                                                            maxlength="255"
                                                        >
                                                        
                                                        <!-- Tombol Hapus: Warna merah dominan, dengan ikon X untuk konsistensi -->
                                                        <button
                                                            type="button"
                                                            @click="removeAdvantage(index)"
                                                            :disabled="advantages.length === 1 && !advantages[index].trim()"
                                                            class="flex items-center justify-center w-8 h-8 text-red-600 hover:text-red-800 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 rounded-md transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed dark:hover:bg-red-900/20"
                                                            title="Hapus kelebihan ini"
                                                            aria-label="Hapus kelebihan"
                                                        >
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </template>

                                                <!-- Pesan Bantuan: Untuk guide UX, warna abu-abu netral -->
                                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 italic">
                                                    Tambahkan kelebihan produk untuk menarik perhatian pembeli. Anda bisa menambahkan atau menghapus sesuai kebutuhan.
                                                </p>
                                            </div>
                                            
                                        </div>

                                        <div class="flex items-center space-x-4">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Update product</button>
                                            <button type="button" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :border-red-500 :text-red-500 :hover:text-white :hover:bg-red-600 :focus:ring-red-900" onclick="confirmDelete({{ $product->id }})"> {{-- Tambah onclick untuk delete confirm --}}
                                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Read modal -->
                    @foreach ( $products as $product )
                        <div id="readProductModal-{{ $product->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                                        <div class="text-lg text-gray-900 md:text-xl :text-white">
                                            <h3 class="font-semibold text-2xl">{{ $product->name }}</h3>
                                            <p class="font-bold">{{ number_format($product->price, 0, ',', '.') }}</p>
                                        </div>
                                        <div>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex :hover:bg-gray-600 :hover:text-white" data-modal-toggle="readProductModal-{{ $product->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <img src="../images/{{ $product->image }}" alt="" class="w-full h-[512px]">
                                    </div>
                                    <dl>
                                        <dt class="my-2 font-semibold leading-none text-gray-900 :text-white">Details</dt>
                                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 :text-gray-400">{!! $product->description !!}</dd>
                                        <dt class="mb-2 font-semibold leading-none text-gray-900 :text-white">Category</dt>
                                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 :text-gray-400">{{ $product->category->name }}</dd>
                                        <dt class="mb-2 font-semibold leading-none text-gray-900 :text-white">Kelebihan</dt>
                                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 :text-gray-400">
                                            @php
                                                $kelebihanArray = json_decode($product->kelebihan, true) ?? [];
                                            @endphp

                                            <ul class="list-disc list-inside">
                                                @foreach ($kelebihanArray as $advantage)
                                                    <li>{{ $advantage }}</li>
                                                @endforeach
                                            </ul>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Delete modals (satu per produk untuk konfirmasi spesifik) -->
                    @foreach ($products as $product)
                        <div 
                            id="deleteModal-{{ $product->id }}" 
                            tabindex="-1" 
                            aria-hidden="true" 
                            role="dialog" 
                            aria-modal="true" 
                            aria-labelledby="deleteModalTitle-{{ $product->id }}"
                            class="hidden fixed inset-0 z-50 overflow-y-auto overflow-x-hidden w-full h-full p-4 md:p-6"
                        >
                            <!-- Backdrop: Semi-transparent overlay untuk fokus -->
                            <div class="fixed inset-0 duration-300"></div>
                            
                            <!-- Modal Container: Centered, responsive -->
                            <div class="relative flex min-h-full items-center justify-center p-4">
                                <div 
                                    id="deleteModalContent-{{ $product->id }}"
                                    class="relative w-full max-w-md max-h-full transform transition-all duration-300 scale-100 opacity-100"
                                    x-data="{ open: false }" 
                                    x-init="open = true"
                                    x-show="open"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform scale-100"
                                    x-transition:leave-end="opacity-0 transform scale-95"
                                >
                                    <!-- Modal Body: Card-like dengan tema putih/hitam -->
                                    <div class="relative bg-white rounded-xl shadow-2xl border border-gray-200 dark:bg-gray-800 dark:border-gray-700 p-6 text-center">
                                        <!-- Close Button: Hitam, hover merah untuk aksen -->
                                        <button 
                                            type="button" 
                                            class="absolute top-4 right-4 text-black hover:text-red-600 dark:text-white hover:dark:text-red-400 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 dark:focus:ring-gray-300 rounded-full p-2 hover:bg-gray-100 dark:hover:bg-gray-700"
                                            data-modal-toggle="deleteModal-{{ $product->id }}"
                                            aria-label="Tutup modal"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                        
                                        <!-- Warning Icon: Merah untuk emphasis, centered -->
                                        <div class="mx-auto flex items-center justify-center w-16 h-16 mb-4 bg-red-50 rounded-full dark:bg-red-900/20">
                                            <svg class="w-8 h-8 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                            </svg>
                                        </div>
                                        
                                        <!-- Title: Bold, hitam, dengan nama produk -->
                                        <h3 id="deleteModalTitle-{{ $product->id }}" class="text-lg font-bold text-black dark:text-white mb-2">
                                            Hapus Produk?
                                        </h3>
                                        
                                        <!-- Description: Deskriptif, gray untuk secondary text -->
                                        <p class="mb-6 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
                                            Apakah Anda yakin ingin menghapus <span class="font-semibold text-black dark:text-white">'{{ $product->name }}'</span>? 
                                            Tindakan ini tidak dapat dibatalkan dan akan menghapus data secara permanen.
                                        </p>
                                        
                                        <!-- Buttons: Flex, space even, tema putih/hitam/merah -->
                                        <div class="flex justify-center items-center gap-4">
                                            <!-- Cancel Button: Putih dengan border hitam, hover subtle -->
                                            <button 
                                                type="button" 
                                                data-modal-hide="deleteModal-{{ $product->id }}"
                                                class="px-6 py-2.5 text-sm font-medium text-black bg-white border-2 border-black rounded-lg hover:bg-gray-50 hover:border-gray-800 focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2 transition-all duration-200 shadow-sm dark:text-white dark:bg-gray-700 dark:border-gray-300 dark:hover:bg-gray-600 dark:focus:ring-gray-300"
                                                aria-label="Batal hapus"
                                            >
                                                Batal
                                            </button>
                                            
                                            <!-- Delete Button: Merah dominan, destructive action -->
                                            <form action="{{ route('products.destroy', $product->slug) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button 
                                                    type="submit" 
                                                    class="px-6 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 shadow-sm dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-400"
                                                    aria-label="Konfirmasi hapus {{ $product->name }}"
                                                >
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

        <script>
            // Register plugins
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                // Tambahkan plugin lain jika perlu (e.g., FilePondPluginImageTransform, FilePondPluginImageResize)
            );

            // Konfigurasi umum untuk semua FilePond instances
            const commonConfig = {
                storeAsFile: true,
                instantUpload: false,
                acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg', 'image/webp'],
                maxFileSize: '5MB',
                imagePreviewHeight: 200,
                allowReorder: true,
                // Label untuk user experience
                labelButtonAbortItemLoad: 'Abort',
                labelButtonRemoveItem: 'Remove',
                labelMaxFileSizeExceeded: 'File terlalu besar (max 5MB)',
                labelMaxFilesExceeded: 'Maksimal 8 file',
                labelFileWaitingForSize: 'Menunggu ukuran...',
                labelInvalidField: 'Field mengandung file tidak valid',
            };

            // Inisialisasi setelah DOM loaded
            document.addEventListener('DOMContentLoaded', function() {
                // 1. FilePond untuk CREATE modal: images[] (multiple)
                document.querySelectorAll('input.filepond-product').forEach((input) => {
                    FilePond.create(input, {
                        ...commonConfig,
                        allowMultiple: true,
                        maxFiles: 8,
                    });
                });

                // 2. FilePond untuk CREATE modal: size_image (single)
                document.querySelectorAll('input.filepond-size').forEach((input) => {
                    FilePond.create(input, {
                        ...commonConfig,
                        allowMultiple: false,
                        maxFiles: 1,
                    });
                });

                // 3. FilePond untuk UPDATE modals (loop per product)
                @foreach($products as $product)
                    // Images untuk update product ID {{ $product->id }}
                    const inputUpdateImages{{ $product->id }} = document.querySelector('.filepond-update-{{ $product->id }}');
                    if (inputUpdateImages{{ $product->id }}) {
                        const pondImages = FilePond.create(inputUpdateImages{{ $product->id }}, {
                            ...commonConfig,
                            allowMultiple: true,
                            maxFiles: 8,
                            // Disable server load untuk hindari fetch error
                            server: {
                                load: null,  // Tidak fetch untuk existing
                                process: null,  // Handle di form submit
                            },
                            // Tambah event untuk file baru saja (existing handle manual)
                        });

                        // Preload existing images
                        const preloadElsImages = document.querySelectorAll('.filepond-preload-{{ $product->id }}');
                        preloadElsImages.forEach(el => {
                            pondImages.addFile(el.dataset.file, {
                                type: 'local',
                                source: el.dataset.source,  // ID DB untuk delete (e.g., image ID)
                            });
                        });

                        // Handle delete existing image (hanya untuk file existing)
                        pondImages.on('removefile', (error, file) => {
                            if (error) {
                                console.error('Error removing file:', error);
                                return;
                            }
                            // Hanya trigger untuk existing files (source adalah integer ID DB, bukan FilePond ID)
                            if (file.origin === FilePond.FileOrigin.LOCAL && 
                                file.source && 
                                /^\d+$/.test(file.source.toString())  // Validasi: source harus angka (ID DB)
                            ) {
                                let deletedInput = document.createElement('input');
                                deletedInput.type = 'hidden';
                                deletedInput.name = 'delete_images[]';
                                deletedInput.value = file.source;
                                inputUpdateImages{{ $product->id }}.closest('form').appendChild(deletedInput);
                                console.log('Marked for deletion (images):', file.source);  // Debug: lihat di console
                            }
                            // File baru yang dihapus: FilePond otomatis handle, tidak perlu action tambahan
                        });
                    }

                    // Size image update (mirip, tanpa preload)
                    const inputUpdateSize{{ $product->id }} = document.querySelector('.filepond-size-update-{{ $product->id }}');
                    if (inputUpdateSize{{ $product->id }}) {
                        const pondSize = FilePond.create(inputUpdateSize{{ $product->id }}, {
                            ...commonConfig,
                            allowMultiple: false,
                            maxFiles: 1,
                            server: { load: null, process: null },
                        });
                        // No preload
                    }
                @endforeach
            });

            // Custom functions untuk delete manual (panggil dari onclick di Blade)
            function markImageForDeletion(productId, imageId) {
                // Tambah hidden input untuk delete
                let deletedInput = document.createElement('input');
                deletedInput.type = 'hidden';
                deletedInput.name = 'delete_images[]';
                deletedInput.value = imageId;
                document.querySelector(`#updateProductModal-${productId} form`).appendChild(deletedInput);

                // Hapus thumbnail dari DOM
                event.target.closest('.existing-image-item').remove();
                console.log('Marked image for deletion:', imageId);
            }

            function markSizeImageForDeletion(productId) {
                let deletedInput = document.createElement('input');
                deletedInput.type = 'hidden';
                deletedInput.name = 'delete_size_image';
                deletedInput.value = productId;  // Flag dengan product ID
                document.querySelector(`#updateProductModal-${productId} form`).appendChild(deletedInput);

                // Hapus preview
                document.querySelector(`#updateProductModal-${productId} .existing-size-preview`).remove();
                console.log('Marked size_image for deletion:', productId);
            }
        </script>

        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            document.querySelectorAll('.editor').forEach((el) => {
                const quill = new Quill(el, {
                    theme: 'snow',
                    placeholder: 'Tulis deskripsi produk di sini...',
                });

                const form = el.closest('form'); // ambil form terdekat
                const textarea = form.querySelector('.description'); // textarea di form ini aja

                form.addEventListener('submit', function() {
                    textarea.value = el.querySelector('.ql-editor').innerHTML;
                });

                // const postForm = document.querySelector('.post-form')
                // const postBody = document.querySelector('.description')
                // const quillEditor = document.querySelector('.editor')
                
                // postForm.addEventListener('submit', function(e) {
                //     e.preventDefault()
                    
                //     const content = quillEditor.children[0].innerHTML
                //     // console.log(content)

                //     postBody.value = content

                //     this.submit()
                // })
            });
        </script>
    @endpush
</x-app-layout>
