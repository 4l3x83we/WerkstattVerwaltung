<div class="col-span-1">
    <x-ag.card.head>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                @if(!$whenKdNr)
                    <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr."/>
                @else
                    <x-ag.forms.inline-select id="fahrzeuge.vehicles_internal_vehicle_number" text="int. Fz. Nr. des Kunden">
                        <option value="">bitte Auswählen</option>
                        @foreach($vehicles as $vehicle)
                            <option value="{{ $vehicle->id }}">{{ '('.$vehicle->vehicles_license_plate.') '.$vehicle->vehicles_brand . ' ' . $vehicle->vehicles_model . ' ' . $vehicle->vehicles_type . ' (EZ: ' . $vehicle->firstReg() . ')' }}</option>
                        @endforeach
                    </x-ag.forms.inline-select>
                @endif
            </div>
        </div>
    </x-ag.card.head>

    {{-- Fahrzeugdaten --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Fahrzeugdaten</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_license_plate" text="Kennzeichen"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_identification_number" text="Fz.-Ident.-Nr. (zu E)" maxlength="17"/>
            </div>
            <div class="col-span-12">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3">
                        <x-ag.forms.label class="!lg:mb-0" for="fahrzeuge.vehicles_hsn" text="HSN (zu 2.1) / TSN (zu 2.2)"/>
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.input type="number" maxlength="4" id="fahrzeuge.vehicles_hsn" text="HSN (zu 2.1)"/>
                    </div>
                    <div class="lg:w-1/3">
                        <x-ag.forms.input maxlength="9" id="fahrzeuge.vehicles_tsn" text="TSN (zu 2.2)"/>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input type="date" id="fahrzeuge.vehicles_first_registration" text="Erstzulassung (zu B)"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_brand" text="Marke (zu D.1)"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input type="month" id="fahrzeuge.hu" text="HU"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_model" text="Modell (zu D.3)"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input type="number" id="fahrzeuge.vehicles_mileage" text="Tachostand"/>
            </div>
        </div>
    </x-ag.card.head>

    {{-- weitere Daten --}}
    <x-ag.card.head>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-label-input type="date" id="offers.delivery_performance_date" text="Liefer-/ Leistungsdatum"/>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="offers.offer_payment" text="Zahlungsbedingungen">
                    @foreach(json()['payments'] as $payment)
                        <option value="{{ $payment->name }}">{{ $payment->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="offers.offer_order_type" text="Auftragsart">
                    @foreach(json()['orderType'] as $orderType)
                        <option value="{{ $orderType->name }}">{{ $orderType->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12 lg:col-span-6">
                <x-ag.forms.inline-select id="offers.offer_clerk" text="Sachbearbeiter/in">
                    @foreach(auth()->user()->admin() as $billing)
                        <option value="{{ $billing->name }}">{{ $billing->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
        </div>
    </x-ag.card.head>
</div>
