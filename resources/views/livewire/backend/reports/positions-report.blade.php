@php use Carbon\Carbon; @endphp
<div>
    @include('livewire.backend.reports.layouts.head', ['render' => 'positions'])
    <x-ag.main.head>
        <div class="p-4 pt-0">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Artikelnummer</x-ag.table.th>
                    <x-ag.table.th>Name</x-ag.table.th>
                    <x-ag.table.th>Anzahl Verkäufe</x-ag.table.th>
                    <x-ag.table.th class="text-right">Summe</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($positions as $position)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ $position->positions_art_nr }}</td>
                            <td class="p-2">{{ $position->positions_name }}</td>
                            <td class="p-2">{!! $position->positions_sales !!}</td>
                            <td class="p-2 text-right">
                                @if($position->sales_total < 0)
                                    <span class="text-red-600">{{ number_format($position->sales_total, 2, ',', '.') . ' €' }}</span>
                                @elseif($position->sales_total > 0)
                                    <span class="text-green-500">{{ number_format($position->sales_total, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($position->sales_total, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>
            <div class="w-full py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $positions->links() }}
            </div>

        </div>
    </x-ag.main.head>
</div>
