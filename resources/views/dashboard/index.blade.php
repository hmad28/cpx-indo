<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-medium uppercase tracking-widest text-red-500">CPX Admin</p>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>{{ \Illuminate\Support\Carbon::now()->isoFormat('dddd, D MMMM Y') }}</span>
            </div>
        </div>
    </x-slot>

    <div class="py-8 sm:py-10">
        <div class="max-w-7xl 2xl:max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Hero / Welcome banner --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-zinc-900 via-zinc-900 to-red-900 p-6 sm:p-10 text-white shadow-xl">
                <div class="absolute -top-20 -right-20 h-72 w-72 rounded-full bg-red-500/20 blur-3xl"></div>
                <div class="absolute -bottom-24 -left-10 h-72 w-72 rounded-full bg-red-700/20 blur-3xl"></div>
                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="max-w-2xl">
                        <p class="inline-flex items-center gap-2 rounded-full bg-white/10 px-3 py-1 text-xs font-medium uppercase tracking-widest backdrop-blur">
                            <span class="h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                            Live Overview
                        </p>
                        <h1 class="mt-4 text-3xl sm:text-4xl font-bold leading-tight">
                            Halo, <span class="italic">{{ Auth::user()->name }}</span>
                            <span class="text-red-400">👋</span>
                        </h1>
                        <p class="mt-3 text-sm sm:text-base text-zinc-300">
                            Selamat datang kembali di pusat kendali <span class="font-semibold text-white">CP<span class="text-red-400">X</span> Indonesia</span>.
                            Pantau performa toko, kelola produk, dan promosi tim olahraga kamu dari satu tempat.
                        </p>
                        <div class="mt-6 flex flex-wrap items-center gap-3">
                            <a href="{{ route('home') }}" target="_blank"
                               class="inline-flex items-center gap-2 rounded-full bg-white text-zinc-900 px-5 py-2.5 text-sm font-semibold hover:bg-red-500 hover:text-white transition">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7m0-7L10 14m-4 7H5a2 2 0 01-2-2v-1"/></svg>
                                Lihat Landing Page
                            </a>
                            <a href="{{ route('products.create') }}"
                               class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/10 px-5 py-2.5 text-sm font-semibold text-white hover:bg-white/20 transition backdrop-blur">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                                Tambah Produk Baru
                            </a>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-3 sm:gap-4 lg:max-w-md w-full">
                        <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-4 text-center">
                            <p class="text-2xl sm:text-3xl font-bold">{{ $productCount }}</p>
                            <p class="mt-1 text-[11px] uppercase tracking-wider text-zinc-300">Produk</p>
                        </div>
                        <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-4 text-center">
                            <p class="text-2xl sm:text-3xl font-bold">{{ $activeDiscountCount }}</p>
                            <p class="mt-1 text-[11px] uppercase tracking-wider text-zinc-300">Diskon Aktif</p>
                        </div>
                        <div class="rounded-2xl bg-white/5 backdrop-blur border border-white/10 p-4 text-center">
                            <p class="text-2xl sm:text-3xl font-bold">{{ $bestSellerCount }}</p>
                            <p class="mt-1 text-[11px] uppercase tracking-wider text-zinc-300">Best Seller</p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Stat cards --}}
            <section>
                <div class="flex items-end justify-between mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900">Ringkasan Toko</h2>
                        <p class="text-xs sm:text-sm text-gray-500">Statistik utama yang perlu kamu pantau setiap hari.</p>
                    </div>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @php
                        $stats = [
                            [
                                'label' => 'Total Produk', 'value' => $productCount,
                                'sub' => '+'.$newProductsThisMonth.' bulan ini',
                                'href' => route('products.index'),
                                'color' => 'from-blue-500 to-blue-600',
                                'bg' => 'bg-blue-50', 'fg' => 'text-blue-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 6m0 0l-8-6m8 6V7m-4 4h.01"/>',
                            ],
                            [
                                'label' => 'Total Kategori', 'value' => $categoryCount,
                                'sub' => 'kategori jersey aktif',
                                'href' => route('categories.index'),
                                'color' => 'from-emerald-500 to-emerald-600',
                                'bg' => 'bg-emerald-50', 'fg' => 'text-emerald-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>',
                            ],
                            [
                                'label' => 'Best Seller', 'value' => $bestSellerCount,
                                'sub' => 'produk paling laris',
                                'href' => route('best-seller.index'),
                                'color' => 'from-amber-500 to-orange-500',
                                'bg' => 'bg-amber-50', 'fg' => 'text-amber-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.539 1.118L12 16.347a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.196-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118L2.488 9.501c-.783-.57-.38-1.81.588-1.81h4.915a1 1 0 00.95-.69l1.518-4.674z"/>',
                            ],
                            [
                                'label' => 'Diskon Aktif', 'value' => $activeDiscountCount,
                                'sub' => 'sedang berjalan',
                                'href' => route('diskons.index'),
                                'color' => 'from-rose-500 to-red-600',
                                'bg' => 'bg-rose-50', 'fg' => 'text-rose-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/>',
                            ],
                            [
                                'label' => 'Testimoni', 'value' => $testimonialCount,
                                'sub' => '+'.$newTestimonialsThisMonth.' bulan ini',
                                'href' => route('testimonials.index'),
                                'color' => 'from-purple-500 to-fuchsia-600',
                                'bg' => 'bg-purple-50', 'fg' => 'text-purple-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
                            ],
                            [
                                'label' => 'FAQ', 'value' => $faqCount,
                                'sub' => 'tampil di halaman About',
                                'href' => route('faq.index'),
                                'color' => 'from-cyan-500 to-sky-600',
                                'bg' => 'bg-cyan-50', 'fg' => 'text-cyan-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093M12 17h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            ],
                            [
                                'label' => 'Nomor WA', 'value' => $whatsappCount,
                                'sub' => 'kontak aktif',
                                'href' => route('admin.whatsapp-numbers.index'),
                                'color' => 'from-green-500 to-emerald-600',
                                'bg' => 'bg-green-50', 'fg' => 'text-green-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
                            ],
                            [
                                'label' => 'Harga Rata-rata', 'value' => 'Rp '.number_format($avgPrice, 0, ',', '.'),
                                'sub' => 'rata-rata harga produk',
                                'href' => route('products.index'),
                                'color' => 'from-indigo-500 to-violet-600',
                                'bg' => 'bg-indigo-50', 'fg' => 'text-indigo-600',
                                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                                'small' => true,
                            ],
                        ];
                    @endphp

                    @foreach ($stats as $s)
                        <a href="{{ $s['href'] }}"
                           class="group relative overflow-hidden rounded-2xl bg-white p-5 shadow-sm border border-gray-100 hover:shadow-lg hover:-translate-y-0.5 transition-all">
                            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-gradient-to-br {{ $s['color'] }} opacity-10 group-hover:opacity-20 transition"></div>
                            <div class="relative flex items-start justify-between">
                                <div>
                                    <p class="text-xs sm:text-sm font-medium text-gray-500">{{ $s['label'] }}</p>
                                    <p class="mt-2 {{ ($s['small'] ?? false) ? 'text-xl sm:text-2xl' : 'text-2xl sm:text-3xl' }} font-bold text-gray-900">{{ $s['value'] }}</p>
                                    <p class="mt-1 text-[11px] sm:text-xs text-gray-500">{{ $s['sub'] }}</p>
                                </div>
                                <div class="rounded-xl {{ $s['bg'] }} p-2.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $s['fg'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        {!! $s['icon'] !!}
                                    </svg>
                                </div>
                            </div>
                            <div class="relative mt-4 inline-flex items-center text-xs font-medium text-gray-500 group-hover:text-gray-900 transition">
                                Kelola
                                <svg class="ml-1 h-3 w-3 transition group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Recent products + Latest testimonials --}}
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Recent products --}}
                <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900">Produk Terbaru</h3>
                            <p class="text-xs text-gray-500">5 produk terakhir yang ditambahkan</p>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-xs sm:text-sm font-medium text-red-600 hover:text-red-700 inline-flex items-center gap-1">
                            Lihat semua
                            <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse ($recentProducts as $p)
                            <div class="flex items-center gap-4 px-5 py-4 hover:bg-gray-50 transition">
                                <div class="h-12 w-12 sm:h-14 sm:w-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 ring-1 ring-gray-200">
                                    @if($p->image)
                                        <img src="{{ asset('images/'.$p->image) }}" alt="{{ $p->name }}" class="h-full w-full object-cover" onerror="this.onerror=null;this.src='{{ asset('images/insertpichere.jpg') }}'">
                                    @else
                                        <div class="h-full w-full flex items-center justify-center text-gray-300">
                                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4-4 4 4 4-4 4 4M4 8h16M4 4h16v16H4V4z"/></svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $p->name }}</p>
                                        @if($p->is_best_seller)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 text-amber-700 text-[10px] px-2 py-0.5 font-medium">
                                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.367 2.446a1 1 0 00-.363 1.118l1.286 3.957c.299.921-.755 1.688-1.539 1.118L10 15.347l-3.367 2.446c-.784.57-1.838-.197-1.539-1.118l1.286-3.957a1 1 0 00-.363-1.118L2.65 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                                                Best
                                            </span>
                                        @endif
                                    </div>
                                    <p class="mt-0.5 text-xs text-gray-500">{{ $p->category->name ?? 'Tanpa kategori' }} · {{ $p->created_at?->diffForHumans() }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">Rp {{ number_format($p->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('products.edit', $p) }}" class="mt-1 inline-flex items-center gap-1 text-[11px] font-medium text-red-600 hover:text-red-700">
                                        Edit
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="px-5 py-10 text-center text-sm text-gray-500">
                                Belum ada produk. <a href="{{ route('products.create') }}" class="text-red-600 font-medium hover:underline">Tambah produk pertama</a>.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Latest testimonials --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900">Testimoni Terbaru</h3>
                            <p class="text-xs text-gray-500">Suara dari pelanggan kamu</p>
                        </div>
                        <a href="{{ route('testimonials.index') }}" class="text-xs sm:text-sm font-medium text-red-600 hover:text-red-700">Kelola</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse ($latestTestimonials as $t)
                            <div class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-red-500 to-zinc-900 flex items-center justify-center text-white text-sm font-bold">
                                        {{ \Illuminate\Support\Str::of($t->name)->substr(0,1)->upper() }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-sm font-semibold text-gray-900 truncate">{{ $t->name }}</p>
                                        <p class="text-[11px] text-gray-500 truncate">{{ $t->position }}</p>
                                    </div>
                                </div>
                                <p class="mt-2 text-xs sm:text-sm text-gray-600 line-clamp-3">"{{ $t->message }}"</p>
                            </div>
                        @empty
                            <div class="px-5 py-10 text-center text-sm text-gray-500">
                                Belum ada testimoni.
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- Active discounts + Products by category --}}
            <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                {{-- Active discounts table --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5a1.99 1.99 0 011.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.99 1.99 0 013 12V7a4 4 0 014-4z"/></svg>
                                Diskon Aktif
                            </h3>
                            <p class="text-xs text-gray-500">Promosi yang sedang berjalan saat ini</p>
                        </div>
                        <a href="{{ route('diskons.index') }}" class="text-xs sm:text-sm font-medium text-red-600 hover:text-red-700">Kelola</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 text-[11px] uppercase tracking-wider text-gray-500">
                                <tr>
                                    <th class="px-5 py-3 text-left font-medium">Produk</th>
                                    <th class="px-5 py-3 text-left font-medium">Diskon</th>
                                    <th class="px-5 py-3 text-left font-medium">Berakhir</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($activeDiscounts->take(6) as $d)
                                    @php
                                        $endDate = \Illuminate\Support\Carbon::parse($d->end_date);
                                        $daysLeft = max(0, (int) now()->startOfDay()->diffInDays($endDate, false));
                                    @endphp
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-5 py-3">
                                            <p class="font-medium text-gray-900 truncate max-w-[10rem] sm:max-w-xs">{{ $d->product->name ?? '—' }}</p>
                                            @if($d->product)
                                                <p class="text-[11px] text-gray-500">Rp {{ number_format($d->product->price, 0, ',', '.') }}</p>
                                            @endif
                                        </td>
                                        <td class="px-5 py-3">
                                            <span class="inline-flex items-center gap-1 rounded-full bg-rose-100 text-rose-700 text-xs px-2.5 py-1 font-semibold">
                                                {{ rtrim(rtrim(number_format($d->discount_percentage, 2, '.', ''), '0'), '.') }}% OFF
                                            </span>
                                        </td>
                                        <td class="px-5 py-3 text-xs text-gray-600">
                                            {{ $endDate->isoFormat('D MMM') }}
                                            <span class="ml-1 text-[10px] {{ $daysLeft <= 3 ? 'text-rose-600 font-semibold' : 'text-gray-400' }}">
                                                ({{ $daysLeft }} hari lagi)
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="px-5 py-10 text-center text-sm text-gray-500">Belum ada diskon aktif. <a href="{{ route('diskons.index') }}" class="text-red-600 font-medium hover:underline">Buat diskon</a>.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Products by category --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                Distribusi Kategori
                            </h3>
                            <p class="text-xs text-gray-500">Jumlah produk per kategori</p>
                        </div>
                        <a href="{{ route('categories.index') }}" class="text-xs sm:text-sm font-medium text-red-600 hover:text-red-700">Kelola</a>
                    </div>
                    <div class="px-5 py-5 space-y-4">
                        @forelse ($productsByCategory as $cat)
                            @php
                                $pct = $maxCategoryCount > 0 ? round(($cat->products_count / $maxCategoryCount) * 100) : 0;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between text-xs sm:text-sm mb-1.5">
                                    <span class="font-medium text-gray-700 truncate">{{ $cat->name }}</span>
                                    <span class="text-gray-500 font-semibold">{{ $cat->products_count }}</span>
                                </div>
                                <div class="h-2 w-full rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-full rounded-full bg-gradient-to-r from-red-500 to-zinc-900 transition-all duration-700"
                                         style="width: {{ max(4, $pct) }}%"></div>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center text-sm text-gray-500">Belum ada kategori.</div>
                        @endforelse
                    </div>
                </div>
            </section>

            {{-- Quick actions grid --}}
            <section>
                <div class="flex items-end justify-between mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-bold text-gray-900">Aksi Cepat</h2>
                        <p class="text-xs sm:text-sm text-gray-500">Pintasan ke modul-modul yang sering digunakan.</p>
                    </div>
                </div>
                @php
                    $quick = [
                        ['label' => 'Tambah Produk', 'desc' => 'Upload jersey baru', 'href' => route('products.create'), 'color' => 'bg-blue-500'],
                        ['label' => 'Kelola Best Seller', 'desc' => 'Pilih produk unggulan', 'href' => route('best-seller.index'), 'color' => 'bg-amber-500'],
                        ['label' => 'Buat Diskon', 'desc' => 'Promosi terbatas', 'href' => route('diskons.index'), 'color' => 'bg-rose-500'],
                        ['label' => 'Tambah Kategori', 'desc' => 'Atur klasifikasi', 'href' => route('categories.index'), 'color' => 'bg-emerald-500'],
                        ['label' => 'Kelola Testimoni', 'desc' => 'Suara pelanggan', 'href' => route('testimonials.index'), 'color' => 'bg-purple-500'],
                        ['label' => 'Kelola FAQ', 'desc' => 'Pertanyaan umum', 'href' => route('faq.index'), 'color' => 'bg-cyan-500'],
                        ['label' => 'Nomor WA Admin', 'desc' => 'Kontak penjualan', 'href' => route('admin.whatsapp-numbers.index'), 'color' => 'bg-green-500'],
                        ['label' => 'Profil Akun', 'desc' => 'Pengaturan akun', 'href' => route('profile.edit'), 'color' => 'bg-indigo-500'],
                    ];
                @endphp
                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-4">
                    @foreach ($quick as $q)
                        <a href="{{ $q['href'] }}"
                           class="group flex items-center gap-3 rounded-2xl bg-white p-4 shadow-sm border border-gray-100 hover:shadow-md hover:border-gray-200 transition">
                            <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $q['color'] }} text-white shadow-sm group-hover:scale-105 transition">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </span>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $q['label'] }}</p>
                                <p class="text-[11px] text-gray-500 truncate">{{ $q['desc'] }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            {{-- Latest FAQ preview --}}
            @if($latestFaqs->count())
                <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-gray-900 flex items-center gap-2">
                                <svg class="h-5 w-5 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093M12 17h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Pertanyaan yang Sering Diajukan
                            </h3>
                            <p class="text-xs text-gray-500">Pratinjau FAQ terbaru di halaman About</p>
                        </div>
                        <a href="{{ route('faq.index') }}" class="text-xs sm:text-sm font-medium text-red-600 hover:text-red-700">Kelola</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @foreach ($latestFaqs as $faq)
                            <details class="group px-5 py-4">
                                <summary class="flex cursor-pointer items-center justify-between list-none">
                                    <p class="text-sm font-medium text-gray-900 pr-4">{{ $faq->question }}</p>
                                    <svg class="h-4 w-4 text-gray-400 transition group-open:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                                </summary>
                                <p class="mt-2 text-sm text-gray-600">{{ $faq->answer }}</p>
                            </details>
                        @endforeach
                    </div>
                </section>
            @endif

        </div>
    </div>
</x-app-layout>
