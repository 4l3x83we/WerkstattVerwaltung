@php use Carbon\Carbon; @endphp
<div>
    <div class="p-4 block lg:flex items-center justify-between">
        <div class="w-full">
            <div class="breadcrumbs">
                {!! Breadcrumbs::render('cardPayment') !!}
                <x-ag.errors.errorMessages/>
            </div>
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4" wire:ignore>
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                @include('livewire.backend.reports.layouts.menu')
            </div>
            <div class="lg:flex">
                <div class="items-center hidden lg:flex">
                    <div class="flex items-center w-full sm:w-80">
                        <x-ag.forms.select id="selectedRange" text="Auswahl" class="mr-2" wire:change="render">
                            @foreach(dataRanges() as $range)
                                <option value="{{ $range['wert'] }}">{!! $range['name'] !!}</option>
                            @endforeach
                        </x-ag.forms.select>
                    </div>
                </div>
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3">
                    exportbutton
                </div>
            </div>
            <div class="lg:flex mt-4">
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3 text-sm">
                    <div><b>Gesamtbetrag:</b>
                        @if($summe > 0)
                            <span class="text-green-500">{!! number_format($summe, 2, ',', '.') ?? '0.00' !!} €</span>
                        @elseif($summe < 0)
                            <span class="text-red-500">{!!number_format($summe, 2, ',', '.') ?? '0.00' !!} €</span>
                        @else
                            <span>{!! number_format($summe, 2, ',', '.') ?? '0.00' !!} €</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nummer</x-ag.table.th>
                    <x-ag.table.th>Datum</x-ag.table.th>
                    <x-ag.table.th>bezogen auf</x-ag.table.th>
                    <x-ag.table.th>Kunde</x-ag.table.th>
                    <x-ag.table.th>Beschreibung</x-ag.table.th>
                    <x-ag.table.th>Benutzer</x-ag.table.th>
                    <x-ag.table.th class="text-right">Zahlungsweise</x-ag.table.th>
                    <x-ag.table.th class="text-right">Zahlungsbetrag</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($payments as $payment)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ $payment->payment_nr }}</td>
                            <td class="p-2">{{ $payment->dateOfPayment() }}</td>
                            <td class="p-2 cursor-pointer">{!! $payment->relatedTo() !!} </td>
                            <td class="p-2 cursor-pointer">{!! $payment->customerSupplier() !!}</td>
                            <td class="p-2">{!! $payment->notes !!}</td>
                            <td class="p-2">{{ $payment->invoice->invoice_clerk }}</td>
                            <td class="p-2 text-right">{{ $payment->payment_method }}</td>
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
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>

        </div>
    </x-ag.main.head>
</div>
