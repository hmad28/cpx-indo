<footer class="bg-gray-950 px-4 pb-6 pt-14 text-white lg:px-10">
    <div class="mx-auto max-w-7xl overflow-hidden rounded-[2rem] border border-white/10 bg-white/[0.03] p-6 shadow-2xl md:p-10">
        <div class="grid gap-10 lg:grid-cols-[1.25fr_0.75fr_0.75fr]">
            <div>
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX Official" class="h-14 w-14 rounded-2xl object-cover">
                    <div>
                        <p class="text-xl font-black uppercase tracking-[0.22em]">CPX</p>
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-white/45">Custom Performance Xperience</p>
                    </div>
                </div>
                <p class="mt-5 max-w-xl text-sm leading-7 text-white/62">
                    Studio jersey custom untuk tim, komunitas, dan brand yang butuh tampilan kuat, bahan nyaman, dan proses produksi yang jelas.
                </p>
                <p class="mt-4 text-sm text-white/55">Jl. Pahlawan No.25-27, Cileungsi, Kabupaten Bogor, Jawa Barat 16820</p>

                <div class="mt-6 flex flex-wrap gap-3">
                    @if(isset($whatsappNumbers) && $whatsappNumbers->isNotEmpty())
                        @foreach($whatsappNumbers as $wa)
                            <a href="{{ $wa->whatsapp_url }}" target="_blank" class="inline-flex items-center gap-2 rounded-full bg-green-600 px-5 py-3 text-sm font-black text-white transition hover:bg-green-700">
                                <i class="fa-brands fa-whatsapp"></i>
                                Hubungi {{ $wa->display_name }}
                            </a>
                        @endforeach
                    @else
                        <span class="inline-flex rounded-full border border-white/10 px-4 py-2 text-sm text-white/55">Nomor WhatsApp belum aktif</span>
                    @endif
                </div>
            </div>

            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.22em] text-white/45">Navigasi</h3>
                <ul class="mt-5 space-y-3 text-sm font-semibold text-white/70">
                    <li><a href="{{ route('about') }}" class="transition hover:text-red-400">About Us</a></li>
                    <li><a href="{{ route('custom') }}" class="transition hover:text-red-400">Custom Jersey</a></li>
                    <li><a href="{{ route('our-products') }}" class="transition hover:text-red-400">Products</a></li>
                    <li><a href="{{ route('testimonials') }}" class="transition hover:text-red-400">Testimonials</a></li>
                    <li><a href="{{ route('sizes') }}" class="transition hover:text-red-400">Size Guide</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-sm font-black uppercase tracking-[0.22em] text-white/45">Marketplace</h3>
                <div class="mt-5 grid gap-3">
                    <a href="#" class="rounded-2xl border border-white/10 bg-white/5 p-3 transition hover:bg-white/10">
                        <img src="{{ asset('images/shopee-seeklogo-1.png') }}" alt="Shopee" class="h-8 w-auto opacity-75 grayscale transition hover:opacity-100 hover:grayscale-0">
                    </a>
                    <a href="#" class="rounded-2xl border border-white/10 bg-white/5 p-3 transition hover:bg-white/10">
                        <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="h-8 w-auto opacity-75 grayscale transition hover:opacity-100 hover:grayscale-0">
                    </a>
                </div>
                <div class="mt-6 flex gap-3">
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-white/70 transition hover:border-red-500 hover:bg-red-600 hover:text-white" aria-label="Instagram">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://wa.me/6285172003667" target="_blank" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-white/70 transition hover:border-green-500 hover:bg-green-600 hover:text-white" aria-label="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="#" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-white/70 transition hover:border-red-500 hover:bg-red-600 hover:text-white" aria-label="Email">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="mt-10 flex flex-col gap-3 border-t border-white/10 pt-6 text-xs font-semibold text-white/45 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; 2026 CPX. All rights reserved.</p>
            <p>Designed for custom teams and local champions.</p>
        </div>
    </div>
</footer>