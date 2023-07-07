<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('orderEdit', $order) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Auftrag bearbeiten ({{ $order->order_nr }})</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    {{--<x-ag.main.head>
        --}}{{-- Orders --}}{{--
        <form wire:submit.prevent="store" method="POST" class="p-4">
            <input type="hidden" name="invoices.id">
            <input type="hidden" name="invoices.order_nr">
            <div class="grid grid-cols-1 xl:grid-cols-12 xl:gap-4 dark:bg-gray-900">
                --}}{{-- Left --}}{{--
                @include('livewire.backend.office.invoice.customer-fields')
                --}}{{-- Right --}}{{--
            </div>
            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 sm:col-full"></div>
                        <div class="col-span-6 sm:col-full">
                            <div class="flex items-center justify-end space-x-1">
                                <x-ag.button.loading-button text="Speichern" class=""/>
                                <x-ag.button.a-link href="{{ route('backend.rechnung.index') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Abbrechen
                                </x-ag.button.a-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-ag.main.head>--}}

    <x-ag.main.head>
        {{-- Orders --}}
        <form wire:submit.prevent="store" method="POST" class="p-4">
            <input type="hidden" name="invoices.id">
            <input type="hidden" name="invoices.order_nr">
            <div class="grid grid-cols-1 xl:grid-cols-12 xl:gap-4 dark:bg-gray-900">
                <div class="col-span-10">
                    <x-ag.card.head>
                        <div class="w-2/3">
                            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                                <li class="flex md:w-full items-center text-orange-600 dark:text-orange-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                                        <span class="mr-2">1</span> Auftrag
                                    </span>
                                </li>
                                <li class="flex md:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                                    <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                                        <span class="mr-2">2</span> Entwurf
                                    </span>
                                </li>
                                <li class="flex items-center">
                                    <span class="mr-2">3</span> Rechnung
                                </li>
                            </ol>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-label-input id="order.order_nr" text="Auftrags-Nr." readonly/>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-label-input type="date" id="order.order_date" text="Datum" readonly/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-select id="customer.id" text="Kundenummer" disabled>
                                    <option value="null">bitte Auswählen</option>
                                    @foreach($customers as $item)
                                        <option value="{{ $item->id }}">{{ '(' . $item->customer_kdnr . ') ' . $item->customer_firstname . ' ' . $item->customer_lastname }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                @if($address)
                                    <x-ag.forms.label text="Rechnungsadresse"/>
                                    <span class="text-sm">{!! $address !!}</span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-select id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr. des Kunden" disabled>
                                    <option value="null">bitte Auswählen</option>
                                    @foreach($vehicles as $item)
                                        <option value="{{ $item->id }}">{{ '('.$item->vehicles_license_plate.') '.$item->vehicles_brand . ' ' . $item->vehicles_model . ' ' . $item->vehicles_type . ' (EZ: ' . $item->firstReg() . ')' }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                @if($fahrzeugSelect)
                                    <div class="flex flex-col sm:flex-row gap-2">
                                        <div class="w-full sm:w-1/3">
                                            <x-ag.forms.label text="Fahrzeug"/>
                                            <span class="text-sm">{!! $fahrzeugSelect['fahrzeug'] !!}</span>
                                        </div>
                                        <div class="w-full sm:w-1/3">
                                            <x-ag.forms.label for="fahrzeuge.vehicles_mileage" text="Laufleistung"/>
                                            <span class="text-sm">
                                                <x-ag.forms.igr id="fahrzeuge.vehicles_mileage" text="Laufleistung" icon="km" />
                                            </span>
                                        </div>
                                        <div class="w-full sm:w-1/3">
                                            <x-ag.forms.label text="Nächste Überprüfung (TÜV)"/>
                                            <span class="text-sm">{!! $fahrzeugSelect['tuev'] !!}</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.textarea id="order.invoice_notes_1" rows="5" text="Auftragstext"/>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.textarea id="order.invoice_notes_2" rows="5" text="Rechnungstext"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-label-input type="date" id="order.delivery_performance_date" text="Liefer-/ Leistungsdatum"/>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <x-ag.forms.inline-select id="order.invoice_clerk" text="Sachbearbeiter/in">
                                    @foreach(auth()->user()->admin() as $billing)
                                        <option value="{{ $billing->name }}">{{ $billing->name }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                        </div>

                    </x-ag.card.head>
                </div>

                <div class="col-span-2">
                    <x-ag.card.head>
                        <div class="space-y-2">
                            @livewire('backend.office.invoice.draft.draft', ['order' => $order])
                            @livewire('backend.office.invoice.complete.complete', ['order' => $order])
                            @livewire('backend.office.invoice.copy.copy', ['order' => $order])

                            <x-ag.button.button class="w-full justify-center" wire:click="deposit({{ $order->id }})">Anzahlung</x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center !text-red-700 !border-red-700 !hover:bg-red-800 !focus:ring-red-300 !dark:border-red-500 !dark:text-red-500 !dark:hover:bg-red-600 !dark:focus:ring-red-900" wire:click="remove({{ $order->id }})">Auftrag Löschen</x-ag.button.button>
                        </div>
                        <hr class="my-2">
                        <span class="text-xs">Auftrag</span>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </x-ag.button.button>
                        </div>
                        <span class="text-xs">Arbeitsauftrag</span>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </x-ag.button.button>
                        </div>
                        <span class="text-xs">Entwurf</span>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                            </x-ag.button.button>
                        </div>
                    </x-ag.card.head>
                </div>

            </div>

            {{-- Positionen --}}
            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6"></div>
                            <div class="col-span-6">
                                <x-ag.button.button wire:click.prevent="addProduct">Neues Produkt</x-ag.button.button>
                            </div>
                            <div class="col-span-12">
                                <div class="relative overflow-x-auto overflow-y-hidden">
                                    <x-ag.table.table>
                                        <x-slot:thead>
                                            <x-ag.table.th class="min-w-[40px]">Pos</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[200px]">Artikel-Nr.</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[335px]">Bezeichnung</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[335px]">Beschreibung</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[100px]">Menge</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[120px] text-right">E.-Preis</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[100px] text-right">Rabatt</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[120px] text-right">Summe</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[100px]"></x-ag.table.th>
                                        </x-slot:thead>
                                        <x-slot:tbody>
                                            @foreach($invoiceDetails as $index => $invoiceDetail)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2">{{ $index + 1 }}</td>
                                                    <td class="p-2">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_id"/>
                                                            @if($invoiceDetail['product_artnr'])
                                                                {{ $invoiceDetail['product_artnr'] }}
                                                            @endif
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].id"/>
                                                        @else
                                                            <x-ag.forms.input id="product.product_art_nr" text="Artikelnummer" autofocus/>
                                                        @endif
                                                    </td>
                                                    <td class="p-2">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_name"/>
                                                            @if($invoiceDetail['product_name'])
                                                                {{ $invoiceDetail['product_name'] }}
                                                            @endif
                                                        @else
                                                            {{ $product['product_name'] ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td class="p-2">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_desc"/>
                                                            @if($invoiceDetail['product_desc'])
                                                                {{ $invoiceDetail['product_desc'] }}
                                                            @endif
                                                        @else
                                                            {{ $product['product_desc'] ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td class="p-2">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].qty"/>
                                                            @if($invoiceDetail['qty'])
                                                                {{ $invoiceDetail['qty'] }}
                                                            @endif
                                                        @else
                                                            <x-ag.forms.input type="number" id="product.qty" text="Menge"/>
                                                        @endif
                                                    </td>
                                                    <td class="p-2 text-right">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].price"/>
                                                            @if($invoiceDetail['price'])
                                                                {{ number_format($invoiceDetail['price'], 2) . ' €' }}
                                                            @endif
                                                        @else
                                                            {{ number_format($product['price'] ?? 0, 2) . ' €' }}
                                                        @endif
                                                    </td>
                                                    <td class="p-2 text-right">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].discountPercent"/>
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].discount"/>
                                                            @if($invoiceDetail['discount'] > 0)
                                                                {{ number_format($invoiceDetail['discount'], 2) . ' €' }}
                                                            @endif
                                                        @else
                                                            <x-ag.forms.igr type="number" id="product.discountPercent" text="Rabatt" icon="%"/>
                                                        @endif</td>
                                                    <td class="p-2 text-right">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].subtotal"/>
                                                            @if($invoiceDetail['subtotal'])
                                                                {{ number_format($invoiceDetail['subtotal'], 2) . ' €' }}
                                                            @endif
                                                        @else
                                                            {{ number_format($product['subtotal'] ?? 0, 2) . ' €' }}
                                                        @endif
                                                    </td>
                                                    <td class="p-2 text-center">
                                                        @if($invoiceDetail['is_saved'])
                                                            <x-ag.button.link type="button" wire:click="editProduct({{ $index }})" class="px-2 text-blue-500 hover:text-blue-600">
                                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                                                </svg>
                                                            </x-ag.button.link>
                                                            {{--                                        @elseif($invoiceDetail['product_artnr'])--}}
                                                        @elseif($product_art_nr)
                                                            <x-ag.button.link type="button" wire:click="saveProduct({{ $index }}, {{ $invoiceDetail['id'] ?? '' }})" class="px-2 text-green-500 hover:text-green-600">
                                                                <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                                    <path d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/>
                                                                </svg>
                                                            </x-ag.button.link>
                                                        @endif
                                                        <x-ag.button.link type="button" wire:click="removeProduct({{ $index }})" class="px-2 text-red-500 hover:text-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                                            </svg>
                                                        </x-ag.button.link>
                                                    </td>
                                                </x-ag.table.tr>
                                            @endforeach
                                            @if($subtotals > 0)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2 align-top" colspan="5" rowspan="7">
                                                        {{--@if($toPay)
                                                            @if($skonto)
                                                                Zahlbar bis
                                                                zum {{ Carbon::parse(now())->addDays(30)->isoFormat('DD. MMMM YYYY') }}
                                                                ohne Abzug.<br>
                                                                Bei Zahlung
                                                                bis {{ Carbon::parse(now())->addDays(14)->isoFormat('DD. MMMM YYYY') }}
                                                                gewähren wir 2.00 % Skonto
                                                                (= {{ number_format($skonto, 2, ',', '.') . ' €' }}) auf
                                                                den Gesamtbetrag.<br>
                                                                (Zahlbetrag abzüglich Skonto
                                                                = {{ number_format($total - $skonto, 2, ',', '.') . ' €'  }}
                                                                )
                                                            @else
                                                                Zahlungsart:
                                                                <span class="font-bold">{{ $invoices['invoice_payment'] }}</span>
                                                            @endif
                                                        @else
                                                            Zahlungsart: <span class="font-bold">Barzahlung</span> /
                                                            Zahlungseingang:
                                                            <span class="font-bold">{{ Carbon::parse(now())->format('d.m.Y') }}</span>
                                                        @endif--}}
                                                    </td>
                                                    <td class="p-2 text-right" colspan="2">Nettosumme:</td>
                                                    <td class="p-2 text-right" colspan="2">{{ number_format($subtotals, 2, ',', '.') . ' €' }}</td>
                                                </x-ag.table.tr>
                                            @endif
                                            <x-ag.table.tr class="text-sm">
                                                @if($discountTotal > 0)
                                                    <td class="p-2 text-right" colspan="2">Rabatt:</td>
                                                    <td class="p-2 text-right" colspan="2">
                                                        -{{ number_format($discountTotal, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if(false)
                                                    <td class="p-2 text-right" colspan="2">Versandkosten:</td>
                                                    <td class="p-2 text-right" colspan="2"></td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total19 > 0)
                                                    <td class="p-2 text-right" colspan="2">MwSt
                                                        ({{ $settings->tax_rate_full . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right" colspan="2">{{ number_format($total19, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total7 > 0)
                                                    <td class="p-2 text-right" colspan="2">MwSt
                                                        ({{ $settings->tax_rate_reduced . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right" colspan="2">{{ number_format($total7, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($totalAT > 0)
                                                    <td class="p-2 text-right" colspan="2">AT-Steuer
                                                        ({{ $settings->tax_rate_core . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right" colspan="2">{{ number_format($totalAT, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total > 0)
                                                    <td class="p-2 text-right font-bold" colspan="2">Gesamtbetrag:</td>
                                                    <td class="p-2 text-right font-bold" colspan="2">{{ number_format(round($total, 2), 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            @if(false)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2" colspan="5"></td>
                                                    <td class="p-2 text-right" colspan="2">Fremdgebühren*:</td>
                                                    <td class="p-2 text-right" colspan="2"></td>
                                                </x-ag.table.tr>
                                            @endif
                                            {{--@if($toPay)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2" colspan="5"></td>
                                                    <td class="p-2 text-right font-bold" colspan="2">zu zahlen:</td>
                                                    <td class="p-2 text-right font-bold" colspan="2">{{ number_format(round($total, 2), 2, ',', '.') . ' €' }}</td>
                                                </x-ag.table.tr>
                                            @endif--}}
                                        </x-slot:tbody>
                                    </x-ag.table.table>
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 sm:col-full"></div>
                        <div class="col-span-6 sm:col-full">
                            <div class="flex items-center justify-end space-x-1">
                                <x-ag.button.loading-button text="Speichern" class=""/>
                                <x-ag.button.a-link href="{{ route('backend.invoice.order.index-order') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Abbrechen
                                </x-ag.button.a-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-ag.main.head>
</div>
