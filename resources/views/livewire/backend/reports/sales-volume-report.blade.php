@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 block lg:flex items-center justify-between" wire:ignore>
        <div class="w-full">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('salesVolume') !!}
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                @include('livewire.backend.reports.layouts.menu')
            </div>
                <div class="lg:flex justify-between items-center">
                    <div>DateRange</div>
                    <div class="w-96 px-5">
                        <x-ag.forms.inline-select id="groupBy" text="Gruppiert nach" wire:change="updateUmsatz">
                            <option value="all">Buchung</option>
                            <option value="today">Heute</option>
                            <option value="yesterday">Gestern</option>
                            <option value="this_week">Diese Woche</option>
                            <option value="last_week">Letzte Woche</option>
                            <option value="this_month">Aktueller Monat</option>
                            <option value="last_month">Letzter Monat</option>
                        </x-ag.forms.inline-select>
                    </div>
                    <div class="flex items-center ml-auto space-x-2 lg:space-x-3">
                        exportbutton
                    </div>
                </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">
            <canvas id="chart" class="!w-full !h-80" wire:ignore></canvas>
            @push('js')
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @endpush
            @push('scripts')
                <script>
                    const chart = new Chart(document.getElementById('chart'), {
                        type: 'bar',
                        data: {
                            labels: @json($labels),
                            datasets: @json($datasets)
                        },
                        options: {
                            locale: 'de-DE',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function (context) {
                                            let label = ' ' + context.dataset.label || ' ';
                                            if (label) {
                                                label += ': ';
                                            }
                                            if (context.parsed.y !== null) {
                                                label += new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(context.parsed.y);
                                            }
                                            return label;
                                        }
                                    }
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0,
                                    ticks: {
                                        callback: function (value, index, ticks) {
                                            return new Intl.NumberFormat('de-DE', {
                                                style: 'currency',
                                                currency: 'EUR'
                                            }).format(value);
                                        }
                                    }
                                }
                            }
                        }
                    });

                    Livewire.on('updateTheChart', data => {
                        chart.data = data;
                        chart.update();
                    });
                </script>
            @endpush
        </div>
        <div class="p-4">
            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Zeitraum</x-ag.table.th>
                    <x-ag.table.th class="text-right">Umsatz</x-ag.table.th>
                    <x-ag.table.th class="text-right">Einnahmen</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($umsatzes as $umsatz)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ Carbon::parse($umsatz->date)->format('d.m.Y') }}</td>
                            <td class="p-2 text-right">
                                @if($umsatz->umsatzBrutto < 0)
                                    <span class="text-red-600">{{ number_format($umsatz->umsatzBrutto, 2, ',', '.') . ' €' }}</span>
                                @elseif($umsatz->umsatzBrutto > 0)
                                    <span class="text-green-500">{{ number_format($umsatz->umsatzBrutto, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($umsatz->umsatzBrutto, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right">
                                @if($umsatz->einnahmenBrutto < 0)
                                    <span class="text-red-600">{{ number_format($umsatz->einnahmenBrutto, 2, ',', '.') . ' €' }}</span>
                                @elseif($umsatz->einnahmenBrutto > 0)
                                    <span class="text-green-500">{{ number_format($umsatz->einnahmenBrutto, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($umsatz->einnahmenBrutto, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach
                    <x-ag.table.tr class="text-sm">
                        <td class="p-2 text-right">Summe</td>
                        <td class="p-2 text-right">
                            @if($umsatzes->sum('umsatzBrutto') < 0)
                                <span class="text-red-600">{{ number_format($umsatzes->sum('umsatzBrutto'), 2, ',', '.') . ' €' }}</span>
                            @elseif($umsatzes->sum('umsatzBrutto') > 0)
                                <span class="text-green-500">{{ number_format($umsatzes->sum('umsatzBrutto'), 2, ',', '.') . ' €' }}</span>
                            @else
                                <span>{{ number_format($umsatzes->sum('umsatzBrutto'), 2, ',', '.') . ' €' }}</span>
                            @endif
                        </td>
                        <td class="p-2 text-right">
                            @if($umsatzes->sum('einnahmenBrutto') < 0)
                                <span class="text-red-600">{{ number_format($umsatzes->sum('einnahmenBrutto'), 2, ',', '.') . ' €' }}</span>
                            @elseif($umsatzes->sum('einnahmenBrutto') > 0)
                                <span class="text-green-500">{{ number_format($umsatzes->sum('einnahmenBrutto'), 2, ',', '.') . ' €' }}</span>
                            @else
                                <span>{{ number_format($umsatzes->sum('einnahmenBrutto'), 2, ',', '.') . ' €' }}</span>
                            @endif
                        </td>
                    </x-ag.table.tr>
                </x-slot:tbody>
            </x-ag.table.table>

        </div>
    </x-ag.main.head>
</div>

