<x-ag.modal wire:model="show">
    <!-- Modal header -->
    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Auftrag per E-Mail versenden
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
        <div class="col-span-12 lg:col-span-6 space-y-2">
            <x-ag.forms.label for="customer.customer_email" text="Empfängeradresse" stern="true"/>
            <x-ag.forms.input id="customer.customer_email" text="Empfängeradresse"/>
            <x-ag.forms.label for="mail.cc_email" text="CC Empfängeradresse"/>
            <x-ag.forms.input id="mail.cc_email" text="CC Empfängeradresse"/>
        </div>
        <div class="col-span-12 lg:col-span-6 space-y-2">
            <div style="height: 66px;"></div>
            <x-ag.forms.label for="mail.bcc_email" text="BCC Empfängeradresse"/>
            <x-ag.forms.input id="mail.bcc_email" text="BCC Empfängeradresse"/>
        </div>
        <div class="col-span-12 space-y-2">
            <x-ag.forms.label for="mail.subject" text="Betreff"/>
            <x-ag.forms.input id="mail.subject" text="Betreff"/>
            <x-ag.forms.textarea id="mail.text" text="Nachricht" rows="15"/>
        </div>
    </div>
    <!-- Modal footer -->
    <div class="p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">

                <x-ag.button.link type="button" wire:click="mail" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1 -rotate-45">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/>
                    </svg>
                    E-Mail Senden
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
