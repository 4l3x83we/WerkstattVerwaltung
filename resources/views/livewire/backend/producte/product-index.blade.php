<div>
    @if(count($produkte) > 0)
        <x-ag.table.table>
            <x-slot:thead>
                <x-ag.table.th>#</x-ag.table.th>
                <x-ag.table.th>Artikelnummer <x-ag.table.th-sortBy id="product_artnr" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_artnr')"/></x-ag.table.th>
                <x-ag.table.th>Bezeichnung <x-ag.table.th-sortBy id="product_name" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_name')"/></x-ag.table.th>
                <x-ag.table.th>EAN <x-ag.table.th-sortBy id="product_ean" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_ean')"/></x-ag.table.th>
                <x-ag.table.th>Bestand <x-ag.table.th-sortBy id="product_qty" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_qty')"/></x-ag.table.th>
                <x-ag.table.th>Netto EK <x-ag.table.th-sortBy id="product_price_netto_ek" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_price_netto_ek')"/></x-ag.table.th>
                <x-ag.table.th>Netto VK <x-ag.table.th-sortBy id="product_price_netto_vk" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_price_netto_vk')"/></x-ag.table.th>
                <x-ag.table.th>Brutto VK <x-ag.table.th-sortBy id="product_price_brutto_vk" :field="$sortField" :direction="$sortDirection" wire:click="sortBy('product_price_brutto_vk')"/></x-ag.table.th>
                <x-ag.table.th></x-ag.table.th>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($produkte as $key => $produkt)
                    <x-ag.table.tr>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $key + 1 }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->product_artnr }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->product_name }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->product_ean }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->product_qty }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->nettoEK() }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->nettoVK() }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $produkt->id }})">{{ $produkt->bruttoVK() }}</td>
                        <td class="p-2 text-right">
                            @can('edit')
                                <x-ag.button.link wire:click="edit({{ $produkt->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </x-ag.button.link>
                            @endcan
                            @can('delete')
                                <x-ag.button.link wire:click="$emit('triggerDelete',{{ $produkt->id }})" class="px-2 text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </x-ag.button.link>
                            @endcan
                        </td>
                    </x-ag.table.tr>
                @empty
                    <x-ag.table.tr>
                        <td colspan="9" class="p-2 text-center font-bold text-lg">Es wurde kein Artikel gefunden.</td>
                    </x-ag.table.tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table.table>
        {{ $produkte->links() }}
        @push('scripts')
            @include('livewire.delete')
        @endpush
    @endif
</div>
