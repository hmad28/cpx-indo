<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Testimonials | CPX Official</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
</head>
<body>
    <main>
        <x-header></x-header>

        <section class="bg-white pt-25 pb-8 md:pt-30 2xl:pt-35 antialiased"> {{-- Tingkatkan padding responsive; hapus dark mode classes --}}
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8"> {{-- Tingkatkan padding untuk responsiveness --}}
                <div class="flex items-center justify-center md:justify-between mb-4 md:mb-8"> {{-- Center di mobile, justify-between di md; tambah mb --}}
                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-black">Penilaian Toko</h2> {{-- Ukuran text responsive; ganti gray-900 ke black --}}
                </div>

                <div class="space-y-6 md:space-y-8 divide-y divide-black"> {{-- Ganti divide-gray ke black; space-y lebih lega --}}
                    @foreach ( $testimonials as $testimonial )
                        <article class="py-6 md:py-8 flex flex-col md:flex-row md:items-start gap-4 md:gap-6 bg-white rounded-lg border border-black p-4 md:p-6 shadow-sm hover:shadow-md hover:border-red-600 transition-all duration-300"> {{-- Wrap dalam article/card; tambah border black, hover red; responsive flex --}}
                            <div class="shrink-0 w-full md:w-48 lg:w-64 space-y-3"> {{-- Ukuran fixed width responsive; space-y lebih --}}
                                <div class="flex items-center gap-1"> {{-- Gap lebih kecil --}}
                                    {{-- Asumsikan rating fixed 5 untuk sekarang; jika ada $testimonial->rating, ubah loop ke $i < $testimonial->rating untuk filled, sisanya outline --}}
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="h-4 w-4 md:h-5 md:w-5 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"> {{-- Ukuran responsive; ganti yellow-300 ke 400 untuk lebih bold --}}
                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    @endfor
                                </div>

                                <div class="space-y-1"> {{-- Space-y lebih kecil --}}
                                    <p class="text-sm md:text-base font-semibold text-black">{{ $testimonial->name }}</p> {{-- Text size responsive --}}
                                    <p class="text-xs md:text-sm text-black/70">{{ $testimonial->created_at->format('F d, Y') }}</p> {{-- Ganti gray-500 ke black/70 untuk subtle; size responsive --}}
                                </div>

                                <div class="inline-flex items-center gap-2"> {{-- Gap lebih --}}
                                    <svg class="h-4 w-4 md:h-5 md:w-5 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"> {{-- Ganti blue ke red-600 untuk tema; size responsive --}}
                                        <path
                                            fill-rule="evenodd"
                                            d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <p class="text-xs md:text-sm font-medium text-black">{{ $testimonial->position ?? 'Customer' }}</p> {{-- Ganti gray-900 ke black; size responsive --}}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0 space-y-4"> {{-- Tambah min-w-0 untuk truncate jika perlu --}}
                                <div class="text-sm md:text-base text-black leading-relaxed">{!! $testimonial->message !!}</div> {{-- Ganti gray-500 ke black; size dan leading responsive untuk readability --}}
                                
                                @if($testimonial->photo)
                                    <div class="flex justify-start"> {{-- Tambah label dan wrapper untuk clarity sebagai photo produk --}}
                                        <div class="space-y-2">
                                            <p class="text-xs md:text-sm font-medium text-black/50">Foto Produk yang Dibeli:</p>
                                            <img src="{{ asset('images/' . $testimonial->photo) }}" 
                                                 alt="Foto produk dari {{ $testimonial->name }}" 
                                                 class="h-24 w-24 md:h-32 md:w-32 rounded-lg object-cover border border-black hover:border-red-600 transition-colors duration-200"> {{-- Ukuran responsive; tambah alt descriptive; border black hover red --}}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <x-footer></x-footer>
    </main>
    <x-script></x-script>
</body>
</html>