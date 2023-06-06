<div>
    <div class="px-4">
        <x-ag.errors.errorMessages />
    </div>
    <form wire:submit.prevent="store">
        <input type="hidden" wire:model="settings.id">
        <div class="grid grid-cols-1 p-4 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900">
            <div class="col-span-1">
                <x-ag.card.head>
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Firmeninformationen</h3>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_name" text="Firmenname" stern="true" tabindex="1" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_addition" text="Firmenzusatz" tabindex="2" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_street" text="Anschrift" stern="true" tabindex="3" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_post_code" text="Postleitzahl" stern="true" tabindex="4" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_city" text="Ort" stern="true" tabindex="5" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="settings.company_country" text="Land" stern="true" />
                            <x-ag.forms.select id="settings.company_country" tabindex="6">
                                @foreach(countryCode() as $country)
                                    <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_email" type="email" text="E-Mail Adresse" stern="true" tabindex="7" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_website" type="url" text="Webseite" stern="true" tabindex="7" />
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            @if($settings['company_mobil'])
                                <x-ag.forms.label-input id="settings.company_telefon" type="tel" text="Telefon" tabindex="8" />
                            @else
                                <x-ag.forms.label-input id="settings.company_telefon" type="tel" text="Telefon" stern="true" tabindex="8" />
                            @endif
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            @if($settings['company_telefon'])
                                <x-ag.forms.label-input id="settings.company_mobil" type="tel" text="Mobil" tabindex="9" />
                            @else
                                <x-ag.forms.label-input id="settings.company_mobil" type="tel" text="Mobil" stern="true" tabindex="9" />
                            @endif
                        </div>
                        <div class="col-span-6 sm:col-span-2">
                            <x-ag.forms.label-input id="settings.company_fax" type="tel" text="Fax" tabindex="10" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_tax_number" text="Steuernummer" stern="true" tabindex="10.1" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_vat_number" text="USt-IdNr.:" stern="true" tabindex="10.2" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="images" text="Logo" stern="true" />
                            <x-ag.forms.input-file type="file" id="images" tabindex="11" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex justify-center">
                                @if($settings['logo'])
                                    <img src="{{ $settings['logo'] }}" alt="Firmenlogo" style="width: {{ $settings['company_logo_width'] ?? '300' }}px; height: {{ $settings['company_logo_height'] ?? '90' }}px;" class="object-scale-down object-center" />
                                @else
                                    @if($settings['company_logo'])
                                        <img src="{{ asset($settings['company_logo']) }}" alt="Firmenlogo" style="width: {{ $settings['company_logo_width'] ?? '300' }}px; height: {{ $settings['company_logo_height'] ?? '90' }}px;" class="object-scale-down object-center" />
                                    @else
                                        <img src="{{ $settings['logo'] }}" alt="Firmenlogo" style="width: 300px; height: 90px;" class="object-scale-down object-center" />
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
            <div class="col-span-1">
                <x-ag.card.head>
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Rechnungseinstellungen</h3>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.invoice_prefix" text="Rechnungspräfix" tabindex="12" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.offer_prefix" text="Angebotspräfix" tabindex="13" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.order_prefix" text="Auftragspräfix" tabindex="14" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.delivery_note_prefix" text="Lieferscheinpräfix" tabindex="15" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.invoice_correction_prefix" text="Rechnungskorrekturpräfix" tabindex="16" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.cost_estimate_prefix" text="Kostenvoranschlagpräfix" tabindex="17" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.label-input id="settings.invoice_initial_value" text="Anfangswert der Rechnungsnummer" tabindex="18" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6"></div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label-input id="settings.currency" text="Währung" tabindex="19" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label for="settings.enable_tax" text="Steuer aktivieren" stern="true" />
                            <div class="flex py-2.5">
                                <x-ag.forms.checkbox-radio type="radio" id="false" wire:model="settings.enable_tax" text="Nein" value="0" tabindex="20"/>
                                <x-ag.forms.checkbox-radio type="radio" id="true" wire:model="settings.enable_tax" text="Ja" value="1" tabindex="20"/>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-4">
                            <x-ag.forms.label for="settings.include_tax" text="inklusive Steuer" stern="true" />
                            <x-ag.forms.select id="settings.include_tax" tabindex="21">
                                <option value="0"  {{ $settings['include_tax'] == 0 ? 'selected' : '' }}>Nein</option>
                                <option value="1" {{ $settings['include_tax'] == 1 ? 'selected' : '' }}>Ja</option>
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.tax_rate_full" text="voller Steuersatz" tabindex="22" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.tax_rate_reduced" text="erm. Steuersatz" tabindex="23" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.tax_rate_free" text="kein Steuersatz" tabindex="24" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.tax_rate_core" text="Altteilsteuersatz" tabindex="25" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.checkbox-radio type="checkbox" class="rounded" id="settings.enable_19UStG" text="Kleinunternehmer gem. § 19 UStG" value="0" tabindex="26"/>
                        </div>
                        <div class="col-span-12 sm:col-full">
                            <x-ag.button.loading-button target="store" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
        </div>
    </form>
</div>
