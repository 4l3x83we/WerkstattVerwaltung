@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 bg-white block lg:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('invoicePaid') !!}
                <div class="inline-flex items-center">
                    <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white mr-4">Rechnungen</h1>
                    <div class="items-center hidden mb-3 lg:flex">
                        <x-ag.forms.search/>
                    </div>
                </div>
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                @include('livewire.backend.office.layout.menu')
            </div>
            <div class="lg:flex">
                <div class="items-center flex">
                    @can('create')
                        <x-ag.button.a-link href="{{ route('backend.invoice.offen.create') }}" class="py-2.5 px-5 text-xs font-medium text-gray-900 bg-white rounded border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-primary-700 focus:text-primary-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center duration-300">
                            <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ __('add new Invoice') }}
                        </x-ag.button.a-link>
                        @if(count($invoices) > 0)<div class="ml-4"> {{ $invoices->count() }} @if(count($invoices) === 1) Rechnung @else Rechnungen @endif </div>@endif
                    @endcan
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3"></div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        @include('livewire.backend.office.layout.uebersicht')
        {{--@if(count($invoices) > 0)
            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th></x-ag.table.th>
                    <x-ag.table.th>Status</x-ag.table.th>
                    <x-ag.table.th>Rechnungsnummer
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
                                --}}{{--<div class="inline-flex gap-2">
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
                                </div>--}}{{--
                            </td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">
                                <x-ag.badge color="orange" style="display: inline-flex; align-items: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 384 512"><path d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z"/></svg>
                                    {{ ucfirst($invoice->invoice_status) }}
                                </x-ag.badge>
                            </td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">{{ $invoice->invoice_nr }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">{{ Carbon::parse($invoice->created_at)->format('d.m.Y') }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">{{ $invoice->customer->fullname() }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">{{ $invoice->vehicle->vehicles_license_plate . ' | ' . $invoice->vehicle->vehicles_brand }}</td>
                            <td class="p-2 text-right cursor-pointer" wire:click="show({{ $invoice->invoice_nr }})">
                                @if($invoice->invoice_total < 0)
                                    <span class="text-red-600">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span class="text-green-500">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right">
                                --}}{{--@can('edit')
                                    <x-ag.button.link wire:click="edit({{ $invoice->id }})" class="px-2 text-blue-500 hover:text-blue-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                        </svg>
                                    </x-ag.button.link>
                                @endcan--}}{{--
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
                            <td colspan="8" class="p-2 text-center font-bold text-lg">Es wurde noch keine Rechnungen angelegt.</td>
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
        @endif--}}
    </x-ag.main.head>
</div>
