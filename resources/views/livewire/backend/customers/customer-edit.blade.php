<div>
    <div class="grid grid-cols-1 p-4 pb-0 xl:grid-cols-3 xl:gap-4 dark:bg-gray-900">
        <div class="mb-4 col-span-full xl:mb-2">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('customersEdit', $customers) !!}
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Kunden bearbeiten: {{ $customers->fullname() }}</h1>
                <x-ag.errors.errorMessages />
            </div>
        </div>
    </div>
    <x-ag.main.head>
        {{-- Customers --}}
        <form wire:submit.prevent="store" method="POST" class="p-4">
            <input type="hidden" wire:model="customers.id">
            <div class="grid grid-cols-1 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900">
                {{-- Left --}}
                @include('livewire.backend.customers.customers-forms-address')
                {{-- Right --}}
                @include('livewire.backend.customers.customers-forms-fibu-kondition-sonstiges')
            </div>
            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Ausländischer Kunde</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6 sm:col-full">
                                <x-ag.forms.input-checkbox id="customers.customer_net_invoice" wire:model="customers.customer_net_invoice" text="Dieser Kunde bekommt eine Netto-Rechnung" />
                            </div>
                            <div class="col-span-6 sm:col-full">
                                <x-ag.forms.inline-label-input id="customers.customer_vat_number" text="Ust. - Identifikationsnummer" />
                            </div>
                        </div>
                    </x-ag.card.head>
                    <x-ag.card.head>
                        <h3 class="mb-4 text-xl font-semibold dark:text-white">Anmerkung</h3>
                        <div class="grid grid-cols-12 gap-4">
                            <div class="col-span-6 sm:col-full">
                                <x-ag.forms.input-checkbox id="customers.customer_net_invoice" wire:model="customers.customer_show_notes_issues" text="Anmerkung bei neuen Vorgängen anzeigen" />
                            </div>
                            <div class="col-span-6 sm:col-full">
                                <x-ag.forms.input-checkbox id="customers.customer_net_invoice" wire:model="customers.customer_show_notes_appointments" text="Anmerkung bei neuen Terminen anzeigen" />
                            </div>
                            <div class="col-span-12">
                                <x-ag.forms.textarea id="customers.customer_notes" text="" rows="10" />
                            </div>
                        </div>
                    </x-ag.card.head>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 dark:bg-gray-900">
                <div class="col-span-1">
                    {{--                <x-ag.card.head>--}}
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-6 sm:col-full"></div>
                        <div class="col-span-6 sm:col-full">
                            <div class="flex items-center justify-end space-x-1">
                                <x-ag.button.loading-button text="Speichern" class=""/>
                                <x-ag.button.a-link href="{{ route('backend.kunden.index') }}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
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

