@php use Carbon\Carbon; @endphp
<div>
    @include('livewire.backend.reports.layouts.head', ['render' => 'cashRegister'])
    <x-ag.main.head>
        <div class="p-4 pt-0">

            <x-ag.table.table>
                <x-slot:thead>
                    <x-ag.table.th>Nummer</x-ag.table.th>
                    <x-ag.table.th>Datum</x-ag.table.th>
                    <x-ag.table.th>Zahlungsweise</x-ag.table.th>
                    <x-ag.table.th>bezogen auf</x-ag.table.th>
                    <x-ag.table.th>Kunde</x-ag.table.th>
                    <x-ag.table.th>Benutzer</x-ag.table.th>
                    <x-ag.table.th class="text-right">Betrag</x-ag.table.th>
                    <x-ag.table.th class="text-right">Saldo</x-ag.table.th>
                    <x-ag.table.th class="text-right"></x-ag.table.th>
                </x-slot:thead>
                <x-slot:tbody>
                    @foreach($cashRegisters as $cashRegister)
                        @if(!$cashRegister->cashRegister_storno)
                        <x-ag.table.tr class="text-sm">
                            <td class="p-2">{{ $cashRegister->id }}</td>
                            <td class="p-2">{{ $cashRegister->dateOfPayment() }}</td>
                            <td class="p-2">{!! $cashRegister->payment() !!}</td>
                            <td class="p-2 cursor-pointer">{!! $cashRegister->relatedTo() !!} </td>
                            <td class="p-2 cursor-pointer">{!! $cashRegister->customerSupplier() !!}</td>
                            <td class="p-2">{{ $cashRegister->clerk() }}</td>
                            <td class="p-2 text-right">
                                @if($cashRegister->cashRegister_output < 0)
                                    <span class="text-red-600">{{ number_format($cashRegister->cashRegister_output, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashRegister->cashRegister_revenue > 0)
                                    <span class="text-green-500">{{ number_format($cashRegister->cashRegister_revenue, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashRegister->cashRegister_revenue, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right">
                                @if($cashRegister->cashRegister_saldo < 0)
                                    <span class="text-red-600">{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashRegister->cashRegister_saldo > 0)
                                    <span class="text-green-500">{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right w-52">
                                @include('livewire.backend.office.layout.buttonsPaymentBeleg', ['link' => $cashRegister->invoice[0], 'tooltip' => false])
                                <div id="tooltip-storno({{ $cashRegister->invoice[0]->id }})" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm not-italic text-left font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <div class="py-2 px-2.5">
                                        <span>Storniert von: {{ $cashRegister->cashRegister_clerk }}</span><br>
                                        <span>Storniert am: {{ $cashRegister->dateOfPayment() }}</span>
                                    </div>
                                </div>
                            </td>
                        </x-ag.table.tr>
                        @else
                        <x-ag.table.tr class="text-sm italic">
                            <td class="p-2 text-current opacity-50">{{ $cashRegister->id }}</td>
                            <td class="p-2 text-current opacity-50">{{ $cashRegister->dateOfPayment() }}</td>
                            <td class="p-2 text-current opacity-50">{!! $cashRegister->payment() !!}</td>
                            <td class="p-2 text-current opacity-50 cursor-pointer">{!! $cashRegister->relatedTo() !!} </td>
                            <td class="p-2 text-current opacity-50 cursor-pointer">{!! $cashRegister->customerSupplier() !!}</td>
                            <td class="p-2 text-current opacity-50">{{ $cashRegister->cashRegister_clerk }}</td>
                            <td class="p-2 text-current opacity-50 text-right">
                                @if($cashRegister->cashRegister_output < 0)
                                    <span>{{ number_format($cashRegister->cashRegister_output, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashRegister->cashRegister_revenue > 0)
                                    <span>{{ number_format($cashRegister->cashRegister_revenue, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashRegister->cashRegister_revenue, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-current opacity-50 text-right">
                                @if($cashRegister->cashRegister_saldo < 0)
                                    <span>{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @elseif($cashRegister->cashRegister_saldo > 0)
                                    <span>{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @else
                                    <span>{{ number_format($cashRegister->cashRegister_saldo, 2, ',', '.') . ' €' }}</span>
                                @endif
                            </td>
                            <td class="p-2 text-right w-52">
                                @include('livewire.backend.office.layout.buttonsPaymentBeleg', ['link' => $cashRegister->invoice[0], 'tooltip' => true])
                                <div id="tooltip-storno({{ $cashRegister->invoice[0]->id }})" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm not-italic text-left font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <div class="py-2 px-2.5">
                                        <span>Storniert von: {{ $cashRegister->cashRegister_clerk }}</span><br>
                                        <span>Storniert am: {{ $cashRegister->dateOfPayment() }}</span>
                                    </div>
                                </div>
                            </td>
                        </x-ag.table.tr>
                        @endif
                    @endforeach
                </x-slot:tbody>
            </x-ag.table.table>
            <div class="w-full py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $cashRegisters->links() }}
            </div>

        </div>
    </x-ag.main.head>
</div>
