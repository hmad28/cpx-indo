<header x-data="{ openMenu: false }" class="fixed left-0 top-0 z-50 w-full bg-gray-950 border-b border-white/10 shadow-lg shadow-black/30">
    <div class="mx-auto max-w-7xl px-4 py-3 text-white lg:px-6">
        <div class="flex items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <img src="{{ asset('images/logo cpx.jpeg') }}" alt="CPX Official" class="h-10 w-10 rounded-lg object-cover ring-2 ring-red-500/40 group-hover:ring-red-500 transition">
                <div class="leading-none">
                    <p class="text-sm font-black uppercase tracking-[0.22em] text-red-500">CPX</p>
                    <p class="text-[10px] font-semibold uppercase tracking-[0.22em] text-white/50">Official Wear</p>
                </div>
            </a>

            <nav class="hidden items-center gap-1 lg:flex">
                <a href="{{ route('about') }}" class="relative px-4 py-2 text-sm font-bold text-white/70 transition hover:text-white after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:h-0.5 after:w-0 after:bg-red-500 after:transition-all hover:after:w-6">About</a>
                <a href="{{ route('custom') }}" class="relative px-4 py-2 text-sm font-bold text-white/70 transition hover:text-white after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:h-0.5 after:w-0 after:bg-red-500 after:transition-all hover:after:w-6">Custom</a>
                <a href="{{ route('our-products') }}" class="relative px-4 py-2 text-sm font-bold text-white/70 transition hover:text-white after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:h-0.5 after:w-0 after:bg-red-500 after:transition-all hover:after:w-6">Products</a>
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = ! open" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-white/70 transition hover:text-white">
                        Kategori
                        <svg class="h-4 w-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition @click.outside="open = false" class="absolute left-0 mt-2 w-56 border border-white/10 bg-gray-950 p-2 shadow-2xl">
                        @foreach ($categories as $category)
                            <a href="{{ route('products.byCategory', ['category' => $category->slug]) }}" class="block px-4 py-2.5 text-sm font-semibold text-white/70 transition hover:bg-red-500/10 hover:text-red-400 border-l-2 border-transparent hover:border-red-500">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('testimonials') }}" class="relative px-4 py-2 text-sm font-bold text-white/70 transition hover:text-white after:absolute after:bottom-0 after:left-1/2 after:-translate-x-1/2 after:h-0.5 after:w-0 after:bg-red-500 after:transition-all hover:after:w-6">Testimonials</a>
            </nav>

            <div class="flex items-center gap-2">
                <a href="{{ route('cart.index') }}" class="inline-flex h-10 w-10 items-center justify-center border border-white/10 bg-white/5 text-white transition hover:bg-red-500 hover:border-red-500" aria-label="Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>

                <div class="relative hidden sm:block" x-data="{ open: false }">
                    <button @click="open = ! open" class="inline-flex items-center gap-2 bg-red-600 px-4 py-2 text-sm font-black text-white transition hover:bg-red-700 skew-x-[-3deg]">
                        <span class="skew-x-[3deg]">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Sign In
                            @endauth
                        </span>
                        <svg class="h-4 w-4 skew-x-[3deg]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="open" x-transition @click.away="open = false" class="absolute right-0 mt-2 w-48 border border-gray-200 bg-white p-2 text-gray-900 shadow-2xl">
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full px-4 py-2 text-left text-sm font-bold hover:bg-red-50 hover:text-red-700">Log Out</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Log In</a>
                            <a href="{{ route('register') }}" class="block px-4 py-2 text-sm font-bold hover:bg-red-50 hover:text-red-700">Register</a>
                        @endauth
                    </div>
                </div>

                <button @click="openMenu = ! openMenu" class="inline-flex h-10 w-10 items-center justify-center border border-white/10 bg-white/5 text-white hover:bg-red-500 hover:border-red-500 transition lg:hidden" aria-label="Menu">
                    <span class="sr-only">Open menu</span>
                    <i class="fa-solid" :class="openMenu ? 'fa-xmark' : 'fa-bars'"></i>
                </button>
            </div>
        </div>

        <div x-show="openMenu" x-transition class="mt-4 border-t border-white/10 pt-4 lg:hidden">
            <div class="grid gap-1">
                <a href="{{ route('about') }}" class="px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/5 hover:text-white border-l-2 border-transparent hover:border-red-500 transition">About</a>
                <a href="{{ route('custom') }}" class="px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/5 hover:text-white border-l-2 border-transparent hover:border-red-500 transition">Custom</a>
                <a href="{{ route('our-products') }}" class="px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/5 hover:text-white border-l-2 border-transparent hover:border-red-500 transition">Products</a>
                <a href="{{ route('testimonials') }}" class="px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/5 hover:text-white border-l-2 border-transparent hover:border-red-500 transition">Testimonials</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 py-3 text-sm font-bold text-white/75 hover:bg-white/5 hover:text-white border-l-2 border-transparent hover:border-red-500 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="mt-2 bg-red-600 px-4 py-3 text-sm font-black text-white text-center skew-x-[-2deg] hover:bg-red-700 transition">
                        <span class="skew-x-[2deg] inline-block">Log In</span>
                    </a>
                @endauth
            </div>
        </div>
    </div>
</header>
