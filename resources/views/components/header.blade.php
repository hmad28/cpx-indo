<header class="bg-black fixed top-0 left-0 w-full flex items-center z-10">
        <div class="container mx-auto">
            <div class="flex items-center justify-between relative pl-4 pr-3 lg:px-15">
                <div class="w-[40%] sm:w-[13%]">
                    <a href="/" class="text-sm font-bold md:text-2xl text-yellow-800/70 block py-4 md:py-6">
                        <img src="{{ asset('images/logo cpx.jpeg') }}" alt="">
                    </a>
                </div>
                {{-- <div class="relative">
                    <form action="#" method="POST">
                        @csrf
                        <input type="text" class="w-[80%] md:w-[100%] pl-6 pr-1 py-1 md:py-2 md:pl-8 md:pr-5 rounded-lg bg-slate-200 placeholder:text-sm md:placeholder:text-base" placeholder="Search ..." name="product_name">
                        <i class="text-xs md:text-base fa-solid fa-magnifying-glass absolute left-2 top-[10px] md:top-3 text-slate-500"></i>
                    </form>
                </div> --}}
                <div x-data="{ openMenu: false, openDropdown: false }" class="flex items-center px-4 lg:px-15">
                    <button @click="openMenu = !openMenu" type="button"
                        class="block lg:hidden absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
                        <span class="hamburger-line block w-6 h-0.5 bg-white mb-1 transition"
                            :class="{ 'rotate-45 translate-y-1.5': openMenu }"></span>
                        <span class="hamburger-line block w-6 h-0.5 bg-white mb-1 transition"
                            :class="{ 'opacity-0': openMenu }"></span>
                        <span class="hamburger-line block w-6 h-0.5 bg-white transition"
                            :class="{ '-rotate-45 -translate-y-1.5': openMenu }"></span>
                    </button>

                    <nav :class="{ 'hidden': !openMenu }" id="nav-menu" class="hidden absolute left-1/2 transform -translate-x-1/2 top-20 sm:top-0 sm:left-auto sm:translate-x-0 sm:transform-none py-4 bg-black text-gray-300 shadow-lg px-2 rounded-lg max-w-[200px] w-full right-4 top-15 lg:right-20 lg:block lg:static md:bg-transparent lg:max-w-full lg:shadow-none lg:rounded-none">
                        <ul class="block lg:flex lg:gap-5 items-center">
                            <li class="group mt-1 sm:mt-0">
                                <a href="/about" class="text-sm md:text-base text-gray-300 py-1 w-full px-2 md:px-4 flex border-b border-black group-hover:text-red-700 group-hover:border-b group-hover:border-red-500 rounded-2xl duration-200">About Us</a>
                            </li>
                            <li class="group">
                                <a href="/custom" class="text-sm md:text-base text-gray-300 py-1 w-full px-2 md:px-4 flex border-b border-black group-hover:text-red-700 group-hover:border-b group-hover:border-red-500 rounded-2xl duration-200">Custom</a>
                            </li>
                            <li class="group mt-1 sm:mt-0" x-data="{ open: false }">
                                <div class="relative">
                                    <button @click="open = !open" class="flex items-center justify-between w-full px-2 md:px-4 py-1 border-b border-black group-hover:text-red-700 group-hover:border-red-500 focus:text-red-700 focus:border-red-500 rounded-2xl duration-200">
                                        <span class="text-sm md:text-base">Kategori Jersey</span>
                                        <!-- Icon berubah tergantung state -->
                                        <svg x-show="!open" class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                        <svg x-show="open" class="w-4 h-4 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </button>

                                    <ul x-show="open" x-transition @click.outside="open = false" class="absolute text-sm md:text-base bg-zinc-900 border mt-4 rounded-md border-red-700 shadow-md w-48 z-10">
                                        @foreach ( $categories as $category )
                                            <li><a href="{{ route('products.byCategory', ['category' => $category->slug]) }}" class="block px-4 py-2 hover:bg-zinc-800 text-white">{{ $category->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="group mt-1 sm:mt-0">
                                <a href="/testimonials" class="text-sm md:text-base text-gray-300 py-1 w-full px-2 md:px-4 flex border-b border-black group-hover:text-red-700 group-hover:border-b group-hover:border-red-500 rounded-2xl duration-200">Testimonials</a>
                            </li>
                        </ul>
                    </nav>

                </div>
                <div class="flex gap-5 items-center">
                    <a href="/cart" class="text-sm md:text-base text-white hover:text-red-500 cursor-pointer">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" 
                            class="flex items-center text-sm md:text-base text-white justify-between py-1 w-full px-2 mr-2 md:mr-5 md:px-4 border-b border-black focus:text-red-700 focus:border-red-500 cursor-pointer rounded-2xl group-hover:text-red-700 group-hover:border-b group-hover:border-red-500 duration-200">
                            
                            {{-- ✅ Nama user atau tulisan Sign In --}}
                            <span>
                                @auth
                                    {{ Auth::user()->name }}
                                @else
                                    Sign In
                                @endauth
                            </span>

                            {{-- ✅ Icon panah --}}
                            <svg x-show="!open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                            <svg x-show="open" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- ✅ Dropdown Menu Dinamis --}}
                        <ul x-show="open" @click.away="open = false"
                            class="absolute bg-zinc-900 border mt-4 right-1 md:right-0 rounded-md border-red-700 shadow-md w-20 md:w-36 z-10 text-white">
                            @auth
                            <li><a href="{{ route('dashboard') }}" class="block text-xs md:text-base px-4 py-2 hover:bg-zinc-800">Dashboard</a></li>
                            <li><a href="{{ route('profile.edit') }}" class="block text-xs md:text-base px-4 py-2 hover:bg-zinc-800">Profil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block text-xs md:text-base w-full text-left px-4 py-2 hover:bg-zinc-800">
                                            Log Out
                                        </button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}" class="block text-xs md:text-base px-4 py-2 text-gray-200 hover:bg-zinc-800">Log In</a></li>
                                {{-- <li><a href="{{ route('register') }}" class="block text-xs md:text-base px-4 py-2 text-gray-200 hover:bg-zinc-800">Sign Up</a></li> --}}
                            @endauth
                        </ul>
                    </div>

                </div>
            </div>
            
        </div>
    </header>