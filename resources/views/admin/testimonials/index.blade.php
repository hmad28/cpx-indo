<x-app-layout>
    @push('style')
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
        <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
        />
        <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    @endpush

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Testimonial') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg">
                <div class="text-gray-900 p-5">
                    <section class=":bg-gray-900 p-3 sm:p-0 antialiased">
                        <h2 class="text-xl font-bold pl-4 mb-4">Testimonials</h2>
                        <div class="md:max-w-screen-xl 2xl:max-w-full">
                            <div class="bg-white :bg-gray-800 relative border sm:rounded-lg overflow-hidden">
                                <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0 md:space-x-4 p-4">
                                    <div class="w-full md:w-1/2">
                                        <form class="flex items-center" action="" method="GET">
                                            <label for="simple-search" class="sr-only">Search Testimonial</label>
                                            <div class="relative w-full">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 :text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="simple-search" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Search testimonial">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                        <button type="button" id="createCategoryModalButton" data-modal-target="createCategoryModal" data-modal-toggle="createCategoryModal" class="flex items-center justify-center text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 :bg-blue-600 :hover:bg-blue-700 focus:outline-none :focus:ring-blue-800">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Add testimonial
                                        </button>
                                    </div>
                                </div>

                                {{-- DESKTOP TABLE --}}
                                <div class="hidden md:block overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-4 py-4">#</th>
                                                <th scope="col" class="px-4 py-3">Nama Kategori</th>
                                                <th scope="col" class="px-4 py-3">Posisi</th>
                                                <th scope="col" class="px-4 py-3">Pesan</th>
                                                <th scope="col" class="px-4 py-3">Gambar</th>
                                                <th scope="col" class="px-4 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $testimonials as $testimonial )
                                                <tr class="border-b :border-gray-700">
                                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap :text-white">{{ $loop->iteration }}</th>
                                                    <td class="px-4 py-3">{{ $testimonial->name }}</td>
                                                    <td class="px-4 py-3">{{ $testimonial->position }}</td>
                                                    <td class="px-4 py-3">{!! $testimonial->message !!}</td>
                                                    <td class="px-4 py-2">
                                                        @if($testimonial->photo)
                                                            <img src="{{ asset('images/'.$testimonial->photo) }}" alt="Photo" class="w-14 h-14 object-cover rounded">
                                                        @endif
                                                    </td>
                                                    <td class="px-4 py-3 flex items-center justify-end">
                                                        <button id="category-{{ $testimonial->id }}-dropdown-button" data-dropdown-toggle="category-{{ $testimonial->id }}-dropdown" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 :hover:bg-gray-700 p-1.5 :hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none :text-gray-400 :hover:text-gray-100" type="button">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                        <div id="category-{{ $testimonial->id }}-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow :bg-gray-700 :divide-gray-600">
                                                            <ul class="py-1 text-sm" aria-labelledby="category-{{ $testimonial->id }}-dropdown-button">
                                                                <li>
                                                                    <button type="button" data-modal-target="updateCategoryModal-{{ $testimonial->id }}" data-modal-toggle="updateCategoryModal-{{ $testimonial->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200">
                                                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                                        </svg>
                                                                        Edit
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" data-modal-target="deleteModal-{{ $testimonial->id }}" data-modal-toggle="deleteModal-{{ $testimonial->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 :hover:bg-gray-600 text-red-500 :hover:text-red-400">
                                                                        <svg class="w-4 h-4 mr-2" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                                        </svg>
                                                                        Delete
                                                                    </button>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                {{-- MOBILE CARDS --}}
                                <div class="block md:hidden p-4 space-y-4">
                                    @foreach ( $testimonials as $testimonial )
                                        <div class="bg-white border rounded-lg p-3 shadow">
                                            <div class="flex items-center space-x-3">
                                                <div>
                                                    <h3 class="font-semibold text-gray-900">{{ $testimonial->name }}</h3>
                                                    <p class="text-sm text-gray-500">{{ $testimonial->position }}</p>
                                                </div>
                                            </div>
                                            <div class="mt-2 text-sm text-gray-700 line-clamp-2">
                                                {!! $testimonial->message !!}
                                            </div>
                                            <img src="../images/{{ $testimonial->photo }}" class="w-16 h-16 rounded object-cover mt-3">
                                            <div class="mt-3 flex justify-end gap-1">
                                                {{-- Actions dropdown atau tombol langsung --}}
                                                    <button type="button" data-modal-target="updateTestimonialModal-{{ $testimonial->id }}" data-modal-toggle="updateTestimonialModal-{{ $testimonial->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200"> <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" /> </svg></button> 
                                                    <button type="button" data-modal-target="readTestimonialModal-{{ $testimonial->id }}" data-modal-toggle="readTestimonialModal-{{ $testimonial->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200"> <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true"> <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /> <path fill-rule="evenodd" clip-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" /> </svg></button> 
                                                    <button type="button" data-modal-target="deleteModal-{{ $testimonial->id }}" data-modal-toggle="deleteModal-{{ $testimonial->id }}" class="flex items-center py-2 px-2 hover:bg-gray-100 :hover:bg-gray-600 text-red-500 :hover:text-red-400"> <svg class="w-4 h-4" viewbox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"> <path fill-rule="evenodd" clip-rule="evenodd" fill="currentColor" d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" /> </svg></button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </section>
                    <!-- End block -->

                    <!-- Create modal -->
                    <div id="createCategoryModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 :text-white">Tambah Testimonial</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-target="createCategoryModal" data-modal-toggle="createCategoryModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('testimonials.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="grid gap-4 mb-4">
                                        <div>
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Name</label>
                                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Nama testimonial" required="">
                                        </div>
                                        <div>
                                            <label for="position" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Posisi</label>
                                            <input type="text" name="position" id="position" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Posisi pemberi testimonial" required="">
                                        </div>
                                        <div>
                                            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Pesan</label>
                                            <input type="text" name="message" id="message" class="message hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" placeholder="Pesan dari testimonial (MAKS. 1000 Karakter)">
                                            <div id="editor-create" class="editor"></div>
                                        </div>
                                        <div>
                                            <label for="photo" class="block mb-2 mt-18 text-sm font-medium text-gray-900">Photo</label>
                                            {{-- <label for="photo" class="dark:hover:bg-bray-800 flex h-30 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100">
                                                <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                                    <svg class="mb-2 h-6 w-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                    </svg>
                                                    <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                    <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 2048KB)</p>
                                                </div>
                                                <input name="photo" id="photo" type="file" class="hidden" />
                                            </label> --}}

                                            <input class="filepond @error('avatar') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500  @enderror block w-full text-sm text-gray-800 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="avatar_help" id="photo" name="photo" type="file" accept="image/png, image/jpg, image/jpeg">
                                            @error('photo')
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800 hover:cursor-pointer">
                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Add new testimonial
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Update modal -->
                    @foreach ( $testimonials as $testimonial )
                        <div id="updateCategoryModal-{{ $testimonial->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 :text-white">Update Product</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-toggle="updateCategoryModal-{{ $testimonial->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{ route('testimonials.update', $testimonial->id) }}" method="POST"  enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4">
                                            <div>
                                                <label for="name-{{ $testimonial->id }}" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Nama Produk</label>
                                                <input type="text" name="name" id="name-{{ $testimonial->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" value="{{ $testimonial->name }}">
                                            </div>
                                            <div>
                                                <label for="position-{{ $testimonial->id }}" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Posisi</label>
                                                <input type="text" name="position" id="position-{{ $testimonial->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" value="{{ $testimonial->position }}">
                                            </div>
                                            <div>
                                                <label for="message-{{ $testimonial->id }}" class="block mb-2 text-sm font-medium text-gray-900 :text-white">Pesan</label>
                                                <input type="text" name="message" id="message-{{ $testimonial->id }}" class="message hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 :bg-gray-700 :border-gray-600 :placeholder-gray-400 :text-white :focus:ring-blue-500 :focus:border-blue-500" value="{{ $testimonial->message }}">
                                                <div id="editor-update" class="editor">{!! old('message') !!}</div>
                                            </div>
                                            <div class="mb-4">
                                                
                                                <label class="block text-gray-700 mt-18">Foto</label>
                                                @if($testimonial->photo)
                                                    <div class="mb-2">
                                                        <img src="{{ asset('images/'.$testimonial->photo) }}" alt="Photo" class="w-24 h-24 object-cover rounded" id="photo-preview">
                                                    </div>
                                                @endif
                                                {{-- <label for="photo-{{ $testimonial->id }}" class="dark:hover:bg-bray-800 flex h-30 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100">
                                                    <div class="flex flex-col items-center justify-center pb-6 pt-5">
                                                        <svg class="mb-2 h-6 w-6 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                                        </svg>
                                                        <p class="mb-2 text-sm text-gray-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                                        <p class="text-xs text-gray-500">SVG, PNG, JPG or GIF (MAX. 2048KB)</p>
                                                    </div>
                                                    <input name="photo" id="photo-{{ $testimonial->id }}" type="file" class="hidden" />
                                                </label> --}}
                                                <input class="filepond @error('avatar') bg-red-50 border border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500  @enderror block w-full text-sm text-gray-800 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" aria-describedby="avatar_help" id="photo" name="photo" type="file" accept="image/png, image/jpg, image/jpeg">
                                                @error('photo')
                                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :bg-blue-600 :hover:bg-blue-700 :focus:ring-blue-800">Update testimonial</button>
                                            <button type="button" data-modal-target="deleteModal-{{ $testimonial->id }}" 
                                            data-modal-toggle="deleteModal-{{ $testimonial->id }}" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :border-red-500 :text-red-500 :hover:text-white :hover:bg-red-600 :focus:ring-red-900">
                                                <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                                Delete
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Delete modal -->
                    @foreach ($testimonials as $testimonial)
                    <div id="deleteModal-{{ $testimonial->id }}" tabindex="-1" aria-hidden="true" 
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
                            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5 bg-gray-800">
                                <!-- Close button -->
                                <button type="button" 
                                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 
                                        hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" 
                                    data-modal-toggle="deleteModal-{{ $testimonial->id }}">
                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0..." clip-rule="evenodd" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>

                                <!-- Icon -->
                                <svg class="text-gray-400 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" 
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1..." clip-rule="evenodd" />
                                </svg>

                                <p class="mb-4 text-gray-500">Are you sure you want to delete this item?</p>

                                <div class="flex justify-center items-center space-x-4">
                                    <button data-modal-hide="deleteModal-{{ $testimonial->id }}" type="button" 
                                        class="py-2 px-3 text-sm font-medium text-gray-500 border rounded-lg">
                                        No, cancel
                                    </button>
                                    <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            class="py-2 px-3 text-sm font-medium text-white bg-red-600 rounded-lg">
                                            Yes, I'm sure
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
        <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    
        <script>
            FilePond.registerPlugin(FilePondPluginImagePreview);
            FilePond.registerPlugin(FilePondPluginFileValidateType);
            FilePond.registerPlugin(FilePondPluginFileValidateSize);
    
            document.querySelectorAll('input.filepond').forEach((input) => {
                FilePond.create(input, {
                    storeAsFile: true,
                    acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
                    maxFileSize: '5MB',
                });
            });
        </script>
        <!-- Include the Quill library -->
        <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

        <!-- Initialize Quill editor -->
        <script>
            document.querySelectorAll('.editor').forEach((el) => {
                const quill = new Quill(el, {
                    theme: 'snow',
                    placeholder: 'Write testimonial message here'
                });

                const form = el.closest('form'); // ambil form terdekat
                const textarea = form.querySelector('.message'); // textarea di form ini aja

                form.addEventListener('submit', function() {
                    textarea.value = el.querySelector('.ql-editor').innerHTML;
                });
            });
        </script>
    @endpush
</x-app-layout>

{{-- <script>
    const input = document.getElementById('photo-{{ $testimonial->id }}');
      const previewPhoto = () => {
        const file = input.files;
        if (file) {
          const fileReader = new FileReader();
          const preview = document.getElementById('photo-preview');
          fileReader.onload = function(event) {
            preview.setAttribute('src', event.target.result);
          }
          fileReader.readAsDataURL(file[0]);
        }
      }
      input.addEventListener("change", previewPhoto);
</script> --}}
