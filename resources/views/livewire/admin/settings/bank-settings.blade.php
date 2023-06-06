<div>
    <form wire:submit.prevent="store">
        <div class="grid grid-cols-1 px-4 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900">
            <div class="col-span-1">
                <x-ag.card.head>
                    <h3 class="mb-4 text-xl font-semibold dark:text-white">Bankverbindungen</h3>
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.label-input id="bank.bank_account_owner" text="Kontoinhaber" tabindex="1" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.label-input id="bank.bank_bank_name" text="Bankname" tabindex="1" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.label-input id="bank.bank_iban" text="IBAN" tabindex="1" stern="true" />
                        </div>
                        <div class="col-span-12 sm:col-span-6">
                            <x-ag.forms.label-input id="bank.bank_bic" text="BIC" tabindex="1" stern="true" />
                        </div>
                        <input type="hidden" wire:model="settingsID">
                        <input type="hidden" wire:model="bank.id">
                        <div class="col-span-12 sm:col-full">
                            <x-ag.button.loading-button target="store" class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:text-white dark:hover:bg-primary-700 dark:focus:ring-primary-800 border-0" />
                        </div>
                    </div>
                </x-ag.card.head>
            </div>
        </div>
    </form>
</div>
