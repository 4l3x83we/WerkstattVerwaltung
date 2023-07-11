@if($order > 0) <div class="col-span-10"> @else <div class="col-span-12"> @endif
    <x-ag.card.head>
        <div class="w-2/3">
            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 lg:text-base">
                <li class="flex lg:w-full items-center text-orange-600 dark:text-orange-500 lg:after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden lg:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] lg:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="mr-2">1</span> Auftrag
                    </span>
                </li>
                <li class="flex lg:w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden lg:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
                    <span class="flex items-center after:content-['/'] lg:after:hidden after:mx-2 after:text-gray-200 dark:after:text-gray-500">
                        <span class="mr-2">2</span> Entwurf
                    </span>
                </li>
                <li class="flex items-center">
                    <span class="mr-2">3</span> Rechnung
                </li>
            </ol>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input id="order.order_nr" text="Auftrags-Nr." readonly/>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input type="date" id="order.order_date" text="Datum"/>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="customer.id" text="Kundenummer" wire:ignore>
                    <option value="">bitte Auswählen</option>
                    @foreach($customers as $item)
                        <option value="{{ $item->id }}">{{ '(' . $item->customer_kdnr . ') ' . $item->customer_firstname . ' ' . $item->customer_lastname }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12 lg:col-span-6">
                @if($address)
                <x-ag.forms.label text="Rechnungsadresse"/>
                <span class="text-sm">{!! $address !!}</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr. des Kunden" >
                    <option value="">bitte Auswählen</option>
                    @foreach($vehicles as $item)
                        <option value="{{ $item->id }}">{{ '('.$item->vehicles_license_plate.') '.$item->vehicles_brand . ' ' . $item->vehicles_model . ' ' . $item->vehicles_type . ' (EZ: ' . $item->firstReg() . ')' }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12 lg:col-span-6">
                @if($fahrzeugSelect)
                    <div class="flex flex-col lg:flex-row gap-2">
                        <div class="w-full lg:w-1/3">
                            <x-ag.forms.label text="Fahrzeug"/>
                            <span class="text-sm">{!! $fahrzeugSelect['fahrzeug'] !!}</span>
                        </div>
                        <div class="w-full lg:w-1/3">
                            <x-ag.forms.label text="Laufleistung"/>
                            <span class="text-sm">{!! $fahrzeugSelect['laufleistung'] !!}</span>
                        </div>
                        <div class="w-full lg:w-1/3">
                            <x-ag.forms.label text="Nächste Überprüfung (TÜV)"/>
                            <span class="text-sm">{!! $fahrzeugSelect['tuev'] !!}</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.label for="order.invoice_notes_1" text="Auftragstext" />
                <x-ag.forms.textarea id="order.invoice_notes_1" rows="5"></x-ag.forms.textarea>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.label for="order.invoice_notes_2" text="Rechnungstext" />
                <x-ag.forms.textarea id="order.invoice_notes_2" rows="5"></x-ag.forms.textarea>
            </div>
        </div>

        <div class="grid grid-cols-12 gap-4 mt-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input type="date" id="order.delivery_performance_date" text="Liefer-/ Leistungsdatum"/>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="order.invoice_clerk" text="Sachbearbeiter/in">
                    @foreach(auth()->user()->admin() as $billing)
                        <option value="{{ $billing->name }}">{{ $billing->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
        </div>

    </x-ag.card.head>
</div>

@if($order > 0)
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
@endif
