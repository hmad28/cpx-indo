<section class="bg-white">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <h2 class="mb-8 text-4xl tracking-tight font-extrabold text-gray-900 ">Pertanyaan yang sering diajukan</h2>
        <div class="grid pt-8 text-left border-t border-gray-200 md:gap-16 y-700 md:grid-cols-2">
            
            @php
            // pastikan kita punya Collection (aman kalau $faqs udah Collection)
            if (! $faqs instanceof \Illuminate\Support\Collection) {
                $faqs = collect($faqs);
            }

            // hitung titik potong, lalu ambil dua sisi dan reset index (values())
            $half  = (int) ceil($faqs->count() / 2);
            $left  = $faqs->slice(0, $half)->values();   // baris ke-1
            $right = $faqs->slice($half)->values();      // lanjutan -> baris ke-2
            @endphp

            <div>
                @forelse ($left as $faq)
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <!-- icon -->
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                            {{ $faq->question }}
                        </h3>
                        <p class="text-gray-500">{{ $faq->answer }}</p>
                    </div>
                @empty
                    <p>Tidak ada FAQ.</p>
                @endforelse
            </div>

            <div>
                @forelse ($right as $faq)
                    <div class="mb-10">
                        <h3 class="flex items-center mb-4 text-lg font-medium text-gray-900 ">
                            <!-- icon -->
                            <svg class="flex-shrink-0 mr-2 w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                            {{ $faq->question }}
                        </h3>
                        <p class="text-gray-500">{{ $faq->answer }}</p>
                    </div>
                @empty
                    <p>Tidak ada FAQ.</p>
                @endforelse
            </div>

            
        </div>
    </div>
</section>