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
<body class="cpx-shell">
    <main>
        <x-header></x-header>

        <section class="cpx-section pt-32 md:pt-40 antialiased">
            <div class="cpx-container">
                <div class="mb-8 relative overflow-hidden rounded-lg bg-gray-950 p-7 text-white shadow-2xl md:p-10 border border-white/5">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 -rotate-12 translate-x-10 -translate-y-10"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-1 bg-gradient-to-r from-red-600 to-transparent"></div>
                    <span class="cpx-eyebrow border-white/15 bg-white/10 text-white relative z-10">Customer Stories</span>
                    <h2 class="cpx-heading mt-4 text-7xl md:text-9xl relative z-10">Penilaian Toko</h2>
                    <p class="mt-4 max-w-2xl text-white/65 relative z-10">Cerita pelanggan dan komunitas yang sudah pakai jersey CPX.</p>
                </div>

                <div class="grid gap-5">
                    @foreach ( $testimonials as $testimonial )
                        <article class="flex flex-col gap-4 p-5 rounded-lg border border-white/10 bg-gray-950 transition hover:-translate-y-1 hover:border-red-500/40 md:flex-row md:items-start md:gap-6 md:p-6 shadow-xl">
                            <div class="shrink-0 w-full md:w-48 lg:w-64 space-y-3">
                                <div class="flex items-center gap-1">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="h-4 w-4 md:h-5 md:w-5 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                        </svg>
                                    @endfor
                                </div>

                                <div class="space-y-1">
                                    <p class="text-sm md:text-base font-black text-white">{{ $testimonial->name }}</p>
                                    <p class="text-xs md:text-sm text-white/50">{{ $testimonial->created_at->format('F d, Y') }}</p>
                                </div>

                                <div class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4 md:h-5 md:w-5 text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            fill-rule="evenodd"
                                            d="M12 2c-.791 0-1.55.314-2.11.874l-.893.893a.985.985 0 0 1-.696.288H7.04A2.984 2.984 0 0 0 4.055 7.04v1.262a.986.986 0 0 1-.288.696l-.893.893a2.984 2.984 0 0 0 0 4.22l.893.893a.985.985 0 0 1 .288.696v1.262a2.984 2.984 0 0 0 2.984 2.984h1.262c.261 0 .512.104.696.288l.893.893a2.984 2.984 0 0 0 4.22 0l.893-.893a.985.985 0 0 1 .696-.288h1.262a2.984 2.984 0 0 0 2.984-2.984V15.7c0-.261.104-.512.288-.696l.893-.893a2.984 2.984 0 0 0 0-4.22l-.893-.893a.985.985 0 0 1-.288-.696V7.04a2.984 2.984 0 0 0-2.984-2.984h-1.262a.985.985 0 0 1-.696-.288l-.893-.893A2.984 2.984 0 0 0 12 2Zm3.683 7.73a1 1 0 1 0-1.414-1.413l-4.253 4.253-1.277-1.277a1 1 0 0 0-1.415 1.414l1.985 1.984a1 1 0 0 0 1.414 0l4.96-4.96Z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                    <p class="text-xs md:text-sm font-medium text-white/80">{{ $testimonial->position ?? 'Customer' }}</p>
                                </div>
                            </div>

                            <div class="flex-1 min-w-0 space-y-4">
                                <div class="text-sm md:text-base text-white/70 leading-relaxed">{!! \App\Support\HtmlSanitizer::clean($testimonial->message) !!}</div>
                                
                                @if($testimonial->photo)
                                    <div class="flex justify-start">
                                        <div class="space-y-2">
                                            <p class="text-xs md:text-sm font-medium text-white/40">Foto Produk yang Dibeli:</p>
                                            <img src="{{ asset('images/' . $testimonial->photo) }}" 
                                                 alt="Foto produk dari {{ $testimonial->name }}" 
                                                 class="h-24 w-24 md:h-32 md:w-32 rounded-lg object-cover border border-white/10 hover:border-red-600 transition-colors duration-200">
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
