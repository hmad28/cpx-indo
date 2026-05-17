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
            <div class="mb-8 rounded-[2rem] bg-gray-950 p-7 text-white shadow-2xl md:p-10">
                <span class="cpx-eyebrow border-white/15 bg-white/10 text-white">Size Guide</span>
                <h1 class="cpx-heading mt-4 text-6xl md:text-8xl">Panduan Ukuran Jersey</h1>
                <p class="mt-4 max-w-2xl text-white/65">Pilih ukuran yang pas sebelum checkout agar jersey nyaman dipakai saat latihan maupun pertandingan.</p>
            </div>
        
            <div class="space-y-4 my-10">
                <details class="cpx-card group p-3 [&_summary::-webkit-details-marker]:hidden" open>
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-2xl bg-white p-4 text-gray-900"
                    >
                    <h2 class="text-lg font-medium">Ukuran Jersey XC</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
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
                            class="mx-auto w-[400px] rounded-lg shadow-md">
                        <p class="mt-3 text-sm text-gray-500">Jersey XC</p>
                    </div>
                </details>

                <details class="cpx-card group p-3 [&_summary::-webkit-details-marker]:hidden">
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-2xl bg-white p-4 text-gray-900"
                    >
                    <h2 class="text-lg font-medium">Lorem ipsum dolor sit amet consectetur adipisicing?</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
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
                            class="mx-auto w-[400px] rounded-lg shadow-md">
                        <p class="mt-3 text-sm text-gray-500">Jersey XC</p>
                    </div>
                </details>

                <details class="cpx-card group p-3 [&_summary::-webkit-details-marker]:hidden">
                    <summary
                    class="flex items-center justify-between gap-1.5 rounded-2xl bg-white p-4 text-gray-900"
                    >
                    <h2 class="text-lg font-medium">Lorem ipsum dolor sit amet consectetur adipisicing?</h2>

                    <svg
                        class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
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
                            class="mx-auto w-[400px] rounded-lg shadow-md">
                        <p class="mt-3 text-sm text-gray-500">Jersey XC</p>
                    </div>
                </details>
            </div>

            <p class="text-gray-600 mb-8">
                Pastikan memilih ukuran jersey yang tepat agar nyaman dipakai. 
                Gunakan tabel berikut sebagai referensi.
            </p>
        
            <!-- Tabel Ukuran -->
            <div class="overflow-x-auto rounded-[1.5rem] border border-black/10 bg-white shadow-xl">
                <table class="min-w-full border border-gray-200 text-center text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border">Ukuran</th>
                            <th class="px-4 py-3 border">Lebar Dada (cm)</th>
                            <th class="px-4 py-3 border">Panjang Badan (cm)</th>
                            <th class="px-4 py-3 border">Rekomendasi Tinggi (cm)</th>
                            <th class="px-4 py-3 border">Rekomendasi Berat (kg)</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-4 py-3 border font-medium">S</td>
                            <td class="px-4 py-3 border">48</td>
                            <td class="px-4 py-3 border">68</td>
                            <td class="px-4 py-3 border">160–165</td>
                            <td class="px-4 py-3 border">50–60</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border font-medium">M</td>
                            <td class="px-4 py-3 border">50</td>
                            <td class="px-4 py-3 border">70</td>
                            <td class="px-4 py-3 border">165–170</td>
                            <td class="px-4 py-3 border">55–65</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border font-medium">L</td>
                            <td class="px-4 py-3 border">52</td>
                            <td class="px-4 py-3 border">72</td>
                            <td class="px-4 py-3 border">170–175</td>
                            <td class="px-4 py-3 border">60–70</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border font-medium">XL</td>
                            <td class="px-4 py-3 border">54</td>
                            <td class="px-4 py-3 border">74</td>
                            <td class="px-4 py-3 border">175–180</td>
                            <td class="px-4 py-3 border">70–80</td>
                        </tr>
                        <tr>
                            <td class="px-4 py-3 border font-medium">XXL</td>
                            <td class="px-4 py-3 border">56</td>
                            <td class="px-4 py-3 border">76</td>
                            <td class="px-4 py-3 border">180–185</td>
                            <td class="px-4 py-3 border">80–90</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        
            <!-- Tips -->
            <div class="mt-8 rounded-[1.5rem] border border-red-100 bg-red-50 p-5">
                <h2 class="text-lg font-black text-red-700 mb-2">Tips Memilih Ukuran:</h2>
                <ul class="list-disc pl-5 space-y-2 text-gray-700">
                    <li>Jika ragu, pilih ukuran lebih besar agar lebih nyaman.</li>
                    <li>Bandingkan dengan ukuran kaos yang biasa kamu pakai.</li>
                    <li>Ukuran bisa sedikit berbeda (1–2 cm) tergantung metode produksi.</li>
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
