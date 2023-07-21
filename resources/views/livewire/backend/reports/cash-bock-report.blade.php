@php use Carbon\Carbon; @endphp
<div>
    @include('livewire.backend.reports.layouts.head', ['render' => 'cashBook'])
    <x-ag.main.head>
        <div class="p-4">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nummer</x-ag.table.th>
                    <x-ag.table.th>Datum</x-ag.table.th>
                    <x-ag.table.th>bezogen auf</x-ag.table.th>
                    <x-ag.table.th>Kunde/Lieferant</x-ag.table.th>
                    <x-ag.table.th>Beschreibung</x-ag.table.th>
                    <x-ag.table.th>Benutzer</x-ag.table.th>
                    <x-ag.table.th class="text-right">Zahlungsbetrag</x-ag.table.th>
                    <x-ag.table.th class="text-right">Saldo</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    <x-ag.table.tr>
                        <td class="p-2" colspan="7"></td>
                        <td class="p-2 text-right font-bold">{{ number_format($saldo, 2, ',', '.') . ' €' }}</td>
                    </x-ag.table.tr>
                    @foreach($cashBooks as $cashBook)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2 cursor-pointer">{{ $cashBook->cashBook_nr }}</td>
                            <td class="p-2 cursor-pointer">{{ $cashBook->cashBookDate() }}</td>
                            <td class="p-2 cursor-pointer">{!! $cashBook->relatedTo() !!}</td>
                            <td class="p-2 cursor-pointer">{!! $cashBook->customerSupplier() !!}</td>
                            <td class="p-2 cursor-pointer">{!! $cashBook->cashBook_desc !!}</td>
                            <td class="p-2 cursor-pointer">{{ $cashBook->cashBook_clerk }}</td>
                            <td class="p-2 cursor-pointer text-right">{{ $cashBook->cashBook_amount }}
                                @if($cashBook->cashBook_output_amount < 0)
                                    <span class="text-red-600">{{ number_format($cashBook->cashBook_output_amount, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashBook->cashBook_revenue_amount > 0)
                                    <span class="text-green-500">{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashBook->cashBook_revenue_amount, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 cursor-pointer text-right">
                                @if($cashBook->cashBook_saldo < 0)
                                    <span class="text-red-600">{{ number_format($cashBook->cashBook_saldo, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashBook->cashBook_saldo > 0)
                                    <span class="text-green-500">{{ number_format($cashBook->cashBook_saldo, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashBook->cashBook_saldo, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>

        </div>
    </x-ag.main.head>
</div>
