<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('invoiceCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Neue Rechnung erstellen</h1>
                <x-ag.errors.errorMessages/>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        {{-- Invoices --}}
        <form wire:submit.prevent="store" method="POST" class="p-4">
            <input type="hidden" name="invoices.id">
            <input type="hidden" name="invoices.invoice_nr">
            <div class="grid grid-cols-1 xl:grid-cols-12 xl:gap-4 dark:bg-gray-900">
                <div class="col-span-12">
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
                                <x-ag.forms.inline-label-input id="invoices.invoice_nr" text="Rechnungs-Nr." readonly/>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <x-ag.forms.inline-label-input type="date" id="invoices.invoice_date" text="Datum"/>
                            </div>
                            <div class="col-span-6 lg:col-span-3">
                                <x-ag.forms.inline-label-input type="date" id="invoices.invoice_due_date" text="Fällig am"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-select id="customer.id" text="Kundenummer">
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
                                <x-ag.forms.inline-select id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr. des Kunden">
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
                                                <x-ag.forms.igr id="fahrzeuge.vehicles_mileage" text="Laufleistung" icon="km" />
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
                                <x-ag.forms.textarea id="invoices.invoice_notes_1" rows="5" text="Auftragstext"/>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.textarea id="invoices.invoice_notes_2" rows="5" text="Rechnungstext"/>
                            </div>
                        </div>

                        <div class="grid grid-cols-12 gap-4 mt-4">
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-label-input type="date" id="invoices.delivery_performance_date" text="Liefer-/ Leistungsdatum"/>
                            </div>
                            <div class="col-span-12 lg:col-span-6">
                                <x-ag.forms.inline-select id="invoices.invoice_clerk" text="Sachbearbeiter/in">
                                    @foreach(auth()->user()->admin() as $billing)
                                        <option value="{{ $billing->name }}">{{ $billing->name }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
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
                        <div class="col-span-6 lg:col-full"></div>
                        <div class="col-span-6 lg:col-full">
                            <div class="flex items-center justify-end space-x-1">
                                <x-ag.button.loading-button text="Speichern" class=""/>
                                <x-ag.button.a-link href="{{ route('backend.invoice.offen.index') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
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
