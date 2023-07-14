@php use Carbon\Carbon; @endphp
<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('draftEdit', $draft) !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Rechnungsentwurf bearbeiten
                    ({{ $draft->invoice_nr }})</h1>
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
                    <x-ag.card.head>
                        <div class="w-2/3">
                            <ol class="flex items-center w-full text-sm font-medium text-center text-gray-500 dark:text-gray-400 lg:text-base">
                                <li class="flex lg:w-full items-center text-orange-600 dark:text-orange-500 lg:after:content-[''] after:w-full after:h-1 after:border-b after:border-orange-200 after:border-1 after:hidden lg:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-orange-700">
                                    <span class="flex items-center after:content-['/'] lg:after:hidden after:mx-2 after:text-orange-200 dark:after:text-orange-500">
                                        <span class="mr-2">1</span> Auftrag
                                    </span>
                                </li>
                                <li class="flex lg:w-full items-center text-orange-600 dark:text-orange-500 after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-200 after:border-1 after:hidden lg:after:inline-block after:mx-6 xl:after:mx-10 dark:after:border-gray-700">
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
                                <x-ag.forms.inline-label-input id="draft.invoice_nr" text="Rechnungs-Nr." readonly/>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-label-input type="date" id="draft.invoice_date" text="Datum" readonly/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-select id="customer.id" text="Kundenummer" disabled>
                                    <option value="null">bitte Auswählen</option>
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
                                <x-ag.forms.inline-select id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr. des Kunden" disabled>
                                    <option value="null">bitte Auswählen</option>
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
                                            <x-ag.forms.label for="fahrzeuge.vehicles_mileage" text="Laufleistung"/>
                                            <span class="text-sm">
                                                <x-ag.forms.igr id="fahrzeuge.vehicles_mileage" text="Laufleistung" icon="km"/>
                                            </span>
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
                                <x-ag.forms.textarea id="draft.invoice_notes_1" rows="5" text="Auftragstext"/>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.textarea id="draft.invoice_notes_2" rows="5" text="Rechnungstext"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-label-input type="date" id="draft.delivery_performance_date" text="Liefer-/ Leistungsdatum"/>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-select id="draft.invoice_clerk" text="Sachbearbeiter/in">
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
                            @livewire('backend.office.invoice.complete.complete', ['order' => $draft])
                            @livewire('backend.office.invoice.copy.copy', ['order' => $draft])

                            <x-ag.button.button class="w-full justify-center" wire:click="deposit({{ $draft->id }})">
                                Anzahlung
                            </x-ag.button.button>
                            <x-ag.button.button class="w-full justify-center !text-red-700 !border-red-700 !hover:bg-red-800 !focus:ring-red-300 !dark:border-red-500 !dark:text-red-500 !dark:hover:bg-red-600 !dark:focus:ring-red-900" wire:click="remove({{ $draft->id }})">
                                Auftrag Löschen
                            </x-ag.button.button>
                        </div>
                        <hr class="my-2">
                        <div class="flex justify-between">
                            <span class="text-xs">Auftrag</span>
                            <span class="text-xs">{{ Carbon::parse($draft->order_date)->format('d.m.Y') }}</span>
                        </div>
                        <div class="flex justify-center my-2">
                            <x-ag.button.button-link href="{{ route('backend.auftraege.print.pdf', $draft->id) }}" target="_blank" class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button-link>
                            <x-ag.button.button x-data="{}" x-on:click="window.livewire.emitTo('backend.office.invoice.mail.order-mail-modal', 'show')" class="w-full justify-center mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            @livewire('backend.office.invoice.mail.order-mail-modal', [
                                'invoice' => $draft,
                            ])
                            <x-ag.button.button-link href="{{ route('backend.auftraege.download.pdf', $draft->id) }}" class="w-full justify-center !mr-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </x-ag.button.button-link>
                        </div>
                        <span class="text-xs">Arbeitsauftrag</span>
                        <div class="flex justify-center my-2">
                            <x-ag.button.button-link href="{{ route('backend.arbeitsauftrag.print.pdf', $draft->id) }}" class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button-link>
                            <x-ag.button.button x-data="{}" x-on:click="window.livewire.emitTo('backend.office.invoice.mail.work-order-mail-modal', 'show')" class="w-full justify-center mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            @livewire('backend.office.invoice.mail.work-order-mail-modal', [
                                'invoice' => $draft,
                            ])
                            <x-ag.button.button-link href="{{ route('backend.arbeitsauftrag.download.pdf', $draft->id) }}" class="w-full justify-center !mr-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </x-ag.button.button-link>
                        </div>
                        <span class="text-xs">Entwurf</span>
                        <div class="flex justify-center my-2">
                            <x-ag.button.button-link href="{{ route('backend.invoice.entwurf.print.pdf', $draft->id) }}" target="_blank" class="w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                </svg>
                            </x-ag.button.button-link>
                            <x-ag.button.button x-data="{}" x-on:click="window.livewire.emitTo('backend.office.invoice.mail.invoice-draft-mail-modal', 'show')" class="w-full justify-center mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75"/>
                                </svg>
                            </x-ag.button.button>
                            @livewire('backend.office.invoice.mail.invoice-draft-mail-modal', [
                                'invoice' => $draft,
                            ])
                            <x-ag.button.button-link href="{{ route('backend.invoice.entwurf.download.pdf', $draft->id) }}" class="w-full justify-center !mr-0">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                            </x-ag.button.button-link>
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
                                    @include('livewire.backend.office.layout.positionen')
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 lg:col-full">
                            @include('livewire.backend.office.layout.dropdownProtocol')
                        </div>
                        <div class="col-span-6 lg:col-full">
                            <div class="flex items-center justify-end space-x-1">
                                <x-ag.button.loading-button text="Speichern" class=""/>
                                <x-ag.button.a-link href="{{ route('backend.invoice.entwurf.index') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
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
