@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 block lg:flex items-center justify-between">
        <div class="w-full">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('kassenbuch') !!}
                <x-ag.errors.errorMessages/>
            </div>
            <div class="lg:flex">
                <div class="items-center hidden lg:flex">
                    <div class="flex items-center space-x-2 lg:space-x-4">
                        <x-ag.button.button x-data="{}" x-on:click="window.livewire.emitTo('backend.cash-book.new-cash-book', 'show')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Neuer Kassenbucheintrag
                        </x-ag.button.button>
                        @livewire('backend.cash-book.new-cash-book', [
                            'cashBooks' => $cashBooks->last(),
                        ])
                        <x-ag.button.button-link href="{{ route('backend.berichte.cash-book.index', 'selectedRange=Letzter Monat') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 448 512">
                                <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm64 192c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm64-64c0-17.7 14.3-32 32-32s32 14.3 32 32V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V160zM320 288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V320c0-17.7 14.3-32 32-32z"/>
                            </svg>
                            Bericht von {{ Carbon::now()->subMonth()->monthName }}
                        </x-ag.button.button-link>
                        <x-ag.button.button-link href="{{ route('backend.berichte.cash-book.index', 'selectedRange=Gestern') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 mr-2 -ml-1" viewBox="0 0 448 512">
                                <path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm64 192c17.7 0 32 14.3 32 32v96c0 17.7-14.3 32-32 32s-32-14.3-32-32V256c0-17.7 14.3-32 32-32zm64-64c0-17.7 14.3-32 32-32s32 14.3 32 32V352c0 17.7-14.3 32-32 32s-32-14.3-32-32V160zM320 288c17.7 0 32 14.3 32 32v32c0 17.7-14.3 32-32 32s-32-14.3-32-32V320c0-17.7 14.3-32 32-32z"/>
                            </svg>
                            Bericht von Gestern
                        </x-ag.button.button-link>
                        <div>{{ count($cashBooks). ' Einträge' }}</div>
                    </div>
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-4">
                    <x-ag.button.button x-data="{}" x-on:click="window.livewire.emitTo('backend.cash-book.edit-cash-book', 'show')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2 -ml-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        Kassenbestand ändern
                    </x-ag.button.button>
                    @livewire('backend.cash-book.edit-cash-book', [
                        'cashBooks' => $cashBooks->last(),
                    ])
                    <div>Kassenbestand:
                        <span class="font-bold">{{ number_format($saldo, 2, ',', '.') . ' €' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4 pt-0">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nr.</x-ag.table.th>
                    <x-ag.table.th>Datum</x-ag.table.th>
                    <x-ag.table.th>Bezogen auf</x-ag.table.th>
                    <x-ag.table.th>Kunde/Lieferant</x-ag.table.th>
                    <x-ag.table.th>Beschreibung</x-ag.table.th>
                    <x-ag.table.th>Benutzer</x-ag.table.th>
                    <x-ag.table.th class="text-right">Zahlungsbetrag</x-ag.table.th>
                    <x-ag.table.th class="text-right"></x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($cashBooks as $cashBook)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ $cashBook->cashBook_nr }}</td>
                            <td class="p-2">{{ Carbon::parse($cashBook->cashBookDate())->format('d.m.Y') }}</td>
                            <td class="p-2 cursor-pointer">{!! $cashBook->relatedTo() !!}</td>
                            <td class="p-2">{!! $cashBook->customerSupplier() !!}</td>
                            <td class="p-2">{{ $cashBook->cashBook_desc }}</td>
                            <td class="p-2">{{ $cashBook->cashBook_clerk }}</td>
                            @if(!$cashBook->cashBook_is_storno)
                            <td class="p-2 text-right">
                                @if($cashBook->cashBook_output_amount < 0)
                                    <span class="text-red-600">{{ number_format($cashBook->cashBook_output_amount, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashBook->cashBook_revenue_amount > 0)
                                    <span class="text-green-500">{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            @else
                            <td class="p-2 text-current opacity-50 text-right">
                                @if($cashBook->cashBook_output_amount < 0)
                                    <span>{{ number_format($cashBook->cashBook_output_amount, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashBook->cashBook_revenue_amount > 0)
                                    <span>{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            @endif
                            <td class="p-2 text-right cursor-pointer" wire:click="storno({{ $cashBook->id }})">
                                @if(!$cashBook->cashBook_is_storno)
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4 ml-auto text-red-500 dark:text-red-600" viewBox="0 0 512 512">
                                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/>
                                    </svg>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>
        </div>
    </x-ag.main.head>
</div>
