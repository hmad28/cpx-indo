<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full mb-6">
                        <h1 class="text-3xl font-bold mb-2">Selamat Datang di Dashboard Admin</h1>
                        <p class="text-gray-600">Kelola konten dan pengaturan situs web CPX dengan mudah melalui dashboard ini.</p>
                    </div>
                    <div class="w-full flex gap-2 md:flex-wrap md:gap-6 mb-8">
                        {{-- Card 1: Jumlah Produk --}}
                        <div class="flex-1 w-1/3 p-2 md:p-6 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl shadow-sm border border-blue-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center md:justify-between mb-2 md:mb-4">
                                <div class="flex flex-col md:flex-row justify-center text-center gap-3 md:gap-0 items-center">
                                    <div class="p-1 md:p-3 bg-blue-100 rounded-full md:mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-6 md:w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 6m0 0l-8-6m8 6V7m-4 4h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-4l-4 4z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-sm md:text-xl font-semibold text-gray-800">Jumlah Produk Saat Ini</h2>
                                </div>
                            </div>
                            
                            <div class="flex items-end justify-center">
                                <div class="text-center">
                                    <p class="text-xs md:text-sm text-gray-600 mb-1">Total Produk</p>
                                    <p class="text-xl md:text-3xl font-bold text-blue-700">{{ $productCount }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-2 pt-2 md:mt-4 md:pt-4 border-t border-blue-200">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                        Lihat detail →
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Card 2: Jumlah Kategori --}}
                        <div class="flex-1 w-1/3 p-2 md:p-6 bg-gradient-to-br from-green-50 to-green-100 rounded-xl shadow-sm border border-green-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center md:justify-between mb-2 md:mb-4">
                                <div class="flex flex-col md:flex-row justify-center text-center gap-3 md:gap-0 items-center">
                                    <div class="p-1 md:p-3 bg-green-100 rounded-full md:mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-6 md:w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-sm md:text-xl font-semibold text-gray-800">Jumlah Kategori Saat Ini</h2>
                                </div>
                            </div>
                            
                            <div class="flex items-end justify-center">
                                <div class="text-center">
                                    <p class="text-xs md:text-sm text-gray-600 mb-1">Total Kategori</p>
                                    <p class="text-xl md:text-3xl font-bold text-green-700">{{ $categoryCount }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-2 pt-2 md:mt-4 md:pt-4 border-t border-green-200">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <a href="{{ route('categories.index') }}" class="text-green-600 hover:text-green-800 font-medium transition-colors">
                                        Lihat detail →
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Card 3: Jumlah Testimonial --}}
                        <div class="flex-1 w-1/3 p-2 md:p-6 bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-xl shadow-sm border border-yellow-100 transform transition-all duration-300 hover:scale-[1.02] hover:shadow-md">
                            <div class="flex items-center md:justify-between mb-2 md:mb-4">
                                <div class="flex flex-col md:flex-row justify-center text-center gap-3 md:gap-0 items-center">
                                    <div class="p-1 md:p-3 bg-yellow-100 rounded-full md:mr-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-6 md:w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <h2 class="text-sm md:text-xl font-semibold text-gray-800">Jumlah Testimoni Saat Ini</h2>
                                </div>
                            </div>
                            
                            <div class="flex items-end justify-center">
                                <div class="text-center">
                                    <p class="text-xs md:text-sm text-gray-600 mb-1">Total Testimoni</p>
                                    <p class="text-xl md:text-3xl font-bold text-yellow-700">{{ $testimonialCount }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-2 pt-2 md:mt-4 border-t border-yellow-200">
                                <div class="flex justify-between text-xs text-gray-500">
                                    <a href="{{ route('testimonials.index') }}" class="text-yellow-600 hover:text-yellow-800 font-medium transition-colors">
                                        Lihat detail →
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 border rounded mb-4">
                        <h2 class="text-2xl mb-1">Best Seller</h2>
                        <p class="mb-2">Tambahkan produk ke daftar Best Seller. Produk yang ditandai sebagai Best Seller akan tampil di bagian khusus agar lebih menonjol dan mudah dilihat pelanggan.</p>
                        <div class="mt-3 md:space-y-3">
                            <a href="{{ route('best-seller.index') }}" 
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Kelola Best Seller
                            </a>
                        </div>
                    </div>
                    
                    <div class="p-6 border rounded mb-4">
                        <h2 class="text-2xl mb-1">FAQ</h2>
                        <p class="mb-2">Tambahkan pertanyaan-pertanyaan yang sering di tanyakan ke daftar FAQ. Pertanyaan-pertanyaan pada daftar FAQ akan tampil di bagian about.</p>
                        <div class="mt-3 md:space-y-3">
                            <a href="{{ route('faq.index') }}" 
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Kelola FAQ
                            </a>
                        </div>
                    </div>

                    <div class="p-6 border rounded mb-4">
                        <h2 class="text-2xl mb-1">Diskon Produk</h2>
                        <p class="mb-2">Tambahkan diskon pada produk-produk spesial.</p>
                        <div class="mt-3 md:space-y-3">
                            <a href="/diskons" 
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Kelola Diskon Produk
                            </a>
                        </div>
                    </div>

                    <div class="p-6 border rounded">
                        <h2 class="text-2xl mb-1">Nomor WA Admin</h2>
                        <p class="mb-2">Tambahkan nomor WA admin.</p>
                        <div class="mt-3 md:space-y-3">
                            <a href="{{ route('admin.whatsapp-numbers.index') }}" 
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                Kelola Nomor WA Admin
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
