<div class="col-span-1">
    {{-- weitere Daten --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">weitere Daten</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.inline-label-input type="month" id="vehicles_hu" text="HU"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_tire_1" text="Reifen VA (zu 15.1)"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_tire_2" text="Reifen HA (zu 15.2)" value="{{ $fahrzeuge['vehicles_tire_2'] ?? null }}"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_tpms" text="RDKS">
                    @foreach(json()['tpms'] as $tpms)
                        <option value="{{ $tpms->id }}">{{ $tpms->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="fahrzeuge.vehicles_engine_code" text="Motorcode"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_fuel" text="Kraftstoff">
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['fuel'] as $fuel)
                        <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <div class="lg:flex lg:items-center gap-4">
                    <div class="lg:w-1/3">
                        <x-ag.forms.label class="!lg:mb-0" for="fahrzeuge.vehicles_cat" text="KAT/Plakette"/>
                    </div>
                    <div class="lg:w-1/3 mb-4 lg:mb-0">
                        <x-ag.forms.select id="fahrzeuge.vehicles_cat" text="Kraftstoff">
                            <option value="">bitte Auswählen</option>
                            @foreach(json()['cat'] as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </x-ag.forms.select>
                    </div>
                    <div class="lg:w-1/3">
                        <x-ag.forms.select id="fahrzeuge.vehicles_plaque" text="Kraftstoff">
                            <option value="">bitte Auswählen</option>
                            @foreach(json()['plaque'] as $plaque)
                                <option value="{{ $plaque->id }}">{{ $plaque->name }}</option>
                            @endforeach
                        </x-ag.forms.select>
                    </div>
                </div>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_emission_class" text="Emissionsklasse">
                    <option value="">bitte Auswählen</option>
                    @foreach($emissions as $emission)
                        <option value="{{ $emission->id }}">{{ $emission->emission_class }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="fahrzeuge.vehicles_transmission" text="Getriebe">
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['transmission'] as $transmission)
                        <option value="{{ $transmission->id }}">{{ $transmission->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
        </div>
    </x-ag.card.head>

    {{-- Notiz --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Notiz</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.textarea id="fahrzeuge.vehicles_note" text="" rows="10" />
            </div>
        </div>
    </x-ag.card.head>
</div>
