{{-- resources/views/admin/whatsapp-numbers/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Kelola Nomor WhatsApp') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <div class="text-gray-900 p-5">
                    <div class="p-6">
                        <h1 class="text-2xl font-black text-gray-950 mb-4">Kelola Nomor WhatsApp</h1>

                        {{-- Tampilkan success message --}}
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Form Tambah Nomor WA --}}
                        {{-- <form action="{{ route('admin.whatsapp-numbers.store') }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex flex-col md:flex-row md:justify-start gap-2 w-full md:w-auto">
                                <select name="page_name" required 
                                    class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="" disabled selected>-- Pilih Halaman --</option>
                                    @foreach($pages as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <select name="position" class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500" required>
                                    <option value="" disabled selected>-- Pilih Bagian --</option>
                                    @foreach($positions as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="phone_number" placeholder="Nomor WA (08xxxxxxxxx)" required
                                    class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <input type="text" name="display_name" placeholder="Nama untuk ditampilkan" required
                                    class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <input type="text" name="message" placeholder="Pesan default (opsional)"
                                    class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                <select name="is_active" required
                                    class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    <option value="" disabled selected>-- Status --</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <button type="submit" 
                                    class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded-lg w-full md:w-auto transition">
                                    Tambah
                                </button>
                            </div>
                        </form> --}}

                        {{-- List Nomor WA --}}
                        {{-- <h2 class="text-xl font-semibold mb-3">Daftar Nomor WhatsApp</h2> --}}

                        {{-- Tabel untuk layar medium ke atas --}}
                        <div class="hidden md:block overflow-x-auto rounded-xl border border-gray-200 shadow-sm">
                            <table class="w-full border text-sm sm:text-base">
                                <thead>
                                    <tr class="bg-gray-950 text-white">
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Halaman</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Bagian</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Nomor WA</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Nama Tampilan</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Pesan Default</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Status</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Link WA</th>
                                        <th class="p-3 whitespace-nowrap text-left font-semibold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- List Nomor WA --}}
                                    
                                    @forelse($whatsappNumbers as $wa)
                                        <tr class="hover:bg-gray-50 border-b border-gray-100">
                                            <td class="p-3">
                                                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                                    {{ $pages[$wa->page_name] ?? $wa->page_name }}
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                                    {{ $positions[$wa->position] ?? $wa->position }}
                                                </span>
                                            </td>
                                            <td class="p-3 font-mono">{{ $wa->phone_number }}</td>
                                            <td class="p-3">{{ $wa->display_name }}</td>
                                            <td class="p-3 text-sm">
                                                {{ $wa->message ? Str::limit($wa->message, 30) : '-' }}
                                            </td>
                                            <td class="p-3">
                                                <span class="px-2 py-1 rounded text-xs {{ $wa->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                                    {{ $wa->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td class="p-3">
                                                <a href="{{ $wa->whatsapp_url }}" target="_blank" 
                                                    class="text-green-600 hover:text-green-800 text-sm">
                                                    <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                                    </svg>
                                                    Test
                                                </a>
                                            </td>
                                            <td class="p-3">
                                                <div class="flex gap-1">
                                                    {{-- Tombol Edit --}}
                                                    <button type="button"
                                                        onclick="openEditModal({{ $wa->id }}, '{{ $wa->page_name }}', '{{ $wa->phone_number }}', '{{ $wa->display_name }}', '{{ $wa->message }}', {{ $wa->is_active ? 'true' : 'false' }})"
                                                        class="flex items-center py-1.5 px-3 bg-gray-950 hover:bg-gray-800 text-white rounded-lg text-sm font-medium transition">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </button>
                                                    {{-- Tombol Delete --}}
                                                    <form action="{{ route('admin.whatsapp-numbers.destroy', $wa) }}" method="POST" onsubmit="return confirm('Yakin mau hapus nomor WhatsApp ini?')" class="inline">
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
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center p-6 text-gray-500">Belum ada nomor WhatsApp</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{-- Pagination --}}
                            
                        </div>

                        {{-- Card view untuk mobile --}}
                        <div class="md:hidden space-y-4">
                            @forelse($whatsappNumbers as $wa)
                                <div class="border border-gray-200 rounded-xl p-4 shadow-sm flex flex-col gap-2">
                                    <div class="flex justify-between items-start">
                                        <div class="text-base font-semibold">{{ $wa->display_name }}</div>
                                        <span class="px-2 py-1 rounded text-xs bg-blue-100 text-blue-800">
                                            {{ $pages[$wa->page_name] ?? $wa->page_name }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-600 font-mono">{{ $wa->phone_number }}</div>
                                    @if($wa->message)
                                        <div class="text-xs text-gray-500">{{ Str::limit($wa->message, 50) }}</div>
                                    @endif
                                    <div class="flex justify-between items-center">
                                        <span class="px-2 py-1 rounded text-xs {{ $wa->is_active ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                            {{ $wa->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                        <a href="{{ $wa->whatsapp_url }}" target="_blank" 
                                            class="text-green-600 hover:text-green-800 text-sm">
                                            <svg class="w-4 h-4 inline" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                            </svg>
                                            Test WA
                                        </a>
                                    </div>
                                    <div class="flex gap-2 mt-2">
                                        <button type="button"
                                            onclick="openEditModal({{ $wa->id }}, '{{ $wa->page_name }}', '{{ $wa->phone_number }}', '{{ $wa->display_name }}', '{{ $wa->message }}', {{ $wa->is_active ? 'true' : 'false' }})"
                                            class="flex-1 py-2 bg-gray-950 hover:bg-gray-800 text-white rounded-lg text-sm font-medium transition">
                                            Edit
                                        </button>
                                        <form action="{{ route('admin.whatsapp-numbers.destroy', $wa) }}" method="POST" onsubmit="return confirm('Yakin mau hapus nomor WhatsApp ini?')" class="flex-1">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500">Belum ada nomor WhatsApp</p>
                            @endforelse
                            {{-- Pagination untuk mobile --}}
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border border-gray-200 w-11/12 md:w-1/2 shadow-lg rounded-xl bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-black text-gray-950 mb-4">Edit Nomor WhatsApp</h3>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 gap-4">
                        <div class="hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Halaman</label>
                            <select id="edit_page_name_display" disabled 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-gray-100">
                                @foreach($pages as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            <!-- Hidden input untuk mengirim nilai page_name -->
                            <input type="hidden" id="edit_page_name" name="page_name">
                            <p class="text-xs text-gray-500 mt-1">Halaman tidak bisa diubah, hapus dan buat baru jika perlu.</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                            <input type="text" id="edit_phone_number" name="phone_number" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Tampilan</label>
                            <input type="text" id="edit_display_name" name="display_name" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pesan Default</label>
                            <textarea id="edit_message" name="message" rows="3" 
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Ketik pesan otomatis yang diinginkan"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="edit_is_active" name="is_active" required
                                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 mt-6">
                        <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                            Batal
                        </button>
                        <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, pageName, phoneNumber, displayName, message, isActive) {
            // Set form action
            document.getElementById('editForm').action = "{{ route('admin.whatsapp-numbers.update', ':id') }}".replace(':id', id);
            
            // Fill form fields
            document.getElementById('edit_page_name_display').value = pageName; // Untuk tampilan
            document.getElementById('edit_page_name').value = pageName; // Hidden input yang dikirim
            document.getElementById('edit_phone_number').value = phoneNumber;
            document.getElementById('edit_display_name').value = displayName;
            document.getElementById('edit_message').value = message || '';
            document.getElementById('edit_is_active').value = isActive ? '1' : '0';
            
            // Show modal
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeEditModal();
            }
        });
    </script>
</x-app-layout>