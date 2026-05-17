<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CPX | Sizes Guide</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="{{ asset('images/logo cpx.ico') }}" type="image/x-icon"/>
</head>
<body class="cpx-shell">
    <main>
        <x-header></x-header>

        <div class="cpx-container pb-20 pt-36 sm:px-6 lg:px-8">
            <div class="mb-8 relative overflow-hidden rounded-lg bg-gray-950 p-7 text-white shadow-2xl md:p-10 border border-white/5">
                <div class="absolute top-0 right-0 w-32 h-32 bg-red-600/20 -rotate-12 translate-x-10 -translate-y-10"></div>
                <div class="absolute bottom-0 left-0 w-24 h-1 bg-gradient-to-r from-red-600 to-transparent"></div>
                <span class="cpx-eyebrow border-white/15 bg-white/10 text-white relative z-10">Size Guide</span>
                <h1 class="cpx-heading mt-4 text-7xl md:text-9xl relative z-10">Panduan Ukuran Jersey</h1>
                <p class="mt-4 max-w-2xl text-white/65 relative z-10">Pilih ukuran yang pas sebelum checkout agar jersey nyaman dipakai saat latihan maupun pertandingan.</p>
            </div>
        
            <div class="space-y-4 my-10">
                <details class="group rounded-lg border border-white/10 bg-gray-950 p-1 shadow-xl [&_summary::-webkit-details-marker]:hidden" open>
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-lg bg-gray-900 p-4 text-white cursor-pointer hover:bg-gray-800 transition-colors"
                    >
                    <h2 class="text-lg font-bold">Ukuran Jersey XC</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-red-500"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    </summary>

                    <div class="my-10 text-center">
                        <img src="{{ asset('images/Size chart.jpeg') }}" 
                            alt="Panduan Mengukur Jersey" 
                            class="mx-auto w-[400px] rounded-lg shadow-md border border-white/10">
                        <p class="mt-3 text-sm text-white/50">Jersey XC</p>
                    </div>
                </details>

                <details class="group rounded-lg border border-white/10 bg-gray-950 p-1 shadow-xl [&_summary::-webkit-details-marker]:hidden">
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-lg bg-gray-900 p-4 text-white cursor-pointer hover:bg-gray-800 transition-colors"
                    >
                    <h2 class="text-lg font-bold">Lorem ipsum dolor sit amet consectetur adipisicing?</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-red-500"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    </summary>

                    <div class="my-10 text-center">
                        <img src="{{ asset('images/jersey-sport-women.jpeg') }}" 
                            alt="Panduan Mengukur Jersey" 
                            class="mx-auto w-[400px] rounded-lg shadow-md border border-white/10">
                        <p class="mt-3 text-sm text-white/50">Jersey XC</p>
                    </div>
                </details>

                <details class="group rounded-lg border border-white/10 bg-gray-950 p-1 shadow-xl [&_summary::-webkit-details-marker]:hidden">
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-lg bg-gray-900 p-4 text-white cursor-pointer hover:bg-gray-800 transition-colors"
                    >
                    <h2 class="text-lg font-bold">Lorem ipsum dolor sit amet consectetur adipisicing?</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180 text-red-500"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                    </summary>

                    <div class="my-10 text-center">
                        <img src="{{ asset('images/size-jr-pendek.jpg') }}" 
                            alt="Panduan Mengukur Jersey" 
                            class="mx-auto w-[400px] rounded-lg shadow-md border border-white/10">
                        <p class="mt-3 text-sm text-white/50">Jersey XC</p>
                    </div>
                </details>
            </div>

            <p class="text-white/60 mb-8">
                Pastikan memilih ukuran jersey yang tepat agar nyaman dipakai. 
                Gunakan tabel berikut sebagai referensi.
            </p>
        
            <!-- Tabel Ukuran -->
            <div class="overflow-x-auto rounded-lg border border-white/10 shadow-xl">
                <table class="min-w-full text-center text-sm">
                    <thead class="bg-gray-950 text-white">
                        <tr>
                            <th class="px-4 py-4 border border-white/10 font-bold">Ukuran</th>
                            <th class="px-4 py-4 border border-white/10 font-bold">Lebar Dada (cm)</th>
                            <th class="px-4 py-4 border border-white/10 font-bold">Panjang Badan (cm)</th>
                            <th class="px-4 py-4 border border-white/10 font-bold">Rekomendasi Tinggi (cm)</th>
                            <th class="px-4 py-4 border border-white/10 font-bold">Rekomendasi Berat (kg)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-gray-800">
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border border-gray-200 font-bold text-gray-900">S</td>
                            <td class="px-4 py-3 border border-gray-200">48</td>
                            <td class="px-4 py-3 border border-gray-200">68</td>
                            <td class="px-4 py-3 border border-gray-200">160-165</td>
                            <td class="px-4 py-3 border border-gray-200">50-60</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border border-gray-200 font-bold text-gray-900">M</td>
                            <td class="px-4 py-3 border border-gray-200">50</td>
                            <td class="px-4 py-3 border border-gray-200">70</td>
                            <td class="px-4 py-3 border border-gray-200">165-170</td>
                            <td class="px-4 py-3 border border-gray-200">55-65</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border border-gray-200 font-bold text-gray-900">L</td>
                            <td class="px-4 py-3 border border-gray-200">52</td>
                            <td class="px-4 py-3 border border-gray-200">72</td>
                            <td class="px-4 py-3 border border-gray-200">170-175</td>
                            <td class="px-4 py-3 border border-gray-200">60-70</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border border-gray-200 font-bold text-gray-900">XL</td>
                            <td class="px-4 py-3 border border-gray-200">54</td>
                            <td class="px-4 py-3 border border-gray-200">74</td>
                            <td class="px-4 py-3 border border-gray-200">175-180</td>
                            <td class="px-4 py-3 border border-gray-200">70-80</td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 border border-gray-200 font-bold text-gray-900">XXL</td>
                            <td class="px-4 py-3 border border-gray-200">56</td>
                            <td class="px-4 py-3 border border-gray-200">76</td>
                            <td class="px-4 py-3 border border-gray-200">180-185</td>
                            <td class="px-4 py-3 border border-gray-200">80-90</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
            <!-- Tips -->
            <div class="mt-8 rounded-lg border border-red-500/30 bg-red-950/30 p-6">
                <h2 class="text-lg font-black text-red-500 mb-3">Tips Memilih Ukuran:</h2>
                <ul class="list-disc pl-5 space-y-2 text-white/70">
                    <li>Jika ragu, pilih ukuran lebih besar agar lebih nyaman.</li>
                    <li>Bandingkan dengan ukuran kaos yang biasa kamu pakai.</li>
                    <li>Ukuran bisa sedikit berbeda (1-2 cm) tergantung metode produksi.</li>
                </ul>
            </div>
        </div>

         <x-footer></x-footer>
    </main>
    <x-script></x-script>
    <script>
        const qtyInput = document.getElementById('qty');
        const incrementBtn = document.getElementById('increment');
        const decrementBtn = document.getElementById('decrement');

        incrementBtn.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        decrementBtn.addEventListener('click', () => {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });
    </script>
</body>
</html>
