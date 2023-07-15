@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 block lg:flex items-center justify-between">
        <div class="w-full">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('invoice') !!}
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                @include('livewire.backend.reports.layouts.menu')
            </div>
            <div class="lg:flex">
                <div class="items-center hidden lg:flex">
                    Daterange
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3">
                    exportbutton
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">
            <div class="my-4" style="height: 16rem;" wire:poll.5s>
                <div wire:ignore wire:key={{ $chartId }}>
                    @if($chart)
                        {!! $chart->container() !!}
                    @endif
                </div>
                @push('js')
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
                    <script>
                        window.livewire.on('chartUpdate', (chartId, labels, datasets) => {
                            let chart = window[chartId].chart;
                            chart.data.datasets.forEach((dataset, key) => {
                                dataset.data = datasets[key];
                            });
                            chart.data.labels = labels;
                            chart.update();
                        });
                    </script>
                @endpush
                @if($chart)
                    @push('scripts')
                        {!! $chart->script() !!}
                    @endpush
                @endif
            </div>
            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Zeitraum</x-ag.table.th>
                    <x-ag.table.th class="text-right">Umsatz</x-ag.table.th>
                    <x-ag.table.th class="text-right">Einnahmen</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    {{--@foreach($payments as $payment)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ $payment->payment_nr }}</td>
                            <td class="p-2">{{ $payment->invoice->customer->fullname() }}</td>
                            <td class="p-2">{{ Carbon::parse($payment->date_of_payment)->format('d.m.Y') }} </td>
                            <td class="p-2">{{ $payment->payment_method }}</td>
                            <td class="p-2 text-right">
                                @if($payment->payment_amount < 0)
                                    <span class="text-red-600">{{ number_format($payment->payment_amount, 2, ',', '.') . ' €' }}</span>
                                @elseif($payment->payment_amount > 0)
                                    <span class="text-green-500">{{ number_format($payment->payment_amount, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($payment->payment_amount, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach--}}
                    <x-ag.table.tr class="text-sm">
                        <td class="p-2 text-right">Summe</td>
                        <td class="p-2 text-right">
                            @if(true < 0)
                                <span class="text-red-600">{{ number_format(1.22, 2, ',', '.') . ' €' }}</span>
                            @elseif(true > 0)
                                <span class="text-green-500">{{ number_format(4.66, 2, ',', '.') . ' €' }}</span>
                            @else
                                <span>{{ number_format(7.89, 2, ',', '.') . ' €' }}</span>
                            @endif
                        </td>
                        <td class="p-2 text-right">
                            @if(true < 0)
                                <span class="text-red-600">{{ number_format(1.22, 2, ',', '.') . ' €' }}</span>
                            @elseif(true > 0)
                                <span class="text-green-500">{{ number_format(4.66, 2, ',', '.') . ' €' }}</span>
                            @else
                                <span>{{ number_format(7.89, 2, ',', '.') . ' €' }}</span>
                            @endif
                        </td>
                    </x-ag.table.tr>
                </x-slot:tbody>
            </x-ag.table.table>

        </div>
    </x-ag.main.head>
</div>

