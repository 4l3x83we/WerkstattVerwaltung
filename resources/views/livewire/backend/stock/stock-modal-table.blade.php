<x-ag.modal wire:model="show" maxWidth="7xl">
    <!-- Modal header -->
    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
            Lagerbewegung: {{ $products->product_name }} - {{ $products->product_artnr }}
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:text-white" wire:click="closeModal()">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close modal</span>
        </button>
    </div>
    <!-- Modal body -->
    <div class="grid grid-cols-12 gap-4 p-4">
        <div class="col-span-12">
            @if(!$newForm)
            <div class="relative overflow-x-auto">
                <x-ag.table.table>
                    <x-slot:thead>
                        <x-ag.table.th>Datum</x-ag.table.th>
                        <x-ag.table.th>Anzahl</x-ag.table.th>
                        <x-ag.table.th>Anmerkung</x-ag.table.th>
                        <x-ag.table.th class="w-9"></x-ag.table.th>
                    </x-slot:thead>
                    <x-slot:tbody>
                        @if(count($stockMovements) > 0)
                            @foreach($stockMovements as $stockMovement)
                            <x-ag.table.tr class="text-sm">
                                <td class="p-2 whitespace-nowrap">{{ $stockMovement->stockMovementDate() }}</td>
                                <td class="p-2 whitespace-nowrap">{{ $stockMovement->stock_movement_qty }}</td>
                                <td class="p-2 overflow-hidden font-normal truncate max-w-sm xl:max-w-xs">
                                    {{ $stockMovement->stock_movement_note }}
                                </td>
                                <td class="p-2 whitespace-nowrap w-9">
                                    <div class="text-right">
                                    @can('delete')
                                        <x-ag.button.link type="button" wire:click="$emit('triggerDelete',{{ $stockMovement->id }})" class="px-2 text-red-500 hover:text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </x-ag.button.link>
                                    @endcan
                                    </div>
                                    @push('scripts')
                                        @include('livewire.delete')
                                    @endpush
                                </td>
                            </x-ag.table.tr>
                            @endforeach
                            <x-ag.table.tr class="text-sm text-green-500 font-bold">
                                <td class="p-2 whitespace-nowrap"><div class="text-right">Gesamt:</div></td>
                                <td class="p-2 whitespace-nowrap">{{ $stockMovementTotal }}</td>
                                <td class="p-2 whitespace-nowrap" colspan="2"></td>
                            </x-ag.table.tr>
                        @else
                            <x-ag.table.tr class="text-lg text-center font-bold">
                                <td class="p-2 whitespace-nowrap" colspan="4">Es wurden noch keine Lagerbewegungen festgestellt.</td>
                            </x-ag.table.tr>
                        @endif
                    </x-slot:tbody>
                </x-ag.table.table>
            </div>
            @else
                <form wire:submit.prevent="newStock">
                    <input type="hidden" wire:model="stockMovement.product_id" />
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-12 sm:col-span-6">
                        <x-ag.forms.label-input type="date" id="stockMovement.stock_movement_date" text="Datum" stern="true" />
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <x-ag.forms.label-input id="stockMovement.stock_movement_qty" text="Menge" stern="true" />
                        <input type="hidden" wire:model="stockMovement.stock_available" />
                    </div>
                    <div class="col-span-12">
                        <x-ag.forms.textarea id="stockMovement.stock_movement_note" text="Anmerkung" />
                    </div>
                    <div class="col-span-12">
                        <x-ag.button.button type="submit" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-600 dark:focus:ring-blue-900">
                            <svg aria-hidden="true" class="w-4 h-4 mr-2 -ml-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/></svg>
                            Speichern
                        </x-ag.button.button>
                    </div>
                </div>
                </form>
            @endif
        </div>
    </div>
    <!-- Modal footer -->
    <div class="p-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-6">
                @if(!$newForm)
                <x-ag.button.link type="button" wire:click="new" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                    Neu
                </x-ag.button.link>
                @endif
            </div>
            <div class="col-span-6">
                <x-ag.button.button wire:click="closeModal" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded text-xs px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900 inline-flex items-center duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-4 h-4 mr-2 -ml-1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Abbrechen
                </x-ag.button.button>
            </div>
        </div>
    </div>
</x-ag.modal>
