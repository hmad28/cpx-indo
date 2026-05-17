<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('FAQ') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="md:max-w-7xl 2xl:max-w-full mx-auto sm:px-6 lg:px-8 2xl:px-15">
            <div class="bg-white overflow-hidden rounded-xl border border-gray-200 shadow-sm">
                <div class="text-gray-900 p-5">
                    <section class="p-3 sm:p-0 antialiased">
                        <h2 class="text-xl font-black pl-4 mb-4 text-gray-950">FAQ</h2>
                        <div class="md:max-w-screen-xl 2xl:max-w-full">
                            <div class="bg-white relative border border-gray-200 rounded-xl overflow-hidden">
                                <div class="flex flex-col md:flex-row justify-between items-center space-y-3 md:space-y-0 md:space-x-4 p-4">
                                    <div class="w-full md:w-1/2">
                                        <form class="flex items-center" action="" method="GET">
                                            <label for="simple-search" class="sr-only">Search FAQ</label>
                                            <div class="relative w-full">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <input type="text" id="simple-search" name="keyword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full pl-10 p-2" placeholder="Search pertanyaan">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                        <button type="button" id="createFaqModalButton" data-modal-target="createFaqModal" data-modal-toggle="createFaqModal" class="flex items-center justify-center text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 focus:outline-none">
                                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                            </svg>
                                            Add faq
                                        </button>
                                    </div>
                                </div>
                                
                                {{-- <div class="overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500 :text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 :bg-gray-700 :text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-4 py-4">#</th>
                                                <th scope="col" class="px-4 py-3">Pertanyaan</th>
                                                <th scope="col" class="px-4 py-3">Jawaban</th>
                                                <th scope="col" class="px-4 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $faqs as $faq )
                                                <tr class="border-b :border-gray-700">
                                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap :text-white">{{ $loop->iteration }}</th>
                                                    <td class="px-4 py-3">{{ $faq->question }}</td>
                                                    <td class="px-4 py-3">{{ $faq->answer }}</td>
                                                    <td class="px-4 py-3 flex items-center justify-end">
                                                        <button id="faq-{{ $faq->id }}-dropdown-button" data-dropdown-toggle="faq-{{ $faq->id }}-dropdown" class="inline-flex items-center text-sm font-medium hover:bg-gray-100 :hover:bg-gray-700 p-1.5 :hover-bg-gray-800 text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none :text-gray-400 :hover:text-gray-100" type="button">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                            </svg>
                                                        </button>
                                                        <div id="faq-{{ $faq->id }}-dropdown" class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow :bg-gray-700 :divide-gray-600">
                                                            <ul class="py-1 text-sm" aria-labelledby="faq-{{ $faq->id }}-dropdown-button">
                                                                <li>
                                                                    <button type="button" data-modal-target="updateFaqModal-{{ $faq->id }}" data-modal-toggle="updateFaqModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 :hover:bg-gray-600 :hover:text-white text-gray-700 :text-gray-200">
                                                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                                        </svg>
                                                                        Edit
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" data-modal-target="deleteModal-{{ $faq->id }}" data-modal-toggle="deleteModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 :hover:bg-gray-600 text-red-500 :hover:text-red-400">
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
                                </div> --}}

                                <div class="overflow-x-auto hidden md:block">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-white uppercase bg-gray-950">
                                            <tr>
                                                <th scope="col" class="px-4 py-4">#</th>
                                                <th scope="col" class="px-4 py-3">Pertanyaan</th>
                                                <th scope="col" class="px-4 py-3">Jawaban</th>
                                                <th scope="col" class="px-4 py-3">
                                                    <span class="sr-only">Actions</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($faqs as $faq)
                                                <tr class="border-b">
                                                    <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $loop->iteration }}
                                                    </th>
                                                    <td class="px-4 py-3">{{ $faq->question }}</td>
                                                    <td class="px-4 py-3">{{ $faq->answer }}</td>
                                                    <td class="px-4 py-3 flex items-center justify-end">
                                                        {{-- Dropdown Action --}}
                                                        <button id="faq-{{ $faq->id }}-dropdown-button" 
                                                            data-dropdown-toggle="faq-{{ $faq->id }}-dropdown" 
                                                            class="inline-flex items-center text-sm font-medium hover:bg-gray-100 p-1.5 text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none" 
                                                            type="button">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                            </svg>
                                                        </button>
                                                        <div id="faq-{{ $faq->id }}-dropdown" 
                                                            class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                            <ul class="py-1 text-sm">
                                                                <li>
                                                                    <button type="button" data-modal-target="updateFaqModal-{{ $faq->id }}" data-modal-toggle="updateFaqModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                                        </svg>
                                                                        Edit
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button type="button" data-modal-target="deleteModal-{{ $faq->id }}" data-modal-toggle="deleteModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-red-500">
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

                                {{-- Card View for Mobile --}}
                                <div class="md:hidden space-y-4">
                                    @foreach ($faqs as $faq)
                                        <div class="border rounded-lg p-4 shadow bg-white">
                                            <div class="flex justify-between items-start">
                                                <span class="text-sm font-semibold text-gray-500">#{{ $loop->iteration }}</span>
                                                {{-- Dropdown Action --}}
                                                <button id="faq-{{ $faq->id }}-dropdown-button-mobile" 
                                                    data-dropdown-toggle="faq-{{ $faq->id }}-dropdown-mobile" 
                                                    class="p-1.5 rounded-lg text-gray-500 hover:bg-gray-100" type="button">
                                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"/>
                                                    </svg>
                                                </button>
                                                <div id="faq-{{ $faq->id }}-dropdown-mobile" 
                                                    class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow">
                                                    <ul class="py-1 text-sm">
                                                        <li>
                                                            <button type="button" data-modal-target="updateFaqModal-{{ $faq->id }}" data-modal-toggle="updateFaqModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-gray-700">
                                                                ✏️ Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" data-modal-target="deleteModal-{{ $faq->id }}" data-modal-toggle="deleteModal-{{ $faq->id }}" class="flex w-full items-center py-2 px-4 hover:bg-gray-100 text-red-500">
                                                                🗑️ Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mt-2 text-gray-800 text-sm"><span class="font-medium">Pertanyaan:</span> {{ $faq->question }}</p>
                                            <p class="mt-1 text-gray-600 text-sm"><span class="font-medium">Jawaban:</span> {{ $faq->answer }}</p>
                                        </div>
                                    @endforeach
                                </div>

                                
                            </div>
                        </div>
                    </section>
                    <!-- End block -->

                    <!-- Create modal -->
                    <div id="createFaqModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-2xl max-h-full">
                            <!-- Modal content -->
                            <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                <!-- Modal header -->
                                <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                    <h3 class="text-lg font-semibold text-gray-900 :text-white">Add pertanyaan</h3>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-target="createFaqModal" data-modal-toggle="createFaqModal">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <form action="{{ route('faq.store') }}" method="POST">
                                    @csrf
                                    <div class="grid gap-4 mb-4">
                                        <div>
                                            <label for="question" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                                            <input type="text" name="question" id="question" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Ketik pertanyaan" required="">
                                        </div>
                                        <div>
                                            <label for="answer" class="block mb-2 text-sm font-medium text-gray-900">Jawaban</label>
                                            <input type="text" name="answer" id="answer" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" placeholder="Ketik Jawaban" required="">
                                        </div>
                                    </div>
                                    <button type="submit" class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                        <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                                        </svg>
                                        Add new faq
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Update modal -->
                    @foreach ( $faqs as $faq )
                        <div id="updateFaqModal-{{ $faq->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative p-4 bg-white rounded-lg shadow :bg-gray-800 sm:p-5">
                                    <!-- Modal header -->
                                    <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 :border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 :text-white">Update pertanyaan</h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center :hover:bg-gray-600 :hover:text-white" data-modal-toggle="updateFaqModal-{{ $faq->id }}">
                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form action="{{ route('faq.update', $faq->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4">
                                            <div>
                                                <label for="name-{{ $faq->id }}" class="block mb-2 text-sm font-medium text-gray-900">Pertanyaan</label>
                                                <input type="text" name="question" id="name-{{ $faq->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" value="{{ $faq->question }}">
                                            </div>
                                            <div>
                                                <label for="name-{{ $faq->id }}" class="block mb-2 text-sm font-medium text-gray-900">Jawaban</label>
                                                <input type="text" name="answer" id="name-{{ $faq->id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5" value="{{ $faq->answer }}">
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update Faq</button>
                                            <button type="button" data-modal-target="deleteModal-{{ $faq->id }}" 
                                            data-modal-toggle="deleteModal-{{ $faq->id }}" class="text-red-600 inline-flex items-center hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center :border-red-500 :text-red-500 :hover:text-white :hover:bg-red-600 :focus:ring-red-900">
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
                    @foreach ($faqs as $faq)
                    <div id="deleteModal-{{ $faq->id }}" tabindex="-1" aria-hidden="true" 
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 
                            justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative p-4 text-center bg-white rounded-lg shadow sm:p-5 bg-gray-800">
                                <!-- Close button -->
                                <button type="button" 
                                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 
                                        hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" 
                                    data-modal-toggle="deleteModal-{{ $faq->id }}">
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

                                <p class="mb-4 text-gray-500">Are you sure you want to delete this faq?</p>

                                <div class="flex justify-center items-center space-x-4">
                                    <button data-modal-hide="deleteModal-{{ $faq->id }}" type="button" 
                                        class="py-2 px-3 text-sm font-medium text-gray-500 border rounded-lg">
                                        No, cancel
                                    </button>
                                    <form action="#" method="POST">
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
</x-app-layout>
