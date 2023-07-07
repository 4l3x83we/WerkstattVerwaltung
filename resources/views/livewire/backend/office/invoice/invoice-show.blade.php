@php use Carbon\Carbon; @endphp
<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('invoiceShow', $offen) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Rechnung {{ $offen->invoice_nr }}</h1>
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>

    <x-ag.main.head>
        {{-- Orders --}}
        <form wire:submit.prevent="store" method="POST" class="p-4">
            <input type="hidden" name="invoices.id">
            <input type="hidden" name="invoices.order_nr">
            <div class="grid grid-cols-1 xl:grid-cols-12 xl:gap-4 dark:bg-gray-900">
                <div class="col-span-10">
                    {{-- Zahlung --}}
                    <x-ag.card.head>
                        <div class="grid grid-cols-1 xl:grid-cols-12 gap-4">
                            <div class="col-span-12 sm:col-span-3">
                                <div class="flex w-full items-center">
                                    <div class="w-1/2 text-right">Gesamtbetrag</div>
                                    <div class="w-1/2 text-right">{{ number_format($offen->invoice_total, 2, ',', '.') . ' €' }}</div>
                                </div>
                                <div class="flex w-full items-center">
                                    <div class="w-1/2 text-right">Zahlungen gesamt</div>
                                    <div class="w-1/2 text-right">{{ number_format($paymentTotal, 2, ',', '.') . ' €' }}</div>
                                </div>
                                <div class="flex w-full items-center">
                                    <div class="w-1/2 text-right">Restbetrag</div>
                                    <div class="w-1/2 text-right">{{ number_format($offen->calculatePayment($paymentTotal), 2, ',', '.') . ' €' }}</div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <div class="sm:flex sm:justify-center">
                                    <div class="relative sm:w-2/3 w-full bg-gray-200 h-5 dark:bg-gray-700">
                                        @if($payment_in_percent)
                                            <div class="absolute top-0 left-0 w-full h-full text-center z-10 leading-5 font-medium text-xs">
                                                {{ round($payment_in_percent) }} % bezahlt</div>
                                        @endif
                                        <div class="absolute top-0 left-0 w-full h-full bg-orange-700 dark:bg-orange-700" style="width: {{ round($payment_in_percent) }}%"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-3">
                                @if($payment_in_percent < 100)
                                <div class="flex sm:justify-end">
                                    <x-ag.button.button id="" x-data="{}" x-on:click="window.livewire.emitTo('backend.office.invoice.payment.payment', 'show')" class="w-full justify-center !text-green-700 !border-green-700 !hover:bg-green-800 !focus:ring-green-300 !dark:border-green-500 !dark:text-green-500 !dark:hover:bg-green-600 !dark:focus:ring-green-900" wire:ignore>Zahlung erfassen</x-ag.button.button>
                                    @livewire('backend.office.invoice.payment.payment', [
                                        'payments' => $payment,
                                        'offen' => $offen,
                                    ])
                                </div>
                                @endif
                            </div>
                            <div class="col-span-12">
                                @if(count($payments) > 0)
                                    <div class="relative overflow-x-auto overflow-y-hidden">
                                    <x-ag.table.table>
                                        <x-slot:thead>
                                            <x-ag.table.th class="min-w-[100px]">Datum</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[200px] text-right">Betrag (€)</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[335px]">Zahlungsweise</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[335px]">Notizen</x-ag.table.th>
                                            <x-ag.table.th class="min-w-[180px]"></x-ag.table.th>
                                        </x-slot:thead>
                                        <x-slot:tbody>
                                            @foreach($payments as $payment)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2">{{ $payment->dateOfPayment() }}</td>
                                                    <td class="p-2 text-right">
                                                        @if($payment->payment_amount < 0)
                                                            <span class="text-red-600">{{ number_format($payment->payment_amount, 2, ',', '.') . ' €' }}</span>
                                                        @else
                                                            <span class="text-green-500">{{ number_format($payment->payment_amount, 2, ',', '.') . ' €' }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="p-2">{{ $payment->payment_method }}</td>
                                                    <td class="p-2">{!! nl2br(e($payment->notes)) !!}</td>
                                                    <td class="p-2 text-center">
                                                        <x-ag.button.link wire:click="mail({{ $payment->id }})" class="px-2 text-cyan-500 hover:text-cyan-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                                            </svg>
                                                        </x-ag.button.link>
                                                        <x-ag.button.link wire:click="download({{ $payment->id }})" class="px-2 text-fuchsia-500 hover:text-fuchsia-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                                            </svg>
                                                        </x-ag.button.link>
                                                        <x-ag.button.link wire:click="print({{ $payment->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z" />
                                                            </svg>
                                                        </x-ag.button.link>
                                                        <x-ag.button.link wire:click="storno({{ $payment->id }})" class="px-2 text-red-500 hover:text-red-600">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                            </svg>
                                                        </x-ag.button.link>
                                                    </td>
                                                </x-ag.table.tr>
                                            @endforeach
                                        </x-slot:tbody>
                                    </x-ag.table.table>
                                </div>
                                @endif
                            </div>
                        </div>
                    </x-ag.card.head>
                    <div class="grid grid-cols-1 xl:grid-cols-12 xl:gap-4 dark:bg-gray-900">
                        <div class="col-span-8">
                            {{-- Kundendaten / Fahrzeugdaten --}}
                            <x-ag.card.head>
                                @if($payment_in_percent < 100)
                                <div class="w-2/3">
                                    <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 sm:text-base">
                                        <li class="flex md:w-full items-center text-orange-600 dark:text-orange-500 sm:after:content-[''] after:w-full after:h-1 after:border-b after:border-orange-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-orange-700">
                                            <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-orange-200 dark:after:text-orange-500">
                                                <span class="mr-2">1</span> Auftrag
                                            </span>
                                        </li>
                                        <li class="flex md:w-full items-center text-orange-600 dark:text-orange-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-orange-200 after:border-1 after:hidden sm:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-orange-700">
                                            <span class="flex items-center after:content-['/'] sm:after:hidden after:mx-2 after:text-orange-200 dark:after:text-orange-500">
                                                <span class="mr-2">2</span> Entwurf
                                            </span>
                                        </li>
                                        <li class="flex items-center text-orange-600 dark:text-orange-500">
                                            <span class="mr-2">3</span> Rechnung
                                        </li>
                                    </ol>
                                </div>
                                @endif

                                <div class="grid grid-cols-12 gap-4 mt-4">
                                    <div class="col-span-12">
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Besitzer</span>
                                            <span class="w-3/4">
                                                {{ $offen->customer->customer_firstname .' '. $offen->customer->customer_lastname }}
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Rechnungsadresse</span>
                                            <span class="w-3/4">
                                                Kd-Nr. {{ $offen->customer->customer_kdnr }}<br>
                                                {{ $offen->customer->customer_salutation .' '. $offen->customer->customer_firstname .' '. $offen->customer->customer_lastname }}<br>
                                                {{ $offen->customer->customer_street }}<br>
                                                {{ $offen->customer->customer_post_code .' '. $offen->customer->customer_location  }}<br>
                                                {{ $offen->customer->customer_vat_number }}
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Fahrzeug</span>
                                            <span class="w-3/4">
                                                {{ $offen->vehicle->vehicles_license_plate .' | '. $offen->vehicle->vehicles_brand .'  '. $offen->vehicle->vehicles_model .' '. $offen->vehicle->vehicles_type }} @if($offen->vehicle->vehicles_mileage) {{ ' | ' . $offen->vehicle->vehicles_mileage . ' km' }} @else | Kilometerstand nicht angegeben @endif
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Rechnungsdatum</span>
                                            <span class="w-3/4">
                                                {{ Carbon::parse($offen->invoice_date)->format('d.m.Y') }}
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Leistungszeitraum</span>
                                            <span class="w-3/4">
                                                 {!! $offen->checkInvoiceDateWithPerformanceDate() !!}
                                            </span>
                                        </div>
                                        @if(!is_null($offen->invoice_due_date))
                                            <div class="flex w-full space-x-4 mb-4">
                                                <span class="w-1/4 text-right">Fällig am</span>
                                                <span class="w-3/4">
                                                    {{ Carbon::parse($offen->invoice_due_date)->format('d.m.Y') }}
                                                </span>
                                            </div>
                                        @endif
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Rechnungstext</span>
                                            <span class="w-3/4">
                                                @if(!is_null($offen->invoice_notes_2)) {!! nl2br($offen->invoice_notes_2) !!} @else -- @endif
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Auftragstext</span>
                                            <span class="w-3/4">
                                                @if(!is_null($offen->invoice_notes_1)) {!! nl2br($offen->invoice_notes_1) !!} @else -- @endif
                                            </span>
                                        </div>
                                        <div class="flex w-full space-x-4 mb-4">
                                            <span class="w-1/4 text-right">Bearbeiter</span>
                                            <span class="w-3/4">
                                                {{ $offen->invoice_clerk }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </x-ag.card.head>
                        </div>

                        <div class="col-span-4">
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
                                                {{ $termine ?? 0 }}
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
                        </div>
                    </div>
                </div>

                <div class="col-span-2">
                    <x-ag.card.head>
                        <div class="space-y-2">
                            @if($payment_in_percent < 100)
                                @livewire('backend.office.invoice.button.edit', ['order' => $offen->invoice_nr])
                            @endif
                            @livewire('backend.office.invoice.copy.copy', ['order' => $offen])

                            @if($payment_in_percent < 100)
                                <x-ag.button.button class="w-full justify-center !text-red-700 !border-red-700 !hover:bg-red-800 !focus:ring-red-300 !dark:border-red-500 !dark:text-red-500 !dark:hover:bg-red-600 !dark:focus:ring-red-900" wire:click="remove({{ $offen->id }})">
                                    Stornieren
                                </x-ag.button.button>
                            @endif
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between">
                            <span class="text-xs">Rechnung</span>
                            <span class="text-xs">{{ Carbon::parse($offen->invoice_date)->format('d.m.Y') }}</span>
                        </div>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </x-ag.button.button>
                        </div>
                        <span class="text-xs">Auftrag</span>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </x-ag.button.button>
                        </div>
                        <span class="text-xs">Arbeitsauftrag</span>
                        <div class="flex justify-center space-x-2 my-2">
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
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
                                                            <x-ag.forms.input id="product.product_art_nr" text="Artikelnummer" />
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
                                                </x-ag.table.tr>
                                            @endforeach
                                            @if($subtotals > 0)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2 align-top" colspan="5" rowspan="7"></td>
                                                    <td class="p-2 text-right" colspan="2">Nettosumme:</td>
                                                    <td class="p-2 text-right">{{ number_format($subtotals, 2, ',', '.') . ' €' }}</td>
                                                </x-ag.table.tr>
                                            @endif
                                            <x-ag.table.tr class="text-sm">
                                                @if($discountTotal > 0)
                                                    <td class="p-2 text-right" colspan="2">Rabatt:</td>
                                                    <td class="p-2 text-right">
                                                        -{{ number_format($discountTotal, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if(false)
                                                    <td class="p-2 text-right" colspan="2">Versandkosten:</td>
                                                    <td class="p-2 text-right"></td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total19 > 0)
                                                    <td class="p-2 text-right" colspan="2">MwSt
                                                        ({{ $settings->tax_rate_full . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right">{{ number_format($total19, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total7 > 0)
                                                    <td class="p-2 text-right" colspan="2">MwSt
                                                        ({{ $settings->tax_rate_reduced . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right">{{ number_format($total7, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($totalAT > 0)
                                                    <td class="p-2 text-right" colspan="2">AT-Steuer
                                                        ({{ $settings->tax_rate_core . ' %' }}):
                                                    </td>
                                                    <td class="p-2 text-right">{{ number_format($totalAT, 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            <x-ag.table.tr class="text-sm">
                                                @if($total > 0)
                                                    <td class="p-2 text-right font-bold" colspan="2">Gesamtbetrag:</td>
                                                    <td class="p-2 text-right font-bold">{{ number_format(round($total, 2), 2, ',', '.') . ' €' }}</td>
                                                @endif
                                            </x-ag.table.tr>
                                            @if(false)
                                                <x-ag.table.tr class="text-sm">
                                                    <td class="p-2" colspan="5"></td>
                                                    <td class="p-2 text-right" colspan="2">Fremdgebühren*:</td>
                                                    <td class="p-2 text-right"></td>
                                                </x-ag.table.tr>
                                            @endif
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
                                <x-ag.button.a-link href="{{ route('backend.invoice.offen.index') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Zurück
                                </x-ag.button.a-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </x-ag.main.head>
</div>
