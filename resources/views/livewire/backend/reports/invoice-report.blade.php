@php use Carbon\Carbon; @endphp
<div>
    @include('livewire.backend.reports.layouts.head', ['render' => 'invoiceReport'])
    <x-ag.main.head>
        <div class="p-4 pt-0">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nummer
                        <x-ag.table.th-sortBy id="invoice_nr" field="{{ $sortField }}"
                            direction="{{ $sortDirection }}" wire:click="sortBy('invoice_nr')" />
                    </x-ag.table.th>
                    <x-ag.table.th>Kunde
                        <x-ag.table.th-sortBy id="customer.customer_lastname" field="{{ $sortField }}"
                            direction="{{ $sortDirection }}" wire:click="sortBy('customer.customer_lastname')" />
                    </x-ag.table.th>
                    <x-ag.table.th>Rechnungsdatum
                        <x-ag.table.th-sortBy id="invoice_date" field="{{ $sortField }}"
                            direction="{{ $sortDirection }}" wire:click="sortBy('invoice_date')" />
                    </x-ag.table.th>
                    <x-ag.table.th>Fällig am
                        <x-ag.table.th-sortBy id="invoice_due_date" field="{{ $sortField }}"
                            direction="{{ $sortDirection }}" wire:click="sortBy('invoice_due_date')" />
                    </x-ag.table.th>
                    <x-ag.table.th>Status
                        <x-ag.table.th-sortBy id="invoice_payment_status" field="{{ $sortField }}"
                            direction="{{ $sortDirection }}" wire:click="sortBy('invoice_payment_status')" />
                    </x-ag.table.th>
                    <x-ag.table.th>Zahlungsweise</x-ag.table.th>
                    <x-ag.table.th>Zahlungsdatum</x-ag.table.th>
                    <x-ag.table.th class="text-right">Betrag</x-ag.table.th>
                    <x-ag.table.th class="text-right">Betrag bezahlt</x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach ($invoices as $invoice)
                        @php $payment = $invoice->payment->last(); @endphp
                        <x-ag.table.tr class="text-sm" wire:click="show({{ $invoice->id }})">
                            <td class="p-2 cursor-pointer">{{ $invoice->invoice_nr }}</td>
                            <td class="p-2 cursor-pointer">{{ $invoice->customer->fullname() }}</td>
                            <td class="p-2 cursor-pointer">{{ Carbon::parse($invoice->invoice_date)->format('d.m.Y') }}
                            </td>
                            <td class="p-2 cursor-pointer">
                                {{ Carbon::parse($invoice->invoice_due_date)->format('d.m.Y') }}</td>
                            <td class="p-2 cursor-pointer">
                                @if ($invoice->invoice_payment_status === 'pending')
                                    <x-ag.badge color="orange" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 384 512">
                                            <path
                                                d="M0 24C0 10.7 10.7 0 24 0H360c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V67c0 40.3-16 79-44.5 107.5L225.9 256l81.5 81.5C336 366 352 404.7 352 445v19h8c13.3 0 24 10.7 24 24s-10.7 24-24 24H24c-13.3 0-24-10.7-24-24s10.7-24 24-24h8V445c0-40.3 16-79 44.5-107.5L158.1 256 76.5 174.5C48 146 32 107.3 32 67V48H24C10.7 48 0 37.3 0 24zM110.5 371.5c-3.9 3.9-7.5 8.1-10.7 12.5H284.2c-3.2-4.4-6.8-8.6-10.7-12.5L192 289.9l-81.5 81.5zM284.2 128C297 110.4 304 89 304 67V48H80V67c0 22.1 7 43.4 19.8 61H284.2z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @elseif($invoice->invoice_payment_status === 'draft')
                                    <x-ag.badge color="gray" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 384 512">
                                            <path
                                                d="M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @elseif($invoice->invoice_payment_status === 'order')
                                    <x-ag.badge color="blue" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 512 512">
                                            <path
                                                d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7H336c-8.8 0-16-7.2-16-16V118.6c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @elseif($invoice->invoice_payment_status === 'dunning')
                                    <x-ag.badge color="red" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 640 512">
                                            <path
                                                d="M522.1 62.4c16.8-5.6 25.8-23.7 20.2-40.5S518.6-3.9 501.9 1.6l-113 37.7C375 15.8 349.3 0 320 0c-44.2 0-80 35.8-80 80c0 3 .2 5.9 .5 8.8L117.9 129.6c-16.8 5.6-25.8 23.7-20.2 40.5s23.7 25.8 40.5 20.2l135.5-45.2c4.5 3.2 9.3 5.9 14.4 8.2V480c0 17.7 14.3 32 32 32H512c17.7 0 32-14.3 32-32s-14.3-32-32-32H352V153.3c21-9.2 37.2-27 44.2-49l125.9-42zM439.6 288L512 163.8 584.4 288H439.6zM512 384c62.9 0 115.2-34 126-78.9c2.6-11-1-22.3-6.7-32.1L536.1 109.8c-5-8.6-14.2-13.8-24.1-13.8s-19.1 5.3-24.1 13.8L392.7 273.1c-5.7 9.8-9.3 21.1-6.7 32.1C396.8 350 449.1 384 512 384zM129.2 291.8L201.6 416H56.7l72.4-124.2zM3.2 433.1C14 478 66.3 512 129.2 512s115.2-34 126-78.9c2.6-11-1-22.3-6.7-32.1L153.2 237.8c-5-8.6-14.2-13.8-24.1-13.8s-19.1 5.3-24.1 13.8L9.9 401.1c-5.7 9.8-9.3 21.1-6.7 32.1z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @elseif($invoice->invoice_payment_status === 'canceled')
                                    <x-ag.badge color="purple" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 640 512">
                                            <path
                                                d="M5.1 9.2C13.3-1.2 28.4-3.1 38.8 5.1l592 464c10.4 8.2 12.3 23.3 4.1 33.7s-23.3 12.3-33.7 4.1L9.2 42.9C-1.2 34.7-3.1 19.6 5.1 9.2z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @else
                                    <x-ag.badge color="green" style="display: inline-flex; align-items: center;">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 mr-2" fill="currentColor"
                                            viewBox="0 0 448 512">
                                            <path
                                                d="M438.6 105.4c12.5 12.5 12.5 32.8 0 45.3l-256 256c-12.5 12.5-32.8 12.5-45.3 0l-128-128c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0L160 338.7 393.4 105.4c12.5-12.5 32.8-12.5 45.3 0z" />
                                        </svg>
                                        {{ __(ucfirst($invoice->invoice_payment_status)) }}
                                    </x-ag.badge>
                                @endif
                            </td>
                            <td class="p-2 cursor-pointer">{{ $invoice->invoice_payment }}</td>
                            <td class="p-2 cursor-pointer">
                                @if ($payment)
                                    {{ Carbon::parse($payment->date_of_payment)->format('d.m.Y') }}
                                @endif
                            </td>
                            <td class="p-2 cursor-pointer text-right">
                                @if ($invoice->invoice_total < 0)
                                    <span
                                        class="text-red-600">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                                @elseif($invoice->invoice_total > 0)
                                    <span
                                        class="text-green-500">{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($invoice->invoice_total, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 cursor-pointer text-right">
                                @if ($invoice->payment()->sum('payment_amount') < 0)
                                    <span
                                        class="text-red-600">{{ number_format($invoice->payment()->sum('payment_amount'), 2, ',', '.') . ' €' }}</span>
                                @elseif($invoice->payment()->sum('payment_amount') > 0)
                                    <span
                                        class="text-green-500">{{ number_format($invoice->payment()->sum('payment_amount'), 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($invoice->payment()->sum('payment_amount'), 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                        </x-ag.table.tr>
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>
            <div class="w-full py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $invoices->links() }}
            </div>

        </div>
    </x-ag.main.head>
</div>
