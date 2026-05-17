<header x-data="{ openMenu: false }" class="fixed left-0 top-0 z-50 w-full px-3 pt-3">
    <div class="mx-auto max-w-7xl rounded-full border border-white/15 bg-gray-950/88 px-4 py-3 text-white shadow-2xl shadow-black/20 backdrop-blur-xl lg:px-5">
        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX Official" class="h-10 w-10 rounded-full object-cover ring-2 ring-white/10">
                <div class="leading-none">
                    <p class="text-sm font-black uppercase tracking-[0.22em]">CPX</p>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-white/50">Official Wear</p>
                </div>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('about') }}" class="rounded-full px-4 py-2 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white">About</a>
                <a href="{{ route('custom') }}" class="rounded-full px-4 py-2 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white">Custom</a>
                <a href="{{ route('our-products') }}" class="rounded-full px-4 py-2 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white">Products</a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = ! open" class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white">
                        Kategori
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition @click.outside="open = false" class="absolute left-0 mt-3 w-56 rounded-2xl border border-white/10 bg-gray-950 p-2 shadow-2xl">
                        @foreach ($categories as $category)
                            <a href="{{ route('products.byCategory', ['category' => $category->slug]) }}" class="block rounded-xl px-4 py-2.5 text-sm font-semibold text-white/70 transition hover:bg-white/10 hover:text-white">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('testimonials') }}" class="rounded-full px-4 py-2 text-sm font-bold text-white/70 transition hover:bg-white/10 hover:text-white">Testimonials</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('cart.index') }}" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white transition hover:bg-white hover:text-gray-950" aria-label="Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <div class="relative hidden sm:block" x-data="{ open: false }">
                    <button @click="open = ! open" class="inline-flex items-center gap-2 rounded-full bg-red-600 px-4 py-2 text-sm font-black text-white transition hover:bg-red-700">
                        @auth
                            {{ Auth::user()->name }}
                        @else
                            Sign In
                        @endauth
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-3 w-48 rounded-2xl border border-black/10 bg-white p-2 text-gray-900 shadow-2xl">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block rounded-xl px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block rounded-xl px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full rounded-xl px-4 py-2 text-left text-sm font-bold hover:bg-red-50 hover:text-red-700">Log Out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block rounded-xl px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Log In</a>
                            <a href="{{ route('register') }}" class="block rounded-xl px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Register</a>
                        @endauth
                    </div>
                </div>

                <button @click="openMenu = ! openMenu" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/10 lg:hidden" aria-label="Menu">
                    <span class="sr-only">Open menu</span>
                    <i class="fa-solid" :class="openMenu ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <div x-show="openMenu" x-transition class="mt-4 border-t border-white/10 pt-4 lg:hidden">
            <div class="grid gap-2">
                <a href="{{ route('about') }}" class="rounded-2xl px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/10 hover:text-white">About</a>
                <a href="{{ route('custom') }}" class="rounded-2xl px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/10 hover:text-white">Custom</a>
                <a href="{{ route('our-products') }}" class="rounded-2xl px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/10 hover:text-white">Products</a>
                <a href="{{ route('testimonials') }}" class="rounded-2xl px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/10 hover:text-white">Testimonials</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-2xl px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/10 hover:text-white">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="rounded-2xl bg-red-600 px-4 py-3 text-sm font-black text-white">Log In</a>
                @endauth
            </div>
        </div>
    </div>
</header>