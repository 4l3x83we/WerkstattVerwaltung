<div><div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('productCreate') !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Produkt hinzufügen</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <form wire:submit.prevent="store" method="POST">
            <input type="hidden" wire:model="products.id">
            <div class="grid grid-cols-1 xl:grid-cols-2 p-4 pb-0 gap-4 dark:bg-gray-900">
                {{-- Left --}}
                <div class="col-span-1">
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Artikeldaten</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.inline-select id="products.product_hersteller" text="Hersteller">
                                    <option value="" selected>Bitte auswählen</option>
                                    @foreach($json['hersteller'] as $hersteller)
                                        <option value="{{ $hersteller->name }}">{{ $hersteller->name }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="products.product_artnr" text="Artikelnummer"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="products.product_name" text="Artikelname"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="products.product_name_zusatz" text="Artikelname Zusatz"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input type="number" max="13" id="products.product_ean" text="EAN"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="products.product_ersetzung" text="Ersetzung"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-select id="products.product_einheit" text="Einheiten">
                                    <option value="" selected>Bitte auswählen</option>
                                    @foreach($json['einheiten'] as $einheiten)
                                        <option value="{{ $einheiten->name }}">{{ $einheiten->name }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-select id="category.category_id" text="Kategorie">
                                    <option selected>Bitte auswählen</option>
                                    @foreach($allCategories as $category)
                                        <option value="{{ $category->id }}" {{ old('categories.parent_id') == $category->id ? 'selected' : '' }}>{{ $category->category_title }}</option>
                                        @foreach($category->childCategories as $childCategory)
                                            <option value="{{ $childCategory->id }}" {{ old('categories.parent_id') == $childCategory->id ? 'selected' : '' }}>{{ '-- ' . $childCategory->category_title }}</option>
                                            @foreach($childCategory->childCategories as $childCategory)
                                                <option value="{{ $childCategory->id }}" {{ old('categories.parent_id') == $childCategory->id ? 'selected' : '' }}>{{ '---- ' . $childCategory->category_title }}</option>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Preise</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.inline-input-group-r type="number" step="0.01" value="0.00" id="products.product_price_netto_ek" text="Einkaufspreis Netto">
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.inline-input-group-r>
                            </div>
                            <div class="col-span-12">
                                @if($priceNettoBrutto)
                                <x-ag.forms.inline-input-group-r type="number" step="0.01" value="0.00" id="products.product_price_netto_vk" text="Verkaufspreis Netto" readonly>
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.inline-input-group-r>
                                @else
                                <x-ag.forms.inline-input-group-r type="number" step="0.01" value="0.00" id="products.product_price_netto_vk" text="Verkaufspreis Netto" >
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.inline-input-group-r>
                                @endif
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-select id="products.product_mwst" text="MwSt." wire:ignore>
                                    @foreach($products['mwst'] as $mwst)
                                        <option value="{{ $mwst['wert'] }}">{{ $mwst['name'] }}</option>
                                    @endforeach
                                </x-ag.forms.inline-select>
                            </div>
                            <div class="col-span-12">
                                @if(!$priceNettoBrutto)
                                <x-ag.forms.inline-input-group-r type="number" step="0.01" value="0.00" id="products.product_price_brutto_vk" text="Verkaufspreis Brutto" readonly>
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.inline-input-group-r>
                                @else
                                <x-ag.forms.inline-input-group-r type="number" step="0.01" value="0.00" id="products.product_price_brutto_vk" text="Verkaufspreis Brutto">
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.inline-input-group-r>
                                @endif
                            </div>
                            <div class="col-span-12">
                                <div class="flex items-center justify-end h-[38px]">
                                    <x-ag.forms.checkbox-radio class="rounded" value="1" wire:model="products.price_netto_brutto" id="products.price_netto_brutto" text="Preis ist Brutto" />
                                </div>
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head class="!mb-0">
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Lager</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-3"></div>
                            <div class="col-span-9">
                                <x-ag.forms.checkbox-radio class="rounded" wire:model="products.no_warehouse_management" wire:key="products.no_warehouse_management" id="products.no_warehouse_management" value="1" text="keine Lagerführung" />
                            </div>
                            @if(!$products['no_warehouse_management'])
                                <div class="col-span-12">
                                    <x-ag.forms.inline-label-input id="products.product_qty" text="Aktueller Bestand"/>
                                </div>
                                <div class="col-span-12">
                                    <x-ag.forms.inline-label-input id="stock.stock_reserved" text="Reserviert" readonly/>
                                </div>
                            @else
                                <div class="col-span-12">
                                    <x-ag.forms.inline-label-input id="products.product_qty" text="Aktueller Bestand" readonly/>
                                </div>
                                <div class="col-span-12">
                                    <x-ag.forms.inline-label-input id="stock.stock_reserved" text="Reserviert" readonly/>
                                </div>
                            @endif
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="stock.stock_available" text="Verfügbar" readonly/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input id="stock.storage_location" text="Lagerort"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input type="number" step="0.01" id="stock.minimum_amount" text="Mindestmenge"/>
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.inline-label-input type="number" step="0.01" id="stock.maximum_amount" text="Maximale Menge"/>
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
                {{-- Right --}}
                <div class="col-span-1">
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Preisgruppen</h3>
                        <div class="grid grid-cols-12 gap-4">
                            @for($i = 1; $i <= 5; $i++)
                            <div class="col-span-6 sm:col-span-3">
                                <div class="flex items-center h-[42px]">
                                    <x-ag.forms.label for="price_groups.priceGroup_price_vk_{{ $i }}" text="Preisgruppe {{ $i }}" class="xl:mb-0" />
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-ag.forms.igr type="number" step="0.01" value="0.00" id="price_groups.priceGroup_price_vk_{{ $i }}" text="Verkaufspreis Netto" tabindex="{{ $i }}.1" >
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.igr>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-ag.forms.igr type="number" step="0.01" value="0.00" id="price_groups.priceGroup_price_vk_brutto_{{ $i }}" text="Verkaufspreis Brutto" tabindex="{{ $i }}.2" readonly>
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                            <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.igr>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                                <x-ag.forms.igr id="price_groups.priceGroup_marge_{{ $i }}" text="Marge in %" readonly>
                                    <x-slot:icon>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-percent" viewBox="0 0 16 16">
                                            <path d="M13.442 2.558a.625.625 0 0 1 0 .884l-10 10a.625.625 0 1 1-.884-.884l10-10a.625.625 0 0 1 .884 0zM4.5 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm7 6a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm0 1a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                                        </svg>
                                    </x-slot:icon>
                                </x-ag.forms.igr>
                            </div>
                            @endfor
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.checkbox-radio class="rounded" value="true" wire:model="products.product_not_price_update" id="products.product_not_price_update" text="Preise nicht aktualisieren" />
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Notiz</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.textarea id="products.product_notes" text="" rows="9"/>
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Beschreibung</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.textarea id="products.product_desc" text="" rows="16"/>
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Bilder</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-12">
                                <x-ag.forms.filepond />
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
            </div>
            <div class="grid grid-cols-1 p-4 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
    {{--                <x-ag.card.head>--}}
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6 sm:col-full"></div>
                            <div class="col-span-6 sm:col-full">
                                <div class="flex items-center justify-end space-x-1">
                                    <x-ag.button.loading-button text="Speichern" class=""/>
                                    <x-ag.button.a-link class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                        Abbrechen
                                    </x-ag.button.a-link>
                                </div>
                            </div>
                        </div>
    {{--                </x-ag.card.head>--}}
                </div>
            </div>
        </form>
    </x-ag.main.head>
</div>