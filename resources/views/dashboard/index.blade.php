<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.35em] text-red-600">CPX Command Center</p>
                <h2 class="text-2xl font-bold text-gray-950">Dashboard Admin</h2>
            </div>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-800 transition hover:border-red-500 hover:text-red-600">
                Lihat Website
            </a>
        </div>
    </x-slot>

    @php
        $statCards = [
            ['label' => 'Produk', 'value' => $productCount, 'caption' => 'Item katalog aktif', 'route' => route('products.index'), 'accent' => 'from-red-600 to-orange-500'],
            ['label' => 'Kategori', 'value' => $categoryCount, 'caption' => 'Segmentasi katalog', 'route' => route('categories.index'), 'accent' => 'from-gray-900 to-gray-700'],
            ['label' => 'Best Seller', 'value' => $bestSellerCount, 'caption' => 'Produk unggulan', 'route' => route('best-seller.index'), 'accent' => 'from-amber-500 to-yellow-400'],
            ['label' => 'Diskon Aktif', 'value' => $activeDiscountCount, 'caption' => 'Promo sedang berjalan', 'route' => route('diskons.index'), 'accent' => 'from-emerald-600 to-teal-500'],
            ['label' => 'Testimoni', 'value' => $testimonialCount, 'caption' => 'Bukti sosial', 'route' => route('testimonials.index'), 'accent' => 'from-blue-600 to-sky-500'],
            ['label' => 'Nomor WA', 'value' => $activeWhatsappCount, 'caption' => 'Kontak aktif', 'route' => route('admin.whatsapp-numbers.index'), 'accent' => 'from-lime-600 to-green-500'],
        ];

        $quickActions = [
            ['title' => 'Kelola Produk', 'description' => 'Tambah katalog, foto, ukuran, dan deskripsi produk.', 'route' => route('products.index'), 'button' => 'Buka Produk'],
            ['title' => 'Atur Best Seller', 'description' => 'Pilih produk yang perlu tampil paling menonjol.', 'route' => route('best-seller.index'), 'button' => 'Pilih Produk'],
            ['title' => 'Jalankan Diskon', 'description' => 'Buat promo dengan periode dan persentase yang jelas.', 'route' => route('diskons.index'), 'button' => 'Kelola Diskon'],
            ['title' => 'Update FAQ', 'description' => 'Jawab pertanyaan umum pelanggan dari halaman About.', 'route' => route('faq.index'), 'button' => 'Kelola FAQ'],
            ['title' => 'Nomor WhatsApp', 'description' => 'Pastikan CTA chat mengarah ke admin yang tepat.', 'route' => route('admin.whatsapp-numbers.index'), 'button' => 'Atur Nomor'],
            ['title' => 'Testimoni', 'description' => 'Kurasi ulasan pelanggan agar landing page lebih meyakinkan.', 'route' => route('testimonials.index'), 'button' => 'Buka Testimoni'],
        ];

        $healthChecks = [
            ['label' => 'Produk sudah tersedia', 'done' => $productCount > 0],
            ['label' => 'Kategori sudah dibuat', 'done' => $categoryCount > 0],
            ['label' => 'Best seller sudah dipilih', 'done' => $bestSellerCount > 0],
            ['label' => 'Nomor WhatsApp aktif', 'done' => $activeWhatsappCount > 0],
            ['label' => 'FAQ pelanggan terisi', 'done' => $faqCount > 0],
        ];
        $completedChecks = collect($healthChecks)->where('done', true)->count();
        $healthScore = count($healthChecks) > 0 ? round(($completedChecks / count($healthChecks)) * 100) : 0;
    @endphp

    <div class="bg-gray-100 py-8 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">
            <section class="overflow-hidden rounded-[2rem] bg-gray-950 text-white shadow-xl">
                <div class="grid gap-8 p-6 sm:p-8 lg:grid-cols-[1.4fr_0.8fr] lg:p-10">
                    <div class="space-y-6">
                        <div class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.25em] text-red-100">
                            Ringkasan {{ now()->format('d M Y') }}
                        </div>
                        <div>
                            <h1 class="max-w-3xl text-3xl font-black tracking-tight sm:text-5xl">
                                Selamat datang, {{ Auth::user()->name }}.
                            </h1>
                            <p class="mt-4 max-w-2xl text-sm leading-6 text-gray-300 sm:text-base">
                                Pantau kesehatan katalog, promo, konten, dan jalur WhatsApp dari satu tempat agar operasional CPX lebih cepat.
                            </p>
                        </div>
                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-full bg-red-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-red-700">
                                Kelola Produk
                            </a>
                            <a href="{{ route('diskons.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 px-5 py-3 text-sm font-bold text-white transition hover:bg-white hover:text-gray-950">
                                Cek Promo Aktif
                            </a>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-white/10 bg-white/10 p-5 backdrop-blur">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-300">Skor kelengkapan</p>
                                <p class="text-4xl font-black">{{ $healthScore }}%</p>
                            </div>
                            <div class="rounded-full bg-white px-4 py-2 text-sm font-bold text-gray-950">
                                {{ $completedChecks }}/{{ count($healthChecks) }} siap
                            </div>
                        </div>
                        <div class="mt-5 h-3 overflow-hidden rounded-full bg-white/10">
                            <div class="h-full rounded-full bg-red-500" style="width: {{ $healthScore }}%"></div>
                        </div>
                        <div class="mt-5 space-y-3">
                            @foreach ($healthChecks as $check)
                                <div class="flex items-center justify-between rounded-2xl bg-white/10 px-4 py-3 text-sm">
                                    <span>{{ $check['label'] }}</span>
                                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $check['done'] ? 'bg-green-400 text-green-950' : 'bg-white/10 text-gray-200' }}">
                                        {{ $check['done'] ? 'Siap' : 'Perlu dicek' }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                @foreach ($statCards as $card)
                    <a href="{{ $card['route'] }}" class="group overflow-hidden rounded-3xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <p class="text-sm font-semibold text-gray-500">{{ $card['label'] }}</p>
                                <p class="mt-2 text-4xl font-black text-gray-950">{{ $card['value'] }}</p>
                                <p class="mt-1 text-sm text-gray-500">{{ $card['caption'] }}</p>
                            </div>
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br {{ $card['accent'] }} shadow-lg"></div>
                        </div>
                        <div class="mt-5 flex items-center text-sm font-bold text-red-600">
                            Lihat detail
                            <span class="ml-2 transition group-hover:translate-x-1">-&gt;</span>
                        </div>
                    </a>
                @endforeach
            </section>

            <section class="grid gap-8 xl:grid-cols-[1.15fr_0.85fr]">
                <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.25em] text-red-600">Katalog</p>
                            <h3 class="text-2xl font-black text-gray-950">Produk terbaru</h3>
                        </div>
                        <a href="{{ route('products.index') }}" class="text-sm font-bold text-red-600 hover:text-red-700">Kelola semua</a>
                    </div>

                    <div class="mt-6 space-y-4">
                        @forelse ($latestProducts as $product)
                            <div class="flex items-center gap-4 rounded-2xl border border-gray-100 p-3 transition hover:border-red-200 hover:bg-red-50/40">
                                @if ($product->image)
                                    <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}" class="h-16 w-16 rounded-2xl object-cover">
                                @else
                                    <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-lg font-black text-gray-500">
                                        {{ strtoupper(substr($product->name, 0, 1)) }}
                                    </div>
                                @endif
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-bold text-gray-950">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Tanpa kategori' }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-gray-950">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="text-xs text-gray-500">{{ $product->created_at?->format('d M Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="rounded-2xl border border-dashed border-gray-300 p-8 text-center">
                                <p class="text-lg font-bold text-gray-950">Belum ada produk</p>
                                <p class="mt-1 text-sm text-gray-500">Tambahkan produk pertama agar katalog mulai tampil.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-red-600">Kategori</p>
                                <h3 class="text-2xl font-black text-gray-950">Distribusi produk</h3>
                            </div>
                            <a href="{{ route('categories.index') }}" class="text-sm font-bold text-red-600 hover:text-red-700">Atur</a>
                        </div>

                        <div class="mt-6 space-y-4">
                            @forelse ($topCategories as $category)
                                @php
                                    $categoryPercent = $productCount > 0 ? round(($category->products_count / $productCount) * 100) : 0;
                                @endphp
                                <div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-bold text-gray-800">{{ $category->name }}</span>
                                        <span class="text-gray-500">{{ $category->products_count }} produk</span>
                                    </div>
                                    <div class="mt-2 h-2 overflow-hidden rounded-full bg-gray-100">
                                        <div class="h-full rounded-full bg-gray-950" style="width: {{ $categoryPercent }}%"></div>
                                    </div>
                                </div>
                            @empty
                                <p class="rounded-2xl border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                                    Belum ada kategori untuk ditampilkan.
                                </p>
                            @endforelse
                        </div>
                    </div>

                    <div class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-[0.25em] text-red-600">Promo</p>
                                <h3 class="text-2xl font-black text-gray-950">Diskon berjalan</h3>
                            </div>
                            <a href="{{ route('diskons.index') }}" class="text-sm font-bold text-red-600 hover:text-red-700">Atur</a>
                        </div>

                        <div class="mt-6 space-y-3">
                            @forelse ($discountsEndingSoon as $discount)
                                <div class="rounded-2xl bg-gray-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="font-bold text-gray-950">{{ $discount->product->name ?? 'Produk tidak ditemukan' }}</p>
                                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-black text-red-700">
                                            {{ rtrim(rtrim(number_format($discount->discount_percentage, 2), '0'), '.') }}%
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">
                                        Berakhir {{ \Illuminate\Support\Carbon::parse($discount->end_date)->format('d M Y') }}
                                    </p>
                                </div>
                            @empty
                                <p class="rounded-2xl border border-dashed border-gray-300 p-6 text-center text-sm text-gray-500">
                                    Belum ada diskon aktif yang berjalan.
                                </p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-red-600">Aksi Cepat</p>
                        <h3 class="text-2xl font-black text-gray-950">Fitur dashboard</h3>
                    </div>
                    <p class="max-w-2xl text-sm text-gray-500">Pintasan operasional untuk mempercepat update katalog, promo, konten, dan kanal penjualan.</p>
                </div>

                <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($quickActions as $action)
                        <a href="{{ $action['route'] }}" class="group rounded-3xl border border-gray-200 p-5 transition hover:border-red-300 hover:bg-red-50/50">
                            <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gray-950 text-sm font-black text-white">
                                {{ $loop->iteration }}
                            </div>
                            <h4 class="mt-4 text-lg font-black text-gray-950">{{ $action['title'] }}</h4>
                            <p class="mt-2 text-sm leading-6 text-gray-500">{{ $action['description'] }}</p>
                            <div class="mt-4 text-sm font-bold text-red-600">
                                {{ $action['button'] }} <span class="inline-block transition group-hover:translate-x-1">-&gt;</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
