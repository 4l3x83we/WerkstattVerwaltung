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
            <div class="lg:flex mt-4">
                <div class="flex items-center ml-auto space-x-2 lg:space-x-3 text-sm">
                    <div><b>Gesamtbetrag:</b> {!! $summe['total'] !!}
                    </div>
                    <div><b>Bar:</b> {!! $summe['bar'] !!}</div>
                    <div><b>Überweisung:</b> {!! $summe['ueberweisung'] !!}</div>
                    <div><b>Kartenzahlung:</b> {!! $summe['kartenzahlung'] !!}</div>
                    <div><b>PayPal:</b> {!! $summe['paypal'] !!}</div>
                </div>
            </div>
        </div>
    </div>
    <x-ag.main.head>
        <div class="p-4">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nummer
                        <x-ag.table.th-sortBy id="payment_nr" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('payment_nr')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Kunde
                        <x-ag.table.th-sortBy id="customer.customer_lastname" field="{{$sortField}}" direction="{{$sortDirection}}" wire:click="sortBy('customer.customer_lastname')"/>
                    </x-ag.table.th>
                    <x-ag.table.th>Zahlungsdatum</x-ag.table.th>
                    <x-ag.table.th>Zahlungsweise</x-ag.table.th>
                    <x-ag.table.th class="text-right">Betrag</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    {{--@foreach($payments as $payment)
                        <x-ag.table.tr class="text-sm" wire:click="show({{ $payment->invoice_id }})">
                            <td class="p-2 cursor-pointer">{{ $payment->payment_nr }}</td>
                            <td class="p-2 cursor-pointer">{{ $payment->invoice->customer->fullname() }}</td>
                            <td class="p-2 cursor-pointer">{{ Carbon::parse($payment->date_of_payment)->format('d.m.Y') }} </td>
                            <td class="p-2 cursor-pointer">{{ $payment->payment_method }}</td>
                            <td class="p-2 cursor-pointer text-right">
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
                </x-slot:tbody>
            </x-ag.table.table>

        </div>
    </x-ag.main.head>
</div>

