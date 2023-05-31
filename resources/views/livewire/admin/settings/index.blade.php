<div>
    <div class="grid grid-cols-1 p-4 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('settings') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Einstellungen</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
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
                            <x-ag.forms.label-input id="settings.company_email" text="E-Mail Adresse" stern="true" tabindex="2" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_address_1" text="Anschrift" stern="true" tabindex="3" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_address_2" text="Anschrift zusatz" tabindex="4" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_post_code" text="Postleitzahl" stern="true" tabindex="5" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_city" text="Ort" stern="true" tabindex="6" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="settings.company_country" text="Land" stern="true" />
                            <x-ag.forms.select id="settings.company_country" tabindex="7">
                                @foreach(countryCode() as $country)
                                    <option value="{{ $country['code'] }}">{{ $country['name'] }}</option>
                                @endforeach
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.company_phone" text="Telefon" stern="true" tabindex="8" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="images" text="Logo" stern="true" />
                            <x-ag.forms.input-file type="file" id="images" tabindex="9" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <div class="flex justify-center">
                            <img src="{{ $settings['logo'] }}" alt="Firmenlogo" style="width: {{ $settings['company_logo_width'] ?? '300' }}px; height: {{ $settings['company_logo_height'] ?? '90' }}px;" class="object-scale-down object-center" />
                            </div>
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
            <div class="col-span-1">
                <x-ag.card.head>
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Rechnungseinstellungen</h3>
                    <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.invoice_prefix" text="Rechnungspräfix" tabindex="10" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="settings.enable_tax" text="Steuer aktivieren" stern="true" />
                            <div class="flex py-2.5">
                                <x-ag.forms.checkbox-radio type="radio" id="settings.enable_tax" text="Nein" value="0" tabindex="11"/>
                                <x-ag.forms.checkbox-radio type="radio" id="settings.enable_tax" text="Ja" value="1" tabindex="11"/>
                            </div>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.invoice_initial_value" text="Anfangswert der Rechnungsnummer" tabindex="12" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label for="settings.include_tax" text="inklusive Steuer" stern="true" />
                            <x-ag.forms.select id="settings.include_tax" tabindex="13">
                                <option value="0"  {{ $settings['include_tax'] == 0 ? 'selected' : '' }}>Nein</option>
                                <option value="1" {{ $settings['include_tax'] == 1 ? 'selected' : '' }}>Ja</option>
                            </x-ag.forms.select>
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.currency" text="Währung" tabindex="14" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-span-3">
                            <x-ag.forms.label-input id="settings.tax_rate" text="Steuersatz" tabindex="15" stern="true" />
                        </div>
                        <div class="col-span-6 sm:col-full">
                            <x-ag.button.loading-button target="store" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
        </div>
    </form>
</div>
