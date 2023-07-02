@php use Carbon\Carbon; @endphp
<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('customersShow', $customers) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $customers->fullname() }}</h1>
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">
            <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
                {{-- Links --}}
                <div class="col-span-2">
                    {{-- Kundendaten --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="w-full h-auto user-bg">
                                    <span>{{ $customers->customer_salutation }}</span><br>
                                    <div class="text-gray-900 dark:text-gray-300 text-2xl font-semibold leading-none">{{ $customers->customer_firstname }}</div>
                                    <div class="text-gray-900 dark:text-gray-300 text-2xl font-semibold">{{ $customers->customer_lastname }}</div>
                                    <span>Kd.-Nr. {{ $customers->customer_kdnr }}</span>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex sm:flex-col items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="{{ route('backend.kunden.edit', $customers->id) }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Bearbeiten
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2 -mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                    <x-ag.button.a-link href="" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Nachricht
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2 -mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                            <div class="col-span-12">
                                <hr class="border-t-gray-900 dark:border-t-gray-300">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 640 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M544 248v3.3l69.7-69.7c21.9-21.9 21.9-57.3 0-79.2L535.6 24.4c-21.9-21.9-57.3-21.9-79.2 0L416.3 64.5c-2.7-.3-5.5-.5-8.3-.5H296c-37.1 0-67.6 28-71.6 64H224V248c0 22.1 17.9 40 40 40s40-17.9 40-40V176c0 0 0-.1 0-.1V160l16 0 136 0c0 0 0 0 .1 0H464c44.2 0 80 35.8 80 80v8zM336 192v56c0 39.8-32.2 72-72 72s-72-32.2-72-72V129.4c-35.9 6.2-65.8 32.3-76 68.2L99.5 255.2 26.3 328.4c-21.9 21.9-21.9 57.3 0 79.2l78.1 78.1c21.9 21.9 57.3 21.9 79.2 0l37.7-37.7c.9 0 1.8 .1 2.7 .1H384c26.5 0 48-21.5 48-48c0-5.6-1-11-2.7-16H432c26.5 0 48-21.5 48-48c0-12.8-5-24.4-13.2-33c25.7-5 45.1-27.6 45.2-54.8v-.4c-.1-30.8-25.1-55.8-56-55.8c0 0 0 0 0 0l-120 0z"/>
                                        </svg>
                                    </span>
                                    @if($customers->customer_additive)
                                        {{ $customers->customer_additive }}
                                    @endif
                                </div>
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 384 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M384 192c0 87.4-117 243-168.3 307.2c-12.3 15.3-35.1 15.3-47.4 0C117 435 0 279.4 0 192C0 86 86 0 192 0S384 86 384 192z"/>
                                        </svg>
                                    </span>
                                    <div class="flex flex-col">
                                        <span>{{ $customers->customer_street }}</span>
                                        <span>{{ $customers->customer_post_code . ' ' . $customers->customer_location }}</span>
                                        <span>@foreach(countryCode() as $country)
                                                @if($country['code'] === $customers->customer_country)
                                                    {{ $country['name'] }}
                                                @endif
                                            @endforeach</span>
                                    </div>
                                </div>
                                @if($customers->customer_vat_numbers)
                                    <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 576 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M0 96l576 0c0-35.3-28.7-64-64-64H64C28.7 32 0 60.7 0 96zm0 32V416c0 35.3 28.7 64 64 64H512c35.3 0 64-28.7 64-64V128H0zM64 405.3c0-29.5 23.9-53.3 53.3-53.3H234.7c29.5 0 53.3 23.9 53.3 53.3c0 5.9-4.8 10.7-10.7 10.7H74.7c-5.9 0-10.7-4.8-10.7-10.7zM176 192a64 64 0 1 1 0 128 64 64 0 1 1 0-128zm176 16c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16zm0 64c0-8.8 7.2-16 16-16H496c8.8 0 16 7.2 16 16s-7.2 16-16 16H368c-8.8 0-16-7.2-16-16z"/>
                                        </svg>
                                    </span> {{ $customers->customer_vat_numbers }}
                                    </div>
                                @endif
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                                        </svg>
                                    </span>
                                    @if($customers->customer_notes)
                                        {!! $customers->customer_notes !!}
                                    @else
                                        <span>-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-11 sm:col-span-5">
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 384 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M16 64C16 28.7 44.7 0 80 0H304c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H80c-35.3 0-64-28.7-64-64V64zM224 448a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM304 64H80V384H304V64z"/>
                                        </svg>
                                    </span> @if($customers->customer_mobil_phone)
                                        <a href="tel:{{ $customers->customer_mobil_phone }}" class="font-semibold">{{ $customers->customer_mobil_phone }}</a>
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M347.1 24.6c7.7-18.6 28-28.5 47.4-23.2l88 24C499.9 30.2 512 46 512 64c0 247.4-200.6 448-448 448c-18 0-33.8-12.1-38.6-29.5l-24-88c-5.3-19.4 4.6-39.7 23.2-47.4l96-40c16.3-6.8 35.2-2.1 46.3 11.6L207.3 368c70.4-33.3 127.4-90.3 160.7-160.7L318.7 167c-13.7-11.2-18.4-30-11.6-46.3l40-96z"/>
                                        </svg>
                                    </span>
                                    <div class="flex flex-col">
                                        @if($customers->customer_phone or $customers->customer_phone_business)
                                            @if($customers->customer_phone)
                                                <a href="tel:{{ $customers->customer_phone }}" class="font-semibold">{{ $customers->customer_phone }}</a>
                                            @endif
                                            @if($customers->customer_phone_business)
                                                <a href="tel:{{ $customers->customer_phone_business }}" class="font-semibold">{{ $customers->customer_phone_business }}</a>
                                            @endif
                                        @else
                                            <span>-</span>
                                        @endif
                                    </div>
                                </div>
                                @if($customers->customer_fax)
                                    <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M128 64v96h64V64H386.7L416 93.3V160h64V93.3c0-17-6.7-33.3-18.7-45.3L432 18.7C420 6.7 403.7 0 386.7 0H192c-35.3 0-64 28.7-64 64zM0 160V480c0 17.7 14.3 32 32 32H64c17.7 0 32-14.3 32-32V160c0-17.7-14.3-32-32-32H32c-17.7 0-32 14.3-32 32zm480 32H128V480c0 17.7 14.3 32 32 32H480c17.7 0 32-14.3 32-32V224c0-17.7-14.3-32-32-32zM256 256a32 32 0 1 1 0 64 32 32 0 1 1 0-64zm96 32a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm32 96a32 32 0 1 1 0 64 32 32 0 1 1 0-64zM224 416a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z"/>
                                        </svg>
                                    </span>
                                        <a href="tel:{{ $customers->customer_fax }}" class="font-semibold">{{ $customers->customer_fax }}</a>
                                    </div>
                                @endif
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                        </svg>
                                    </span> @if($customers->customer_email)
                                        <a href="mailto:{{ $customers->customer_email }}" class="font-semibold">{{ $customers->customer_email }}</a>
                                    @else
                                        -
                                    @endif
                                </div>
                                <div class="flex w-full h-auto items-center">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 448 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M86.4 5.5L61.8 47.6C58 54.1 56 61.6 56 69.2V72c0 22.1 17.9 40 40 40s40-17.9 40-40V69.2c0-7.6-2-15-5.8-21.6L105.6 5.5C103.6 2.1 100 0 96 0s-7.6 2.1-9.6 5.5zm128 0L189.8 47.6c-3.8 6.5-5.8 14-5.8 21.6V72c0 22.1 17.9 40 40 40s40-17.9 40-40V69.2c0-7.6-2-15-5.8-21.6L233.6 5.5C231.6 2.1 228 0 224 0s-7.6 2.1-9.6 5.5zM317.8 47.6c-3.8 6.5-5.8 14-5.8 21.6V72c0 22.1 17.9 40 40 40s40-17.9 40-40V69.2c0-7.6-2-15-5.8-21.6L361.6 5.5C359.6 2.1 356 0 352 0s-7.6 2.1-9.6 5.5L317.8 47.6zM128 176c0-17.7-14.3-32-32-32s-32 14.3-32 32v48c-35.3 0-64 28.7-64 64v71c8.3 5.2 18.1 9 28.8 9c13.5 0 27.2-6.1 38.4-13.4c5.4-3.5 9.9-7.1 13-9.7c1.5-1.3 2.7-2.4 3.5-3.1c.4-.4 .7-.6 .8-.8l.1-.1 0 0 0 0s0 0 0 0s0 0 0 0c3.1-3.2 7.4-4.9 11.9-4.8s8.6 2.1 11.6 5.4l0 0 0 0 .1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c3-3.5 7.4-5.4 12-5.4s9 2 12 5.4l.1 .1c.1 .1 .4 .4 .7 .7c.7 .7 1.7 1.7 3.1 3c2.8 2.6 6.8 6.1 11.8 9.5c10.2 7.1 23 13.1 36.3 13.1s26.1-6 36.3-13.1c5-3.5 9-6.9 11.8-9.5c1.4-1.3 2.4-2.3 3.1-3c.3-.3 .6-.6 .7-.7l.1-.1c2.9-3.4 7.1-5.3 11.6-5.4s8.7 1.6 11.9 4.8l0 0 0 0 0 0 .1 .1c.2 .2 .4 .4 .8 .8c.8 .7 1.9 1.8 3.5 3.1c3.1 2.6 7.5 6.2 13 9.7c11.2 7.3 24.9 13.4 38.4 13.4c10.7 0 20.5-3.9 28.8-9V288c0-35.3-28.7-64-64-64V176c0-17.7-14.3-32-32-32s-32 14.3-32 32v48H256V176c0-17.7-14.3-32-32-32s-32 14.3-32 32v48H128V176zM448 394.6c-8.5 3.3-18.2 5.4-28.8 5.4c-22.5 0-42.4-9.9-55.8-18.6c-4.1-2.7-7.8-5.4-10.9-7.8c-2.8 2.4-6.1 5-9.8 7.5C329.8 390 310.6 400 288 400s-41.8-10-54.6-18.9c-3.5-2.4-6.7-4.9-9.4-7.2c-2.7 2.3-5.9 4.7-9.4 7.2C201.8 390 182.6 400 160 400s-41.8-10-54.6-18.9c-3.7-2.6-7-5.2-9.8-7.5c-3.1 2.4-6.8 5.1-10.9 7.8C71.2 390.1 51.3 400 28.8 400c-10.6 0-20.3-2.2-28.8-5.4V480c0 17.7 14.3 32 32 32H416c17.7 0 32-14.3 32-32V394.6z"/>
                                        </svg>
                                    </span> {{ Carbon::parse($customers->customer_birthday)->format('d.m.Y') ?? '-' }}
                                </div>
                            </div>
                            <div class="col-span-1 sm:col-span-1">
                                <div class="flex justify-end items-center h-5">
                                    <x-ag.button.link class="px-2 text-gray-300 hover:text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise w-4 h-4" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                        </svg>
                                    </x-ag.button.link>
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>

                    {{-- Dokumente --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-[34px] items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    <span class="font-semibold mr-3">Dokumente</span>
                                    <div style="min-width: 1.5rem;" class="rounded-full p-1 w-auto h-6 font-bold bg-gray-900 dark:bg-gray-300 text-white dark:text-black flex justify-center items-center text-sm">
                                        9
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="{{ route('backend.kunden.edit', $customers->id) }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Angebot
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 576 512">
                                            <path d="M312 24V34.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8V232c0 13.3-10.7 24-24 24s-24-10.7-24-24V220.6c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2V24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5H192 32c-17.7 0-32-14.3-32-32V416c0-17.7 14.3-32 32-32H68.8l44.9-36c22.7-18.2 50.9-28 80-28H272h16 64c17.7 0 32 14.3 32 32s-14.3 32-32 32H288 272c-8.8 0-16 7.2-16 16s7.2 16 16 16H392.6l119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384l0 0-.9 0c.3 0 .6 0 .9 0z"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                    <x-ag.button.a-link href="" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Auftrag
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2 -mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                    <x-ag.button.a-link href="" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Rechnung
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 384 512">
                                            <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
                        @if(count($dokumente) > 0)
                        <div class="grid grid-cols-12 gap-4 mb-4">
                            <div class="col-span-12">
                                <hr class="border-t-gray-900 dark:border-t-gray-300">
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4 mb-4 px-2">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex justify-between items-center h-9 w-auto">
                                    <div class="flex justify-center items-center">
                                        <span class="rounded-full p-1 font-bold bg-green-900 text-green-100 dark:bg-green-300 dark:text-green-900 text-sm h-9 w-9 flex justify-center items-center mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" fill="currentColor" viewBox="0 0 512 512">
                                                <path d="M512 80c0 18-14.3 34.6-38.4 48c-29.1 16.1-72.5 27.5-122.3 30.9c-3.7-1.8-7.4-3.5-11.3-5C300.6 137.4 248.2 128 192 128c-8.3 0-16.4 .2-24.5 .6l-1.1-.6C142.3 114.6 128 98 128 80c0-44.2 86-80 192-80S512 35.8 512 80zM160.7 161.1c10.2-.7 20.7-1.1 31.3-1.1c62.2 0 117.4 12.3 152.5 31.4C369.3 204.9 384 221.7 384 240c0 4-.7 7.9-2.1 11.7c-4.6 13.2-17 25.3-35 35.5c0 0 0 0 0 0c-.1 .1-.3 .1-.4 .2l0 0 0 0c-.3 .2-.6 .3-.9 .5c-35 19.4-90.8 32-153.6 32c-59.6 0-112.9-11.3-148.2-29.1c-1.9-.9-3.7-1.9-5.5-2.9C14.3 274.6 0 258 0 240c0-34.8 53.4-64.5 128-75.4c10.5-1.5 21.4-2.7 32.7-3.5zM416 240c0-21.9-10.6-39.9-24.1-53.4c28.3-4.4 54.2-11.4 76.2-20.5c16.3-6.8 31.5-15.2 43.9-25.5V176c0 19.3-16.5 37.1-43.8 50.9c-14.6 7.4-32.4 13.7-52.4 18.5c.1-1.8 .2-3.5 .2-5.3zm-32 96c0 18-14.3 34.6-38.4 48c-1.8 1-3.6 1.9-5.5 2.9C304.9 404.7 251.6 416 192 416c-62.8 0-118.6-12.6-153.6-32C14.3 370.6 0 354 0 336V300.6c12.5 10.3 27.6 18.7 43.9 25.5C83.4 342.6 135.8 352 192 352s108.6-9.4 148.1-25.9c7.8-3.2 15.3-6.9 22.4-10.9c6.1-3.4 11.8-7.2 17.2-11.2c1.5-1.1 2.9-2.3 4.3-3.4V304v5.7V336zm32 0V304 278.1c19-4.2 36.5-9.5 52.1-16c16.3-6.8 31.5-15.2 43.9-25.5V272c0 10.5-5 21-14.9 30.9c-16.3 16.3-45 29.7-81.3 38.4c.1-1.7 .2-3.5 .2-5.3zM192 448c56.2 0 108.6-9.4 148.1-25.9c16.3-6.8 31.5-15.2 43.9-25.5V432c0 44.2-86 80-192 80S0 476.2 0 432V396.6c12.5 10.3 27.6 18.7 43.9 25.5C83.4 438.6 135.8 448 192 448z"/>
                                            </svg>
                                        </span>
                                        <span>Umsatz</span>
                                    </div>
                                    <div class="font-bold">{{ $sales_volume }}</div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex justify-between items-center h-9 w-auto">
                                    <div class="flex justify-center items-center">
                                        <span class="rounded-full p-1 font-bold bg-orange-900 text-orange-100 dark:bg-orange-300 dark:text-orange-900 text-sm h-9 w-9 flex justify-center items-center mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16px" fill="currentColor" viewBox="0 0 384 512">
                                                <path d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z"/>
                                            </svg>
                                        </span>
                                        <span>Offene Zahlungen</span>
                                    </div>
                                    <div class="font-bold">{{ $outstanding_payments }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.table.table>
                                    <x-slot:thead>
                                        <x-ag.table.th>Status</x-ag.table.th>
                                        <x-ag.table.th>Nummer</x-ag.table.th>
                                        <x-ag.table.th>Datum</x-ag.table.th>
                                        <x-ag.table.th>Fahrzeug</x-ag.table.th>
                                        <x-ag.table.th class="text-right">Summe</x-ag.table.th>
                                        <x-ag.table.th class="w-8"></x-ag.table.th>
                                    </x-slot:thead>
                                    <x-slot:tbody>
                                        @foreach($dokumente as $dokument)
                                        <x-ag.table.tr>
                                            <td class="px-2 py-1 cursor-pointer text-sm" wire:click="">
                                                @if($dokument['status'] === 'Angebot')
                                                    <div class="inline-flex items-center bg-yellow-100 text-yellow-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" fill="currentColor" class="mr-2" viewBox="0 0 576 512">
                                                            <path d="M312 24V34.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8V232c0 13.3-10.7 24-24 24s-24-10.7-24-24V220.6c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2V24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5H192 32c-17.7 0-32-14.3-32-32V416c0-17.7 14.3-32 32-32H68.8l44.9-36c22.7-18.2 50.9-28 80-28H272h16 64c17.7 0 32 14.3 32 32s-14.3 32-32 32H288 272c-8.8 0-16 7.2-16 16s7.2 16 16 16H392.6l119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384l0 0-.9 0c.3 0 .6 0 .9 0z"/>
                                                        </svg>
                                                        <span>{{ __($dokument['status']) }}</span>
                                                    </div>
                                                @elseif($dokument['status'] === 'Auftrag')
                                                    <div class="inline-flex items-center bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z"/>
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z"/>
                                                        </svg>
                                                        <span>{{ __($dokument['status']) }}</span>
                                                    </div>
                                                @elseif($dokument['status'] === 'not_paid')
                                                    <div class="inline-flex items-center bg-orange-100 text-orange-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" fill="currentColor" viewBox="0 0 384 512" class="mr-2">
                                                            <path d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z"/>
                                                        </svg>
                                                        <span>{{ __($dokument['status']) }}</span>
                                                    </div>
                                                @elseif($dokument['status'] === 'paid')
                                                    <div class="inline-flex items-center bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-3 h-3 mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                        </svg>
                                                        <span>{{ __($dokument['status']) }}</span>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-2 py-1 cursor-pointer text-sm" wire:click="">{{ $dokument['nummer'] }}</td>
                                            <td class="px-2 py-1 cursor-pointer text-sm" wire:click="">{{ $dokument['datum'] }}</td>
                                            <td class="px-2 py-1 cursor-pointer text-sm" wire:click="">{!! $dokument['fahrzeug'] !!}</td>
                                            <td class="px-2 py-1 cursor-pointer text-sm text-right" wire:click="">{{ $dokument['total'] }}</td>
                                            <td class="p-1"></td>
                                        </x-ag.table.tr>
                                        @endforeach
                                    </x-slot:tbody>
                                </x-ag.table.table>
                            </div>
                        </div>
                        @endif
                    </x-ag.card.head>
                </div>
                {{-- Rechts --}}
                <div class="col-span-1">
                    {{-- Fahrzeuge --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4 mb-2">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-[34px] items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-car-front mr-3" viewBox="0 0 16 16">
                                        <path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM4.862 4.276 3.906 6.19a.51.51 0 0 0 .497.731c.91-.073 2.35-.17 3.597-.17 1.247 0 2.688.097 3.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 10.691 4H5.309a.5.5 0 0 0-.447.276Z"/>
                                        <path d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM4.82 3a1.5 1.5 0 0 0-1.379.91l-.792 1.847a1.8 1.8 0 0 1-.853.904.807.807 0 0 0-.43.564L1.03 8.904a1.5 1.5 0 0 0-.03.294v.413c0 .796.62 1.448 1.408 1.484 1.555.07 3.786.155 5.592.155 1.806 0 4.037-.084 5.592-.155A1.479 1.479 0 0 0 15 9.611v-.413c0-.099-.01-.197-.03-.294l-.335-1.68a.807.807 0 0 0-.43-.563 1.807 1.807 0 0 1-.853-.904l-.792-1.848A1.5 1.5 0 0 0 11.18 3H4.82Z"/>
                                    </svg>
                                    <span class="font-semibold mr-3">Fahrzeuge</span>
                                    <div style="min-width: 1.5rem;" class="rounded-full p-1 w-auto h-6 font-bold bg-gray-900 dark:bg-gray-300 text-white dark:text-black flex justify-center items-center text-sm">
                                        {{ $fahrzeuge->count() }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="{{ route('backend.fahrzeuge.create') }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Fahrzeug
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12">
                            @if(count($fahrzeuge) > 0)
                                @foreach($fahrzeuge as $fahrzeug)
                                    <div wire:click="showFahrzeuge({{ $fahrzeug->id }})" class="cursor-pointer col-span-12 p-2 odd:bg-gray-100 dark:odd:bg-gray-900 dark:odd:border-gray-700 even:bg-gray-50 dark:even:bg-gray-800 dark:even:border-gray-700">
                                        {{ $fahrzeug->vehicles_brand. ' ' . $fahrzeug->vehicles_model. ' ' . $fahrzeug->vehicles_type }}<br>
                                        <div class="flex justify-between items-center pt-2">
                                            @if($fahrzeug->vehicles_license_plate) <span>{{ $fahrzeug->vehicles_license_plate }}</span> @else <span>kein Kennzeichen</span> @endif
                                            @if($fahrzeug->vehicles_first_registration) <span>{{ Carbon::parse($fahrzeug->vehicles_first_registration)->format('d.m.Y') }}</span> @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </x-ag.card.head>

                    {{-- Termine --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-[34px] items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z"/>
                                    </svg>
                                    <span class="font-semibold mr-3">Termine</span>
                                    <div style="min-width: 1.5rem;" class="rounded-full p-1 w-auto h-6 font-bold bg-gray-900 dark:bg-gray-300 text-white dark:text-black flex justify-center items-center text-sm">
                                        {{ $termine }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Termine
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>

                    {{-- Dateien --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-[34px] items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 00-1.883 2.542l.857 6a2.25 2.25 0 002.227 1.932H19.05a2.25 2.25 0 002.227-1.932l.857-6a2.25 2.25 0 00-1.883-2.542m-16.5 0V6A2.25 2.25 0 016 3.75h3.879a1.5 1.5 0 011.06.44l2.122 2.12a1.5 1.5 0 001.06.44H18A2.25 2.25 0 0120.25 9v.776"/>
                                    </svg>
                                    <span class="font-semibold mr-3">Dateien</span>
                                    <div style="min-width: 1.5rem;" class="rounded-full p-1 w-auto h-6 font-bold bg-gray-900 dark:bg-gray-300 text-white dark:text-black flex justify-center items-center text-sm">
                                        {{ $dateien }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        Datei
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
            </div>
        </div>
    </x-ag.main.head>
</div>
