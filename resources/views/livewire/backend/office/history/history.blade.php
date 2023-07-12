<div>
    <div class="p-4 bg-white block lg:flex items-center justify-between border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="w-full mb-1">
            <div class="breadcrumbs mb-4">
                {!! Breadcrumbs::render('historyShow', $history[0]) !!}
                <h1 class="text-xl font-semibold text-gray-900 lg:text-2xl dark:text-white">Historie</h1>
                <x-ag.errors.errorMessages />
            </div>
            <div class="lg:flex">
                <div class="items-center hidden mb-3 lg:flex">
                    <x-ag.forms.search />
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        @if(count($history) > 0)
            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Status</x-ag.table.th>
                    <x-ag.table.th>Kunde</x-ag.table.th>
                    <x-ag.table.th>Artikelnummer</x-ag.table.th>
                    <x-ag.table.th>Bezeichnung</x-ag.table.th>
                    <x-ag.table.th>Rechnungsdatum</x-ag.table.th>
                    <x-ag.table.th>Fahrzeug</x-ag.table.th>
                    <x-ag.table.th>Laufleistung</x-ag.table.th>
                    <x-ag.table.th class="text-right">Einzelpreis</x-ag.table.th>
                    <x-ag.table.th class="text-right">Gesamt</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @forelse($history as $historie)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">
                                @if($historie->history_status === 'pending')
                                    <x-ag.badge color="orange" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @elseif($historie->history_status === 'offer')
                                    <x-ag.badge color="yellow" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @elseif($historie->history_status === 'draft')
                                    <x-ag.badge color="gray" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @elseif($historie->history_status === 'order')
                                    <x-ag.badge color="blue" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @elseif($historie->history_status === 'dunning')
                                    <x-ag.badge color="red" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @else
                                    <x-ag.badge color="green" style="display: inline-flex; align-items: center;">
                                        {{ __(ucfirst($historie->history_status)) }}
                                    </x-ag.badge>
                                @endif
                                    {{ $historie->history_inv_nr }}
                            </td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->customer->fullname() }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->history_art_nr }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->history_art_name }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->historyInvDate() }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->history_vehicle }}</td>
                            <td class="p-2 cursor-pointer" wire:click="show({{ $historie->history_inv_nr }})">{{ $historie->history_mileage_vehicle }}</td>
                            <td class="p-2 cursor-pointer text-right" wire:click="show({{ $historie->history_inv_nr }})">
                                {{ $historie->history_qty }} *
                                @if($historie->history_subtotal < 0) <span class="text-red-600">{{ number_format($historie->history_subtotal, 2, ',', '.') . ' €' }}</span> @else <span class="text-green-500">{{ number_format($historie->history_subtotal, 2, ',', '.') . ' €' }}</span> @endif
                            </td>
                            <td class="p-2 cursor-pointer text-right" wire:click="show({{ $historie->history_inv_nr }})">
                                @if($historie->history_total < 0) <span class="text-red-600">{{ number_format($historie->history_total, 2, ',', '.') . ' €' }}</span> @else <span class="text-green-500">{{ number_format($historie->history_total, 2, ',', '.') . ' €' }}</span> @endif
                            </td>
                        </x-ag.table.tr>
                    @empty
                        <x-ag.table.tr>
                            <td colspan="9" class="p-2 text-center font-bold text-lg">Es existiert noch keine History.</td>
                        </x-ag.table.tr>
                    @endforelse
                </x-slot:tbody>
            </x-ag.table.table>
            <div class="w-full p-4 border-t border-gray-200 dark:border-gray-700">
                {{ $history->links() }}
            </div>
        @endif
    </x-ag.main.head>
</div>
