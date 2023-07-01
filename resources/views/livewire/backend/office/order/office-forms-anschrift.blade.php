{{-- Kundennummer --}}
<div class="col-span-1">
    <x-ag.card.head>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 md:col-full">
                <x-ag.forms.inline-label-input id="orders.order_nr" text="Auftrags-Nr." readonly/>
            </div>
            <div class="col-span-6 md:col-full">
                <x-ag.forms.inline-label-input type="date" id="orders.order_date" text="Datum"/>
            </div>
        </div>
    </x-ag.card.head>

    <x-ag.card.head>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 md:col-full">
                <x-ag.forms.inline-label-input id="customers.customer_kdnr" text="Kundenummer"/>
            </div>
            <div class="col-span-6 md:col-full">
                <div class="flex items-center h-[38px]">
                    <x-ag.forms.checkbox-radio type="radio" id="privat" wire:model="customers.customer_kdtype" text="Privatkunde" value="0"/>
                    <x-ag.forms.checkbox-radio type="radio" id="firma" wire:model="customers.customer_kdtype" text="Firma" value="1"/>
                </div>
            </div>
        </div>
    </x-ag.card.head>

    {{-- Address --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Anschrift</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.label for="customers.customer_salutation" text="Anrede" stern="true"/>
                <x-ag.forms.select id="customers.customer_salutation" wire:ignore>
                    <option value="">bitte Anrede auswählen</option>
                    @foreach(json()['anrede'] as $anrede)
                        <option value="{{ $anrede->name }}" wire:key="{{ $customers['customer_salutation'] }}">{{ $anrede->name }}</option>
                    @endforeach
                </x-ag.forms.select>
            </div>
            @if(!$changeKdType)
                <div class="col-span-6 sm:col-full">
                    <x-ag.forms.label for="customers.customer_firstname" text="Vorname" stern="true"/>
                    <x-ag.forms.input id="customers.customer_firstname" text="Vorname"/>
                </div>
                <div class="col-span-6 sm:col-full">
                    <x-ag.forms.label for="customers.customer_lastname" text="Nachname" stern="true"/>
                    <x-ag.forms.input id="customers.customer_lastname" text="Nachname"/>
                </div>
            @else
                <div class="col-span-12">
                    <x-ag.forms.label for="customers.customer_lastname" text="Firma" stern="true"/>
                    <x-ag.forms.input id="customers.customer_lastname" text="Firma"/>
                </div>
            @endif
            <div class="col-span-12">
                <x-ag.forms.label for="customers.customer_additive" text="Zusatz"/>
                <x-ag.forms.input id="customers.customer_additive" text="Zusatz"/>
            </div>
            <div class="col-span-12">
                <x-ag.forms.label for="customers.customer_street" text="Straße" stern="true"/>
                <x-ag.forms.input id="customers.customer_street" text="Straße"/>
            </div>
            <div class="col-span-6 sm:col-span-2">
                <x-ag.forms.label for="customers.customer_country" text="Land" stern="true"/>
                <x-ag.forms.select id="customers.customer_country" wire:ignore>
                    <option value="">bitte Auswählen</option>
                    @foreach(countryCode() as $country)
                        <option value="{{ $country['code'] }}" wire:key="{{ $customers['customer_country'] }}">{{ $country['code'] }}</option>
                    @endforeach
                </x-ag.forms.select>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-ag.forms.label for="customers.customer_post_code" text="Postleitzahl" stern="true"/>
                <x-ag.forms.input type="number" step="0" id="customers.customer_post_code" text="Postleitzahl"/>
            </div>
            <div class="col-span-12 sm:col-span-7">
                <x-ag.forms.label for="customers.customer_location" text="Wohnort" stern="true"/>
                <x-ag.forms.input id="customers.customer_location" text="Wohnort"/>
            </div>
        </div>
    </x-ag.card.head>
</div>
