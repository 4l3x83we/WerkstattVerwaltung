<x-ag.modal wire:model="show">
    <!-- Modal header -->
    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Kassenbucheintrag Nr. {{ $cashBook_nr }}
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" wire:click="closeModal()">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <div class="grid grid-cols-12 gap-4 p-4">
        <div class="col-span-12 space-y-2">
            <label for="methodCashBook" class="inline-flex text-xs items-center rounded cursor-pointer font-medium border border-gray-200 dark:border-gray-600 w-full duration-300">
                <input type="checkbox" wire:model="methodCashBook" id="methodCashBook" class="hidden peer">
                <span class="px-4 py-2 rounded-l w-full text-center bg-red-500 text-white peer-checked:bg-white peer-checked:text-gray-900 peer-checked:dark:bg-gray-800 peer-checked:dark:text-gray-400">
                    <div class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 448 512">
                            <path d="M432 256c0 17.7-14.3 32-32 32L48 288c-17.7 0-32-14.3-32-32s14.3-32 32-32l352 0c17.7 0 32 14.3 32 32z"/>
                        </svg>
                        Auszahlung
                    </div>
                </span>
                <span class="px-4 py-2 rounded-r w-full text-center bg-white text-gray-900 dark:bg-gray-800 dark:text-gray-400 peer-checked:bg-green-500 peer-checked:text-white peer-checked:dark:bg-green-500 peer-checked:dark:text-white">
                    <div class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                        </svg>
                        Einzahlung
                    </div>
                </span>
            </label>
        </div>
        <div class="col-span-12 lg:col-span-6 space-y-2">
            @if(!$methodCashBook)
                <x-ag.forms.label for="cashBook.cashBook_output_amount" text="Zahlungsbetrag (€)" stern="true"/>
                <x-ag.forms.input type="number" step="0.01" id="cashBook.cashBook_output_amount" text="Zahlungsbetrag (€)" stern="true" style="color: #E02424;"/>
            @else
                <x-ag.forms.label for="cashBook.cashBook_revenue_amount" text="Zahlungsbetrag (€)" stern="true"/>
                <x-ag.forms.input type="number" step="0.01" id="cashBook.cashBook_revenue_amount" text="Zahlungsbetrag (€)" stern="true" style="color: #0E9F6E;"/>
            @endif
        </div>
        <div class="col-span-12 lg:col-span-6 space-y-2">
            <x-ag.forms.label for="cashBook.cashBook_date" text="Zahlungsdatum"/>
            <x-ag.forms.input type="date" id="cashBook.cashBook_date" text="Zahlungsdatum"/>
        </div>
        <div class="col-span-12 space-y-2">
            <div class="flex justify-between">
                <span>Kassenstand nach dem Kassenbucheintrag:</span>
                <span>{{ number_format($saldo, 2, ',', '.') . ' €' }}</span>
            </div>
            <x-ag.forms.label for="cashBook.cashBook_desc" text="Beschreibung"/>
            <x-ag.forms.input id="cashBook.cashBook_desc" text="Beschreibung"/>
        </div>
    </div>
    <!-- Modal footer -->
    <div class="p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">

                <x-ag.button.link type="button" wire:click="new" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 448 512">
                        <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/>
                    </svg>
                    Kassenbucheintrag hinzufügen
                </x-ag.button.link>

            </div>
            <div class="col-span-6">
                <x-ag.button.button wire:click="closeModal" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Abbrechen
                </x-ag.button.button>
            </div>
        </div>
    </div>
</x-ag.modal>
