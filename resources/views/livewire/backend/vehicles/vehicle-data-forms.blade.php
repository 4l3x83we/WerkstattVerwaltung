<div class="col-span-1">
    <x-ag.card.head>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr." readonly />
            </div>
        </div>
    </x-ag.card.head>

    {{-- Fahrzeugdaten --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Fahrzeugdaten</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_license_plate" text="Kennzeichen" />
            </div>
            <div class="col-span-12">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3">
                        <x-ag.forms.label class="!lg:mb-0" for="fahrzeuge.vehicles_hsn" text="HSN (zu 2.1) / TSN (zu 2.2)"/>
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.input type="number" maxlength="4" id="fahrzeuge.vehicles_hsn" text="HSN (zu 2.1)" />
                    </div>
                    <div class="lg:w-1/3">
                        <x-ag.forms.input maxlength="9" id="fahrzeuge.vehicles_tsn" text="TSN (zu 2.2)" />
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_brand" text="Marke (zu D.1)" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_model" text="Modell (zu D.3)" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_type" text="Type (zu D.2)" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_class" text="Fahrzeugklasse" >
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['fzKlasse'] as $fzKlasse)
                        <option value="{{ $fzKlasse->id }}">{{ $fzKlasse->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_category" text="Kategorie" >
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['fzCategory'] as $fzKategorie)
                        <option value="{{ $fzKategorie->id }}">{{ $fzKategorie->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_identification_number" text="Fz.-Ident.-Nr. (zu E)" maxlength="17" />
            </div>
            <div class="col-span-12">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.label for="fahrzeuge.vehicles_first_registration" text="Erstzulassung (zu B)" />
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.input type="date" id="fahrzeuge.vehicles_first_registration" text="Erstzulassung (zu B)" />
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        @if($age)<span>{{ 'Alter: ' . $age . ' Jahre' }}</span>@endif
                    </div>
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <x-ag.forms.label class="!mb-0" for="fahrzeuge.vehicles_hsn" text="Hubraum (zu P.1) / PS / kW (zu P.2)"/>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.igr type="number" id="fahrzeuge.vehicles_cubic_capacity" text="Hubraum (zu P.1)" icon="ccm³" />
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.igr type="number" id="fahrzeuge.vehicles_hp" text="PS wird berechnet" icon="PS" readonly />
                    </div>
                    <div class="lg:w-1/3">
                        <x-ag.forms.igr type="number" id="fahrzeuge.vehicles_kw" text="kW (zu P.2)" icon="kW" />
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3">
                        <x-ag.forms.label class="!lg:mb-0" for="fahrzeuge.vehicles_mileage" text="Tachostand"/>
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.input type="number" id="fahrzeuge.vehicles_mileage" text="Tachostand"/>
                    </div>
                    <div class="lg:w-1/3">
                        @if($fahrzeuge['vehicles_mileage'])
                        <x-ag.button.button id="" x-data="{}" x-on:click="window.livewire.emitTo('backend.vehicles.kilometerstand-table', 'show')">Kilometerstand</x-ag.button.button>
                        @livewire('backend.vehicles.kilometerstand-table', [
                            'fahrzeuge' => $fahrzeuge,
                        ])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </x-ag.card.head>

    {{-- Halter --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Halter</h3>
        <div class="grid grid-cols-12 gap-4">
            @if($customerEdit)
                <div class="col-span-12">
                    <div class="lg:flex lg:items-center gap-4">
                        <div class="lg:w-1/3"></div>
                        <div class="lg:w-2/3">
                            <div class="flex">
                                <x-ag.forms.checkbox-radio id="Neukunde" wire:model="customerNew" type="radio" text="Neukunde" value="0" />
                                <x-ag.forms.checkbox-radio id="Bestandskunde" wire:model="customerNew" type="radio" text="Bestandskunde" value="1" />
                            </div>
                        </div>
                    </div>
                </div>
                @if($customerNew)
                    <div class="col-span-12">
                        <div class="lg:flex lg:items-center gap-4">
                            <div class="lg:w-1/3"><span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kundennummer</span></div>
                            <div class="lg:w-2/3">
                                <x-ag.forms.search-var type="search" id="customerSearch" text="Kundensuche" />
                            </div>
                        </div>
                    </div>
                @endif
                @if($customers)
                    <div class="col-span-12">
                        <div class="lg:flex lg:items-center gap-4">
                            <div class="lg:w-1/3">
                                <x-ag.forms.label class="!lg:mb-0" for="customers.customer_post_code" text="Name/Firma"/>
                            </div>
                            <div class="lg:w-1/3 mb-4 lg:mb-0">
                                <x-ag.forms.input id="customers.customer_firstname" text="Vorname" />
                            </div>
                            <div class="lg:w-1/3">
                                <x-ag.forms.input id="customers.customer_lastname" text="Name/Firma" />
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12">
                        <x-ag.forms.inline-label-input id="customers.customer_street" text="Straße"  />
                    </div>
                    <div class="col-span-12">
                        <div class="lg:flex lg:items-center gap-4">
                            <div class="lg:w-1/3">
                                <x-ag.forms.label class="!lg:mb-0" for="customers.customer_post_code" text="PLZ/Ort" />
                            </div>
                            <div class="lg:w-1/3 mb-4 lg:mb-0">
                                <x-ag.forms.input type="number" id="customers.customer_post_code" text="Postleitzahl" />
                            </div>
                            <div class="lg:w-1/3">
                                <x-ag.forms.input id="customers.customer_location" text="Ort" />
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="col-span-12">
                    <div class="lg:flex lg:items-center gap-4">
                        <div class="lg:w-1/3"><span class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kundennummer</span></div>
                        <div class="lg:w-2/3">
                            <x-ag.forms.input id="customers.customer_kdnr" text="Kundensuche" />
                            <x-ag.forms.input type="hidden" id="customers.id" />
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <div class="lg:flex lg:items-center gap-4">
                        <div class="lg:w-1/3">
                            <x-ag.forms.label class="!lg:mb-0" for="customers.customer_post_code" text="Name/Firma"/>
                        </div>
                        <div class="lg:w-1/3 mb-4 lg:mb-0">
                            <x-ag.forms.input id="customers.customer_firstname" text="Vorname" readonly />
                        </div>
                        <div class="lg:w-1/3">
                            <x-ag.forms.input id="customers.customer_lastname" text="Name/Firma" readonly />
                        </div>
                    </div>
                </div>
                <div class="col-span-12">
                    <x-ag.forms.inline-label-input id="customers.customer_street" text="Straße" readonly />
                </div>
                <div class="col-span-12">
                    <div class="lg:flex lg:items-center gap-4">
                        <div class="lg:w-1/3">
                            <x-ag.forms.label class="!lg:mb-0" for="customers.customer_post_code" text="PLZ/Ort" />
                        </div>
                        <div class="lg:w-1/3 mb-4 lg:mb-0">
                            <x-ag.forms.input type="number" id="customers.customer_post_code" text="Postleitzahl" readonly/>
                        </div>
                        <div class="lg:w-1/3">
                            <x-ag.forms.input id="customers.customer_location" text="Ort" readonly/>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </x-ag.card.head>
</div>
