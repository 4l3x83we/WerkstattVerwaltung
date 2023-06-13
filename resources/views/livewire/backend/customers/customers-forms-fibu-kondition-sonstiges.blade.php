<div class="col-span-1">
    {{-- Kommunikation --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Kommunikation</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.label for="customers.customer_phone" text="Telefon" />
                <x-ag.forms.input type="tel" id="customers.customer_phone" text="Telefon" />
            </div>
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.label for="customers.customer_phone_business" text="Telefon gesch." />
                <x-ag.forms.input type="tel" id="customers.customer_phone_business" text="Telefon gesch." />
            </div>
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.label for="customers.customer_fax" text="Fax" />
                <x-ag.forms.input type="tel" id="customers.customer_fax" text="Fax" />
            </div>
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.label for="customers.customer_mobil_phone" text="Mobil" />
                <x-ag.forms.input type="tel" id="customers.customer_mobil_phone" text="Mobil" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.label for="customers.customer_email" text="E-Mail Adresse" />
                <x-ag.forms.input type="email" id="customers.customer_email" text="E-Mail Adresse" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.label for="customers.customer_website" text="Internetseite" />
                <x-ag.forms.input type="url" id="customers.customer_website" text="Internetseite" />
            </div>
        </div>
    </x-ag.card.head>

    {{-- FIBU / Konditionen --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">FIBU / Konditionen</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.inline-input-group-r type="number" step="0.00" id="financialAccountingConditions.conditions_discount_items" text="Rabatt Artikel" icon="%" />
            </div>
            <div class="col-span-6 sm:col-full">
                <x-ag.forms.inline-input-group-r type="number" step="0.00" id="financialAccountingConditions.conditions_discount_labor_values" text="Rabatt AW" icon="%" />
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="financialAccountingConditions.financial_terms_of_payment" text="Zahlungsbedienungen" wire:ignore>
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['termsOfPayment'] as $payment)
                        <option value="{{ $payment->name }}" wire:key="{{ $financialAccountingConditions['financial_terms_of_payment'] }}">{{ $payment->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-select id="financialAccountingConditions.financial_price_group" text="Preisgruppe" wire:ignore>
                    <option value="">bitte Auswählen</option>
                    @foreach(json()['priceGroup'] as $priceGroup)
                        <option value="{{ $priceGroup->name }}" wire:key="{{ $financialAccountingConditions['financial_price_group'] }}">{{ $priceGroup->name }}</option>
                    @endforeach
                </x-ag.forms.inline-select>
            </div>
            <div class="col-span-12">
                <x-ag.forms.inline-label-input id="financialAccountingConditions.financial_debtor_number" text="Debitor-Nr." />
            </div>
        </div>
    </x-ag.card.head>

    {{-- Datenschutz --}}
    <x-ag.card.head>
        <h3 class="mb-4 text-xl font-semibold dark:text-white">Datenschutzrechtliche Einwilligungserklärung</h3>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-ag.forms.inline-label-input type="date" id="data.issued_on" text="Erteilt am"/>
            </div>
            <div class="flex flex-row flex-wrap gap-4 col-span-12">
                <x-ag.forms.checkbox id="data.letters" wire:model="data.letters" text="Briefe" />
                <x-ag.forms.checkbox id="data.phone" wire:model="data.phone" text="Telefon" />
                <x-ag.forms.checkbox id="data.fax" wire:model="data.fax" text="Fax" />
                <x-ag.forms.checkbox id="data.mobile_phone" wire:model="data.mobile_phone" text="Mobil" />
                <x-ag.forms.checkbox id="data.text_message" wire:model="data.text_message" text="SMS" />
                <x-ag.forms.checkbox id="data.whatsapp" wire:model="data.whatsapp" text="WhatsApp" />
                <x-ag.forms.checkbox id="data.email" wire:model="data.email" text="E-Mail" />
                <x-ag.forms.checkbox id="selectAll" wire:model="selectAll" text="Alle" />
            </div>
        </div>
    </x-ag.card.head>
</div>
