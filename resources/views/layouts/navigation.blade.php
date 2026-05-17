<nav x-data="{ open: false }" class="bg-zinc-950 border-b border-red-600/40 shadow-lg shadow-zinc-900/30 sticky top-0 z-30">
    <div class="max-w-7xl 2xl:max-w-[100rem] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center text-white font-black italic shadow-md">
                            CP<span class="-ml-0.5">X</span>
                        </div>
                        <div class="hidden sm:block leading-tight">
                            <p class="text-sm font-bold text-white tracking-wide">CP<span class="text-red-500">X</span> Admin</p>
                            <p class="text-[10px] uppercase tracking-widest text-zinc-400">Dashboard Panel</p>
                        </div>
                    </a>
                </div>

                <div class="hidden lg:flex lg:items-center lg:ml-10 lg:space-x-1">
                    @php
                        $navItems = [
                            ['route' => 'dashboard',                       'label' => 'Dashboard'],
                            ['route' => 'products.index',                  'label' => 'Produk'],
                            ['route' => 'categories.index',                'label' => 'Kategori'],
                            ['route' => 'best-seller.index',               'label' => 'Best Seller'],
                            ['route' => 'diskons.index',                   'label' => 'Diskon'],
                            ['route' => 'testimonials.index',              'label' => 'Testimoni'],
                            ['route' => 'faq.index',                       'label' => 'FAQ'],
                            ['route' => 'admin.whatsapp-numbers.index',    'label' => 'WhatsApp'],
                        ];
                    @endphp
                    @foreach ($navItems as $item)
                        @php $active = request()->routeIs($item['route']); @endphp
                        <a href="{{ route($item['route']) }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition
                                  {{ $active
                                       ? 'bg-red-600/15 text-red-400 ring-1 ring-red-500/30'
                                       : 'text-zinc-300 hover:text-white hover:bg-white/5' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="hidden lg:flex lg:items-center lg:gap-3">
                <a href="{{ route('home') }}" target="_blank"
                   class="inline-flex items-center gap-2 rounded-lg border border-zinc-700 px-3 py-2 text-xs font-medium text-zinc-300 hover:text-white hover:border-red-500 transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14 3h7v7m0-7L10 14m-4 7H5a2 2 0 01-2-2v-1"/></svg>
                    Lihat Situs
                </a>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center gap-2 rounded-lg border border-zinc-700 bg-zinc-900 px-3 py-2 text-sm font-medium text-zinc-200 hover:border-red-500 hover:text-white focus:outline-none transition">
                            <span class="flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-red-700 text-xs font-bold text-white">
                                {{ \Illuminate\Support\Str::of(Auth::user()->name)->substr(0,1)->upper() }}
                            </span>
                            <span class="max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-zinc-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('home')">
                            {{ __('CPX Landing Page') }}
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-me-2 flex items-center lg:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-zinc-300 hover:text-white hover:bg-white/5 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile menu --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden lg:hidden border-t border-zinc-800">
        <div class="pt-2 pb-3 space-y-1 px-2">
            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium
                          {{ $active ? 'bg-red-600/15 text-red-400' : 'text-zinc-300 hover:text-white hover:bg-white/5' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </div>

        <div class="pt-4 pb-3 border-t border-zinc-800">
            <div class="flex items-center gap-3 px-4">
                <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-red-500 to-red-700 text-sm font-bold text-white">
                    {{ \Illuminate\Support\Str::of(Auth::user()->name)->substr(0,1)->upper() }}
                </span>
                <div class="min-w-0">
                    <div class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</div>
                    <div class="text-xs text-zinc-400 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('profile.edit') }}"
                   class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:text-white hover:bg-white/5">
                    {{ __('Profil') }}
                </a>
                <a href="{{ route('home') }}" target="_blank"
                   class="block px-3 py-2 rounded-lg text-sm font-medium text-zinc-300 hover:text-white hover:bg-white/5">
                    {{ __('Lihat Situs') }}
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="block px-3 py-2 rounded-lg text-sm font-medium text-red-400 hover:bg-red-500/10">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>
