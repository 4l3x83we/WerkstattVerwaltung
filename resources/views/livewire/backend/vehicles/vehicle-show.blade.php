@php use Carbon\Carbon; @endphp
<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('vehiclesShow', $fahrzeuge) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ $fahrzeuge->vehicles_brand . ' ' . $fahrzeuge->vehicles_model }}</h1>
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">
            <div class="grid grid-cols-1 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
                {{-- Links --}}
                <div class="col-span-2">
                    {{-- Fahrzeugdaten --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4 text-sm">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="w-full h-auto car-bg">
                                    <span>{{ $fahrzeuge->vehicles_license_plate }}</span><br>
                                    <div class="text-gray-900 dark:text-gray-300 text-xl font-semibold leading-none mb-2">{{ $fahrzeuge->vehicles_brand . ' ' . $fahrzeuge->vehicles_model }}</div>
                                    <div class="text-sm ml-4 mb-2">{{ $fahrzeuge->vehicles_type }}</div>
                                    <div class="inline-flex items-center font-semibold text-orange-200 dark:text-orange-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                          <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM3.751 20.105a8.25 8.25 0 0116.498 0 .75.75 0 01-.437.695A18.683 18.683 0 0112 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 01-.437-.695z" clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-4">{{ $customers->fullname() }}</div>
                                    </div>
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
                                    @if($history)
                                        <x-ag.button.a-link wire:click="history({{ $customers->id }})" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise w-4 h-4" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                                            </svg>
                                        </x-ag.button.a-link>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-12">
                                <hr class="border-t-gray-900 dark:border-t-gray-300">
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class=" flex w-full h-auto items-center mb-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 576 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M256 32H181.2c-27.1 0-51.3 17.1-60.3 42.6L3.1 407.2C1.1 413 0 419.2 0 425.4C0 455.5 24.5 480 54.6 480H256V416c0-17.7 14.3-32 32-32s32 14.3 32 32v64H521.4c30.2 0 54.6-24.5 54.6-54.6c0-6.2-1.1-12.4-3.1-18.2L455.1 74.6C446 49.1 421.9 32 394.8 32H320V96c0 17.7-14.3 32-32 32s-32-14.3-32-32V32zm64 192v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32s32 14.3 32 32z"/>
                                        </svg>
                                    </span>
                                    <div>Laufleistung</div>
                                    <div class="text-right w-full mr-1">
                                        @if($fahrzeuge->vehicles_mileage)
                                            {{ $fahrzeuge->vehicles_mileage }}
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">&nbsp;</span>
                                    <div class="w-1/2 text-xs">HSN/TSN</div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->vehicles_hsn and $fahrzeuge->vehicles_tsn)
                                            {{ $fahrzeuge->vehicles_hsn . ' / ' . $fahrzeuge->vehicles_tsn }}
                                        @endif
                                    </div>
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">&nbsp;</span>
                                    <div class="w-1/2 text-xs">FIN</div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->vehicles_identification_number)
                                            {{ $fahrzeuge->vehicles_identification_number  }}
                                        @endif
                                    </div>
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M135.2 117.4L109.1 192H402.9l-26.1-74.6C372.3 104.6 360.2 96 346.6 96H165.4c-13.6 0-25.7 8.6-30.2 21.4zM39.6 196.8L74.8 96.3C88.3 57.8 124.6 32 165.4 32H346.6c40.8 0 77.1 25.8 90.6 64.3l35.2 100.5c23.2 9.6 39.6 32.5 39.6 59.2V400v48c0 17.7-14.3 32-32 32H448c-17.7 0-32-14.3-32-32V400H96v48c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32V400 256c0-26.7 16.4-49.6 39.6-59.2zM128 288a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zm288 32a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/>
                                        </svg>
                                    </span>
                                    <div class="w-1/2">
                                        @if($fahrzeuge->catClass())
                                            {{ $fahrzeuge->catClass() }}
                                        @endif
                                    </div>
                                    <div class="text-right w-1/2 mr-1"></div>
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 640 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M308.5 135.3c7.1-6.3 9.9-16.2 6.2-25c-2.3-5.3-4.8-10.5-7.6-15.5L304 89.4c-3-5-6.3-9.9-9.8-14.6c-5.7-7.6-15.7-10.1-24.7-7.1l-28.2 9.3c-10.7-8.8-23-16-36.2-20.9L199 27.1c-1.9-9.3-9.1-16.7-18.5-17.8C173.9 8.4 167.2 8 160.4 8h-.7c-6.8 0-13.5 .4-20.1 1.2c-9.4 1.1-16.6 8.6-18.5 17.8L115 56.1c-13.3 5-25.5 12.1-36.2 20.9L50.5 67.8c-9-3-19-.5-24.7 7.1c-3.5 4.7-6.8 9.6-9.9 14.6l-3 5.3c-2.8 5-5.3 10.2-7.6 15.6c-3.7 8.7-.9 18.6 6.2 25l22.2 19.8C32.6 161.9 32 168.9 32 176s.6 14.1 1.7 20.9L11.5 216.7c-7.1 6.3-9.9 16.2-6.2 25c2.3 5.3 4.8 10.5 7.6 15.6l3 5.2c3 5.1 6.3 9.9 9.9 14.6c5.7 7.6 15.7 10.1 24.7 7.1l28.2-9.3c10.7 8.8 23 16 36.2 20.9l6.1 29.1c1.9 9.3 9.1 16.7 18.5 17.8c6.7 .8 13.5 1.2 20.4 1.2s13.7-.4 20.4-1.2c9.4-1.1 16.6-8.6 18.5-17.8l6.1-29.1c13.3-5 25.5-12.1 36.2-20.9l28.2 9.3c9 3 19 .5 24.7-7.1c3.5-4.7 6.8-9.5 9.8-14.6l3.1-5.4c2.8-5 5.3-10.2 7.6-15.5c3.7-8.7 .9-18.6-6.2-25l-22.2-19.8c1.1-6.8 1.7-13.8 1.7-20.9s-.6-14.1-1.7-20.9l22.2-19.8zM112 176a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zM504.7 500.5c6.3 7.1 16.2 9.9 25 6.2c5.3-2.3 10.5-4.8 15.5-7.6l5.4-3.1c5-3 9.9-6.3 14.6-9.8c7.6-5.7 10.1-15.7 7.1-24.7l-9.3-28.2c8.8-10.7 16-23 20.9-36.2l29.1-6.1c9.3-1.9 16.7-9.1 17.8-18.5c.8-6.7 1.2-13.5 1.2-20.4s-.4-13.7-1.2-20.4c-1.1-9.4-8.6-16.6-17.8-18.5L583.9 307c-5-13.3-12.1-25.5-20.9-36.2l9.3-28.2c3-9 .5-19-7.1-24.7c-4.7-3.5-9.6-6.8-14.6-9.9l-5.3-3c-5-2.8-10.2-5.3-15.6-7.6c-8.7-3.7-18.6-.9-25 6.2l-19.8 22.2c-6.8-1.1-13.8-1.7-20.9-1.7s-14.1 .6-20.9 1.7l-19.8-22.2c-6.3-7.1-16.2-9.9-25-6.2c-5.3 2.3-10.5 4.8-15.6 7.6l-5.2 3c-5.1 3-9.9 6.3-14.6 9.9c-7.6 5.7-10.1 15.7-7.1 24.7l9.3 28.2c-8.8 10.7-16 23-20.9 36.2L315.1 313c-9.3 1.9-16.7 9.1-17.8 18.5c-.8 6.7-1.2 13.5-1.2 20.4s.4 13.7 1.2 20.4c1.1 9.4 8.6 16.6 17.8 18.5l29.1 6.1c5 13.3 12.1 25.5 20.9 36.2l-9.3 28.2c-3 9-.5 19 7.1 24.7c4.7 3.5 9.5 6.8 14.6 9.8l5.4 3.1c5 2.8 10.2 5.3 15.5 7.6c8.7 3.7 18.6 .9 25-6.2l19.8-22.2c6.8 1.1 13.8 1.7 20.9 1.7s14.1-.6 20.9-1.7l19.8 22.2zM464 304a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                                        </svg>
                                    </span>
                                    <div class="w-1/2 text-xs">Getriebeart</div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->transmission())
                                            {{ $fahrzeuge->transmission() }}
                                        @endif
                                    </div>
                                </div>
                                @if($fahrzeuge->vehicles_note)
                                <hr class="my-2">
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                                        </svg>
                                    </span>
                                        {!! $fahrzeuge->vehicles_note !!}
                                </div>
                                @endif
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class=" flex w-full h-auto items-center mb-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M224 96a32 32 0 1 1 64 0 32 32 0 1 1 -64 0zm122.5 32c3.5-10 5.5-20.8 5.5-32c0-53-43-96-96-96s-96 43-96 96c0 11.2 1.9 22 5.5 32H120c-22 0-41.2 15-46.6 36.4l-72 288c-3.6 14.3-.4 29.5 8.7 41.2S33.2 512 48 512H464c14.8 0 28.7-6.8 37.8-18.5s12.3-26.8 8.7-41.2l-72-288C433.2 143 414 128 392 128H346.5z"/>
                                        </svg>
                                    </span>
                                    <div class="w-1/2">
                                        @if($fahrzeuge->vehicleFurtherData->vehicles_curb_weight)
                                            {{ $fahrzeuge->vehicleFurtherData->vehicles_curb_weight . ' kg' }}
                                        @endif
                                    </div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->vehicleFurtherData->vehicles_total_weight)
                                            <span class="text-xs">max.</span> {{ $fahrzeuge->vehicleFurtherData->vehicles_total_weight .' kg' }}
                                        @endif
                                    </div>
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 h-5 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 576 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M256 32H181.2c-27.1 0-51.3 17.1-60.3 42.6L3.1 407.2C1.1 413 0 419.2 0 425.4C0 455.5 24.5 480 54.6 480H256V416c0-17.7 14.3-32 32-32s32 14.3 32 32v64H521.4c30.2 0 54.6-24.5 54.6-54.6c0-6.2-1.1-12.4-3.1-18.2L455.1 74.6C446 49.1 421.9 32 394.8 32H320V96c0 17.7-14.3 32-32 32s-32-14.3-32-32V32zm64 192v64c0 17.7-14.3 32-32 32s-32-14.3-32-32V224c0-17.7 14.3-32 32-32s32 14.3 32 32z"/>
                                        </svg>
                                    </span>
                                    <div class="w-1/2">
                                        @if($fahrzeuge->vehicles_kw and $fahrzeuge->vehicles_hp)
                                            {{ $fahrzeuge->vehicles_kw . ' kW / ' . $fahrzeuge->vehicles_hp . 'PS' }}
                                        @endif
                                    </div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->vehicles_cubic_capacity)
                                            <span class="text-xs">Hubraum</span> {{ $fahrzeuge->vehicles_cubic_capacity .' cm³' }}
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class=" flex w-full h-auto items-center my-1">
                                    @if($fahrzeuge->vehicles_hu < now())
                                    <x-ag.badge color="orange-sm" style="display: inline-flex; align-items: center; width: 100%;">
                                        <span class="inline-flex mr-2 justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor">
                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336h24V272H216c-13.3 0-24-10.7-24-24s10.7-24 24-24h48c13.3 0 24 10.7 24 24v88h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H216c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z"/>
                                            </svg>
                                        </span>
                                        <div class="w-1/2 text-xs">
                                            Nächste Überprüfung (TÜV)
                                        </div>
                                        <div class="text-right w-1/2 mr-1">
                                            {{ Carbon::parse($fahrzeuge->vehicles_hu)->format('d.m.Y') }}
                                        </div>
                                    </x-ag.badge>
                                    @else
                                    <x-ag.badge color="green-sm" style="display: inline-flex; align-items: center; width: 100%;">
                                        <span class="inline-flex mr-2 justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor">
                                                <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                                            </svg>
                                        </span>
                                        <div class="w-1/2 text-xs">
                                            Nächste Überprüfung (TÜV)
                                        </div>
                                        <div class="text-right w-1/2 mr-1">
                                            {{ Carbon::parse($fahrzeuge->vehicles_hu)->format('d.m.Y') }}
                                        </div>
                                    </x-ag.badge>
                                    @endif
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="12px" viewBox="0 0 512 512" fill="currentColor" class="text-gray-900 dark:text-gray-300">
                                            <path d="M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zm64 80v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm128 0v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H208c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V272c0-8.8-7.2-16-16-16H336zM64 400v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H80c-8.8 0-16 7.2-16 16zm144-16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H208zm112 16v32c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16V400c0-8.8-7.2-16-16-16H336c-8.8 0-16 7.2-16 16z"/>
                                        </svg>
                                    </span>
                                    <div class="w-1/2 text-xs">
                                        Erstzulassung
                                    </div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->firstReg())
                                            {{ $fahrzeuge->firstReg() }}
                                        @endif
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 justify-center items-center">&nbsp;</span>
                                    <div class="w-1/2 text-xs">
                                        Kraftstoff
                                    </div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->fuel())
                                            {{ $fahrzeuge->fuel() }}
                                        @endif
                                    </div>
                                </div>
                                <div class=" flex w-full h-auto items-center my-1">
                                    <span class="inline-flex mr-1 w-8 justify-center items-center">&nbsp;</span>
                                    <div class="w-1/2 text-xs">
                                        Motor-Code
                                    </div>
                                    <div class="text-right w-1/2 mr-1">
                                        @if($fahrzeuge->vehicles_engine_code)
                                            {{ $fahrzeuge->vehicles_engine_code }}
                                        @endif
                                    </div>
                                </div>
                                @if($fahrzeuge->vehicleFurtherData->vehicles_color or $fahrzeuge->vehicleFurtherData->vehicles_color_code or $fahrzeuge->vehicleFurtherData->vehicles_upholstery_color or $fahrzeuge->vehicleFurtherData->vehicles_upholstery_type or $fahrzeuge->vehicleFurtherData->vehicles_radio_code)
                                    <hr class="my-2">
                                    @if($fahrzeuge->vehicleFurtherData->vehicles_color or $fahrzeuge->vehicleFurtherData->vehicles_color_code)
                                    <div class=" flex w-full h-auto items-center my-1">
                                        <span class="inline-flex mr-1 w-8 justify-center items-center">&nbsp;</span>
                                        <div class="w-1/2 text-xs">
                                            Farbe / Farb-Code
                                        </div>
                                        <div class="text-right w-1/2 mr-1">
                                                {{ $fahrzeuge->vehicleFurtherData->vehicles_color }} @if($fahrzeuge->vehicleFurtherData->vehicles_color_code) {{ ' / ' . $fahrzeuge->vehicleFurtherData->vehicles_color_code }} @endif
                                        </div>
                                    </div>
                                    @endif
                                    @if($fahrzeuge->vehicleFurtherData->vehicles_upholstery_color or $fahrzeuge->vehicleFurtherData->vehicles_upholstery_type)
                                        <div class=" flex w-full h-auto items-center my-1">
                                        <span class="inline-flex mr-1 w-8 justify-center items-center">&nbsp;</span>
                                        <div class="w-1/2 text-xs">
                                            Polsterfarbe / Polsterart
                                        </div>
                                        <div class="text-right w-1/2 mr-1">
                                            {{ $fahrzeuge->vehicleFurtherData->vehicles_upholstery_color }} @if($fahrzeuge->vehicleFurtherData->vehicles_upholstery_type) {{ ' / ' . $fahrzeuge->vehicleFurtherData->vehicles_upholstery_type }} @endif
                                        </div>
                                    </div>
                                    @endif
                                    @if($fahrzeuge->vehicleFurtherData->vehicles_radio_code)
                                    <div class=" flex w-full h-auto items-center my-1">
                                        <span class="inline-flex mr-1 w-8 justify-center items-center">&nbsp;</span>
                                        <div class="w-1/2 text-xs">
                                            Radio-Code
                                        </div>
                                        <div class="text-right w-1/2 mr-1">
                                                {{ $fahrzeuge->vehicleFurtherData->vehicles_radio_code }}
                                        </div>
                                    </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </x-ag.card.head>

                    {{-- Dokumente --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex w-full h-[34px] items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>
                                    </svg>
                                    <span class="font-semibold mr-3">Dokumente</span>
                                    <div style="min-width: 1.5rem;" class="rounded-full p-1 w-auto h-6 font-bold bg-gray-900 dark:bg-gray-300 text-white dark:text-black flex justify-center items-center text-sm">
                                        {{ count($dokumente) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="flex items-start justify-start sm:items-end sm:justify-end gap-2">
                                    <x-ag.button.a-link href="{{ route('backend.angebote.create') }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Angebot
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 576 512">
                                            <path d="M312 24V34.5c6.4 1.2 12.6 2.7 18.2 4.2c12.8 3.4 20.4 16.6 17 29.4s-16.6 20.4-29.4 17c-10.9-2.9-21.1-4.9-30.2-5c-7.3-.1-14.7 1.7-19.4 4.4c-2.1 1.3-3.1 2.4-3.5 3c-.3 .5-.7 1.2-.7 2.8c0 .3 0 .5 0 .6c.2 .2 .9 1.2 3.3 2.6c5.8 3.5 14.4 6.2 27.4 10.1l.9 .3 0 0c11.1 3.3 25.9 7.8 37.9 15.3c13.7 8.6 26.1 22.9 26.4 44.9c.3 22.5-11.4 38.9-26.7 48.5c-6.7 4.1-13.9 7-21.3 8.8V232c0 13.3-10.7 24-24 24s-24-10.7-24-24V220.6c-9.5-2.3-18.2-5.3-25.6-7.8c-2.1-.7-4.1-1.4-6-2c-12.6-4.2-19.4-17.8-15.2-30.4s17.8-19.4 30.4-15.2c2.6 .9 5 1.7 7.3 2.5c13.6 4.6 23.4 7.9 33.9 8.3c8 .3 15.1-1.6 19.2-4.1c1.9-1.2 2.8-2.2 3.2-2.9c.4-.6 .9-1.8 .8-4.1l0-.2c0-1 0-2.1-4-4.6c-5.7-3.6-14.3-6.4-27.1-10.3l-1.9-.6c-10.8-3.2-25-7.5-36.4-14.4c-13.5-8.1-26.5-22-26.6-44.1c-.1-22.9 12.9-38.6 27.7-47.4c6.4-3.8 13.3-6.4 20.2-8.2V24c0-13.3 10.7-24 24-24s24 10.7 24 24zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5H192 32c-17.7 0-32-14.3-32-32V416c0-17.7 14.3-32 32-32H68.8l44.9-36c22.7-18.2 50.9-28 80-28H272h16 64c17.7 0 32 14.3 32 32s-14.3 32-32 32H288 272c-8.8 0-16 7.2-16 16s7.2 16 16 16H392.6l119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384l0 0-.9 0c.3 0 .6 0 .9 0z"/>
                                        </svg>
                                    </x-ag.button.a-link>
{{--                                    <x-ag.button.a-link href="{{ route('backend.auftraege.create') }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">--}}
                                    <x-ag.button.a-link wire:click="createOrder({{ $customers->id }})" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Auftrag
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2 -mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75a4.5 4.5 0 01-4.884 4.484c-1.076-.091-2.264.071-2.95.904l-7.152 8.684a2.548 2.548 0 11-3.586-3.586l8.684-7.152c.833-.686.995-1.874.904-2.95a4.5 4.5 0 016.336-4.486l-3.276 3.276a3.004 3.004 0 002.25 2.25l3.276-3.276c.256.565.398 1.192.398 1.852z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.867 19.125h.008v.008h-.008v-.008z"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                    <x-ag.button.a-link href="{{ route('backend.rechnung.create') }}" class="py-1.5 px-2.5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                                        Rechnung
                                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" fill="currentColor" class="w-5 h-5 ml-2 -mr-1" viewBox="0 0 384 512">
                                            <path d="M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM80 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H80c-8.8 0-16-7.2-16-16s7.2-16 16-16zm16 96H288c17.7 0 32 14.3 32 32v64c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm0 32v64H288V256H96zM240 416h64c8.8 0 16 7.2 16 16s-7.2 16-16 16H240c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                                        </svg>
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
                        @if(count($dokumente) > 0)
                            <div class="grid grid-cols-12 gap-4 my-4">
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
                                            @foreach($dokumente as $key => $dokument)
                                                <x-ag.table.tr wire:click="showInvoice({{ $key }})">
                                                    <td class="px-2 py-1 cursor-pointer text-sm">
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
                                                    <td class="px-2 py-1 cursor-pointer text-sm">{{ $dokument['nummer'] }}</td>
                                                    <td class="px-2 py-1 cursor-pointer text-sm">{{ $dokument['datum'] }}</td>
                                                    <td class="px-2 py-1 cursor-pointer text-sm">{!! $dokument['fahrzeug'] !!}</td>
                                                    <td class="px-2 py-1 cursor-pointer text-sm text-right">{{ $dokument['total'] }}</td>
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

                    {{-- Reifenlager --}}
                    {{--<x-ag.card.head>
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
                    </x-ag.card.head>--}}
                </div>
            </div>
        </div>
    </x-ag.main.head>
</div>
