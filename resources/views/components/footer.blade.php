<footer class="relative bg-gray-950 text-white">
    {{-- Angular geometric top separator --}}
    <div class="absolute top-0 left-0 w-full overflow-hidden leading-none -translate-y-full">
        <svg class="relative block w-full h-12" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 60" preserveAspectRatio="none">
            <polygon fill="#030712" points="0,60 1200,60 1200,0 800,45 400,10 0,35"/>
        </svg>
    </div>

    <div class="mx-auto max-w-7xl px-4 pt-16 pb-8 lg:px-8">
        {{-- Large bold CPX branding --}}
        <div class="mb-12 border-b border-white/10 pb-10">
            <div class="flex flex-col gap-6 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <div class="flex items-center gap-4">
                        <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX Official" class="h-14 w-14 rounded-lg object-cover ring-2 ring-red-500/40">
                        <div>
                            <p class="text-4xl font-black uppercase tracking-wider text-white" style="font-family: 'Bebas Neue', sans-serif;">CPX</p>
                            <p class="text-xs font-bold uppercase tracking-[0.25em] text-red-500">Custom Performance Xperience</p>
                        </div>
                    </div>
                    <p class="mt-5 max-w-lg text-sm leading-7 text-white/60">
                        Studio jersey custom untuk tim, komunitas, dan brand yang butuh tampilan kuat, bahan nyaman, dan proses produksi yang jelas.
                    </p>
                    <p class="mt-3 text-sm text-white/40">Jl. Pahlawan No.25-27, Cileungsi, Kabupaten Bogor, Jawa Barat 16820</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    @if(isset($whatsappNumbers) && $whatsappNumbers->isNotEmpty())
                        @foreach($whatsappNumbers as $wa)
                            <a href="{{ $wa->whatsapp_url }}" target="_blank" class="inline-flex items-center gap-2 bg-green-600 px-5 py-3 text-sm font-black text-white transition hover:bg-green-700 skew-x-[-2deg]">
                                <span class="skew-x-[2deg] inline-flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp"></i>
                                    Hubungi {{ $wa->display_name }}
                                </span>
                            </a>
                        @endforeach
                    @else
                        <span class="inline-flex border border-white/10 px-4 py-2 text-sm text-white/55">Nomor WhatsApp belum aktif</span>
                    @endif
                </div>
            </div>
        </div>

        {{-- Grid layout for nav/marketplace/social --}}
        <div class="grid gap-10 lg:grid-cols-3">
            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.22em] text-red-500 border-l-2 border-red-500 pl-3">Navigasi</h3>
                <ul class="mt-5 space-y-3 text-sm font-semibold text-white/70">
                    <li><a href="{{ route('about') }}" class="transition hover:text-white hover:pl-1">About Us</a></li>
                    <li><a href="{{ route('custom') }}" class="transition hover:text-white hover:pl-1">Custom Jersey</a></li>
                    <li><a href="{{ route('our-products') }}" class="transition hover:text-white hover:pl-1">Products</a></li>
                    <li><a href="{{ route('testimonials') }}" class="transition hover:text-white hover:pl-1">Testimonials</a></li>
                    <li><a href="{{ route('sizes') }}" class="transition hover:text-white hover:pl-1">Size Guide</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.22em] text-red-500 border-l-2 border-red-500 pl-3">Marketplace</h3>
                <div class="mt-5 grid gap-3">
                    <a href="#" class="flex items-center gap-3 border border-white/10 bg-white/5 p-3 transition hover:bg-white/10 hover:border-red-500/30">
                        <img src="{{ asset('images/shopee-seeklogo-1.png') }}" alt="Shopee" class="h-8 w-auto opacity-75 grayscale transition hover:opacity-100 hover:grayscale-0">
                    </a>
                    <a href="#" class="flex items-center gap-3 border border-white/10 bg-white/5 p-3 transition hover:bg-white/10 hover:border-red-500/30">
                        <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="h-8 w-auto opacity-75 grayscale transition hover:opacity-100 hover:grayscale-0">
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.22em] text-red-500 border-l-2 border-red-500 pl-3">Social</h3>
                <div class="mt-5 flex gap-3">
                    <a href="#" class="inline-flex h-11 w-11 items-center justify-center border border-white/10 bg-white/5 text-white/70 transition hover:border-red-500 hover:bg-red-600 hover:text-white" aria-label="Instagram">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="https://wa.me/6285172003667" target="_blank" class="inline-flex h-11 w-11 items-center justify-center border border-white/10 bg-white/5 text-white/70 transition hover:border-green-500 hover:bg-green-600 hover:text-white" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </a>
                    <a href="#" class="inline-flex h-11 w-11 items-center justify-center border border-white/10 bg-white/5 text-white/70 transition hover:border-red-500 hover:bg-red-600 hover:text-white" aria-label="Email">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="mt-12 flex flex-col gap-3 border-t border-white/10 pt-6 text-xs font-semibold text-white/40 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; 2026 CPX. All rights reserved.</p>
            <p>Designed for custom teams and local champions.</p>
        </div>
    </div>
</footer>
