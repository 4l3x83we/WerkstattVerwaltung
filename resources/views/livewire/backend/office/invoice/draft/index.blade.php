@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('draft') !!}
                <div class="inline-flex items-center">
                    <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white mr-4">Rechnungen</h1>
                    <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                        <x-ag.forms.search/>
                    </div>
                </div>
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                    <li class="mr-2">
                        <a href="{{ route('backend.invoice.order.index-order') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 512 512"><path d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/></svg>Auftrag
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ route('backend.invoice.entwurf.index') }}" class="inline-flex p-4 text-orange-600 border-b-2 border-orange-600 rounded-t-lg active dark:text-orange-500 dark:border-orange-500 group" aria-current="page">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-orange-600 dark:text-orange-500" fill="currentColor" viewBox="0 0 384 512"><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>Entwurf
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ route('backend.invoice.offen.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 384 512"><path d="M32 0C14.3 0 0 14.3 0 32S14.3 64 32 64V75c0 42.4 16.9 83.1 46.9 113.1L146.7 256 78.9 323.9C48.9 353.9 32 394.6 32 437v11c-17.7 0-32 14.3-32 32s14.3 32 32 32H64 320h32c17.7 0 32-14.3 32-32s-14.3-32-32-32V437c0-42.4-16.9-83.1-46.9-113.1L237.3 256l67.9-67.9c30-30 46.9-70.7 46.9-113.1V64c17.7 0 32-14.3 32-32s-14.3-32-32-32H320 64 32zM96 75V64H288V75c0 19-5.6 37.4-16 53H112c-10.3-15.6-16-34-16-53zm16 309c3.5-5.3 7.6-10.3 12.1-14.9L192 301.3l67.9 67.9c4.6 4.6 8.6 9.6 12.1 14.9H112z"/></svg>Offen
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ route('backend.invoice.bezahlt.index') }}" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 576 512"><path d="M96 80c0-26.5 21.5-48 48-48H432c26.5 0 48 21.5 48 48V384H96V80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48H64V416H512V288h16c26.5 0 48 21.5 48 48v96c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V336z"/></svg>Bezahlt
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 640 512"><path d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z"/></svg>Storno/Gutschrift
                        </a>
                    </li>
                    <li>
                        <a href="#" class="inline-flex p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 576 512"><path d="M384 480h48c11.4 0 21.9-6 27.6-15.9l112-192c5.8-9.9 5.8-22.1 .1-32.1S555.5 224 544 224H144c-11.4 0-21.9 6-27.6 15.9L48 357.1V96c0-8.8 7.2-16 16-16H181.5c4.2 0 8.3 1.7 11.3 4.7l26.5 26.5c21 21 49.5 32.8 79.2 32.8H416c8.8 0 16 7.2 16 16v32h48V160c0-35.3-28.7-64-64-64H298.5c-17 0-33.3-6.7-45.3-18.7L226.7 50.7c-12-12-28.3-18.7-45.3-18.7H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H87.7 384z"/></svg>Alle
                        </a>
                    </li>
                </ul>
            </div>
            <div class="sm:flex">
                <div class="items-center hidden mb-3 sm:flex sm:divide-x sm:divide-gray-100 sm:mb-0 dark:divide-gray-700">
                    @can('create')
                        <x-ag.button.a-link href="{{ route('backend.invoice.order.create-order') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('add new Order') }}
                        </x-ag.button.a-link>
                    @endcan
                </div>
                <div class="flex items-center ml-auto space-x-2 sm:space-x-3">
                    <span>Offene Zahlungen&nbsp;</span>
                    @if($outstanding_payments < 0)
                        <span class="text-red-600">{{ $outstanding_payments }}</span>
                    @else
                        <span class="text-green-500">{{ $outstanding_payments }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        {{--                @if(count($invoices) > 0)--}}
        <x-ag.table.table>
            <x-slot:thead>
                <x-ag.table.th></x-ag.table.th>
                <x-ag.table.th>Status</x-ag.table.th>
                <x-ag.table.th>Auftragsnummer
                    <x-ag.table.th-sortBy id="customer_kdnr" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('customer_kdnr')"/>
                </x-ag.table.th>
                <x-ag.table.th>Erstellt am
                    <x-ag.table.th-sortBy id="created_at" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('created_at')"/>
                </x-ag.table.th>
                <x-ag.table.th>Kunde
                    <x-ag.table.th-sortBy id="customers.customer_lastname" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('customers.customer_lastname')"/>
                </x-ag.table.th>
                <x-ag.table.th>Fahrzeug
                    <x-ag.table.th-sortBy id="vehicles.vehicles_brand" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('vehicles.vehicles_brand')"/>
                </x-ag.table.th>
                <x-ag.table.th class="text-right">Gesamt
                    <x-ag.table.th-sortBy id="invoice_total" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('invoice_total')"/>
                </x-ag.table.th>
                <x-ag.table.th class="w-[100px]"></x-ag.table.th>
            </x-slot:thead>
            <x-slot:tbody>
                @forelse($invoices as $key => $invoice)
                    <x-ag.table.tr class="text-sm">
                        <td class="p-2 cursor-pointer">
                            {{--<div class="inline-flex gap-2">
                                @if($invoice->printed)
                                    <x-ag.button.link wire:click="print({{ $invoice->id }})" class="px-2 text-white hover:text-gray-50">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                        </svg>
                                    </x-ag.button.link>
                                @else
                                    <x-ag.button.link wire:click="print({{ $invoice->id }})" class="px-2 text-red-500 hover:text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/>
                                        </svg>
                                    </x-ag.button.link>
                                @endif
                            </div>--}}
                        </td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->order_nr }})">
                            <x-ag.badge color="gray" style="display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 384 512"><path d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z"/></svg>
                                {{ $invoice->invoice_type }}
                            </x-ag.badge>
                        </td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->order_nr }})">{{ $invoice->order_nr }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->order_nr }})">{{ Carbon::parse($invoice->created_at)->format('d.m.Y') }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->order_nr }})">{{ $invoice->customer->fullname() }}</td>
                        <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->order_nr }})">{{ $invoice->vehicle->vehicles_license_plate . ' | ' . $invoice->vehicle->vehicles_brand }}</td>
                        <td class="p-2 text-right cursor-pointer" wire:click="show({{ $invoice->order_nr }})">
                            @if($invoice->invoice_total < 0)
                                <span class="text-red-600">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                            @else
                                <span class="text-green-500">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                            @endif
                        </td>
                        <td class="p-2 text-right">
                            {{--@can('edit')
                                <x-ag.button.link wire:click="edit({{ $invoice->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </x-ag.button.link>
                            @endcan--}}
                            @can('delete')
                                <x-ag.button.link wire:click="$emit('triggerDelete',{{ $invoice->id }})" class="px-2 text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </x-ag.button.link>
                            @endcan
                        </td>
                    </x-ag.table.tr>
                @empty
                    <x-ag.table.tr>
                        <td colspan="8" class="p-2 text-center font-bold text-lg">Es wurde noch keine Aufträge angelegt.</td>
                    </x-ag.table.tr>
                @endforelse
            </x-slot:tbody>
        </x-ag.table.table>
        <div class="w-full p-4 border-t border-gray-200 dark:border-gray-700">
            {{ $invoices->links() }}
        </div>
        @push('scripts')
            @include('livewire.delete')
        @endpush
        {{--                @endif--}}
    </x-ag.main.head>
</div>
