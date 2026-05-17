<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Best Seller') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <div class="text-gray-900 p-5">
                    <div class="p-6">
                        <h1 class="text-2xl font-black text-gray-950 mb-4">Kelola Best Seller</h1>

                        {{-- Tambah Produk ke Best Seller --}}
                        <form action="{{ route('best-seller.store') }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex flex-col md:flex-row md:justify-start gap-2 w-full md:w-auto">
                                <select name="product_id" required 
                                    class="border border-gray-300 rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="" disabled selected>-- Pilih Produk --</option>
                                    @foreach($products as $product)
                                        @if(!in_array($product->id, $bestSellers->pluck('id')->toArray()))
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <button type="submit" 
                                    class="bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg w-full md:w-auto transition">
                                    Tambah
                                </button>
                            </div>
                        </form>

                        {{-- List Produk Best Seller --}}
                        <h2 class="text-xl font-bold text-gray-950 mb-3">Daftar Produk Best Seller</h2>

                        {{-- Tabel untuk layar medium ke atas --}}
                        <div class="hidden md:block overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                            <table class="w-full border text-sm sm:text-base">
                                <thead>
                                    <tr class="bg-gray-950 text-white">
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Nama Produk</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Harga</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bestSellers as $item)
                                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                                            <td class="p-3">{{ $item->name }}</td>
                                            <td class="p-3">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="p-3">
                                                <form action="{{ route('best-seller.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="flex items-center py-1.5 px-3 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                                                        <svg class="w-4 h-4 mr-1" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z"/>
                                                        </svg>
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center p-6 text-gray-500">Belum ada produk Best Seller</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Card view untuk mobile --}}
                        <div class="md:hidden space-y-4">
                            @forelse($bestSellers as $item)
                                <div class="border border-gray-200 rounded-xl p-4 shadow-sm flex flex-col gap-2">
                                    <div class="text-base font-semibold text-gray-950">{{ $item->name }}</div>
                                    <div class="text-sm text-gray-600">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                                    <form action="{{ route('best-seller.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <p class="text-center text-gray-500">Belum ada produk Best Seller</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>