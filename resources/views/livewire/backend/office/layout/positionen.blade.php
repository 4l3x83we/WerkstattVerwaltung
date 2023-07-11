<x-ag.table.table>
    <x-slot:thead>
        <x-ag.table.th class="min-w-[40px]">Pos</x-ag.table.th>
        <x-ag.table.th class="min-w-[200px]">Artikel-Nr.</x-ag.table.th>
        <x-ag.table.th class="min-w-[570px] w-[570px]">Bezeichnung</x-ag.table.th>
        <x-ag.table.th class="min-w-[100px]">Menge</x-ag.table.th>
        <x-ag.table.th class="min-w-[120px] text-right">E.-Preis</x-ag.table.th>
        <x-ag.table.th class="min-w-[100px]">MwSt</x-ag.table.th>
        <x-ag.table.th class="min-w-[100px] text-right">Rabatt</x-ag.table.th>
        <x-ag.table.th class="min-w-[120px] text-right">Summe</x-ag.table.th>
        @if($edit)
        <x-ag.table.th class="min-w-[100px]"></x-ag.table.th>
        @endif
    </x-slot:thead>
    <x-slot:tbody>
        @foreach($invoiceDetails as $index => $invoiceDetail)
            <x-ag.table.tr class="text-sm">
                <td class="p-2">{{ $index + 1 }}</td>
                <td class="p-2">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_id"/>
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_art_nr"/>
                        @if($invoiceDetail['product_art_nr'])
                            {{ $invoiceDetail['product_art_nr'] }}
                        @endif
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].id"/>
                    @else
                        <x-ag.forms.input id="product.product_art_nr" text="Artikelnummer" autofocus/>
                    @endif
                </td>
                <td class="p-2">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_name"/>
                        @if($invoiceDetail['product_name'])
                            {{ $invoiceDetail['product_name'] }}
                        @endif
                    @else
                        <x-ag.forms.input id="product.product_name" text="Produktname" />
                    @endif
                </td>
                <td class="p-2">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].qty"/>
                        @if($invoiceDetail['qty'])
                            {{ $invoiceDetail['qty'] }}
                        @endif
                    @else
                        <x-ag.forms.input type="number" id="product.qty" text="Menge"/>
                    @endif
                </td>
                <td class="p-2 text-right">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].price"/>
                        @if($invoiceDetail['price'])
                            {{ number_format($invoiceDetail['price'], 2) . ' €' }}
                        @endif
                    @else
                        <x-ag.forms.igr id="product.price" type="number" step="0.01" text="E.-Preis" icon="€" />
                    @endif
                </td>
                <td class="p-2">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].tax"/>
                        @if($invoiceDetail['tax'])
                            {{ $invoiceDetail['tax']. ' %' }}
                        @endif
                    @else
                        <x-ag.forms.select id="product.tax" text="MwSt" >
                            @foreach($mwsts as $mwst)
                                <option value="{{ $mwst['wert'] }}">{{ $mwst['wert'] }}</option>
                            @endforeach
                        </x-ag.forms.select>
                    @endif
                </td>
                <td class="p-2 text-right">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].discountPercent"/>
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].discount"/>
                        @if($invoiceDetail['discount'] > 0)
                            {{ number_format($invoiceDetail['discount'], 2) . ' €' }}
                        @endif
                    @else
                        <x-ag.forms.igr type="number" id="product.discountPercent" text="Rabatt" icon="%"/>
                    @endif</td>
                <td class="p-2 text-right">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].subtotal"/>
                        @if($invoiceDetail['subtotal'])
                            {{ number_format($invoiceDetail['subtotal'], 2) . ' €' }}
                        @endif
                    @else
                        <x-ag.forms.igr id="product.subtotal" type="number" step="0.01" text="Summe" icon="€" />
                    @endif
                </td>
                @if($edit)
                <td class="p-2 text-center">
                    @if($invoiceDetail['is_saved'])
                        <x-ag.button.link type="button" wire:click="editProduct({{ $index }})" class="px-2 text-blue-500 hover:text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                            </svg>
                        </x-ag.button.link>
                        {{--                                        @elseif($invoiceDetail['product_artnr'])--}}
                    @elseif($product_art_nr)
                        <x-ag.button.link type="button" wire:click="saveProduct({{ $index }}, {{ $invoiceDetail['id'] ?? '' }})" class="px-2 text-green-500 hover:text-green-600">
                            <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M48 96V416c0 8.8 7.2 16 16 16H384c8.8 0 16-7.2 16-16V170.5c0-4.2-1.7-8.3-4.7-11.3l33.9-33.9c12 12 18.7 28.3 18.7 45.3V416c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V96C0 60.7 28.7 32 64 32H309.5c17 0 33.3 6.7 45.3 18.7l74.5 74.5-33.9 33.9L320.8 84.7c-.3-.3-.5-.5-.8-.8V184c0 13.3-10.7 24-24 24H104c-13.3 0-24-10.7-24-24V80H64c-8.8 0-16 7.2-16 16zm80-16v80H272V80H128zm32 240a64 64 0 1 1 128 0 64 64 0 1 1 -128 0z"/>
                            </svg>
                        </x-ag.button.link>
                    @endif
                    <x-ag.button.link type="button" wire:click="removeProduct({{ $index }})" class="px-2 text-red-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                    </x-ag.button.link>
                </td>
                @endif
            </x-ag.table.tr>
            <x-ag.table.tr>
                @if(!is_null($invoiceDetail['product_desc']))
                    <td class="p-2"></td>
                    <td class="p-2" colspan="7">
                        @if($invoiceDetail['is_saved'])
                            <x-ag.forms.input type="hidden" id="invoiceDetails.[{{ $index }}].product_desc"/>
                            @if($invoiceDetail['product_desc'])
                                {{ $invoiceDetail['product_desc'] }}
                            @endif
                        @else
                            <x-ag.forms.input id="product.product_desc" text="Beschreibung" />
                        @endif
                    </td>
                    <td class="p-2"></td>
                @endif
            </x-ag.table.tr>
        @endforeach
        @if($subtotals > 0)
            <x-ag.table.tr class="text-sm">
                <td class="p-2 align-top" colspan="5" rowspan="7">
                    {{--@if($toPay)
                        @if($skonto)
                            Zahlbar bis
                            zum {{ Carbon::parse(now())->addDays(30)->isoFormat('DD. MMMM YYYY') }}
                            ohne Abzug.<br>
                            Bei Zahlung
                            bis {{ Carbon::parse(now())->addDays(14)->isoFormat('DD. MMMM YYYY') }}
                            gewähren wir 2.00 % Skonto
                            (= {{ number_format($skonto, 2, ',', '.') . ' €' }}) auf
                            den Gesamtbetrag.<br>
                            (Zahlbetrag abzüglich Skonto
                            = {{ number_format($total - $skonto, 2, ',', '.') . ' €'  }}
                            )
                        @else
                            Zahlungsart:
                            <span class="font-bold">{{ $invoices['invoice_payment'] }}</span>
                        @endif
                    @else
                        Zahlungsart: <span class="font-bold">Barzahlung</span> /
                        Zahlungseingang:
                        <span class="font-bold">{{ Carbon::parse(now())->format('d.m.Y') }}</span>
                    @endif--}}
                </td>
                <td class="p-2 text-right" colspan="2">Nettosumme:</td>
                <td class="p-2 text-right" colspan="2">{{ number_format($subtotals, 2, ',', '.') . ' €' }}</td>
            </x-ag.table.tr>
        @endif
        <x-ag.table.tr class="text-sm">
            @if($discountTotal > 0)
                <td class="p-2 text-right" colspan="2">Rabatt:</td>
                <td class="p-2 text-right" colspan="2">
                    -{{ number_format($discountTotal, 2, ',', '.') . ' €' }}</td>
            @endif
        </x-ag.table.tr>
        <x-ag.table.tr class="text-sm">
            @if(false)
                <td class="p-2 text-right" colspan="2">Versandkosten:</td>
                <td class="p-2 text-right" colspan="2"></td>
            @endif
        </x-ag.table.tr>
        <x-ag.table.tr class="text-sm">
            @if($total19 > 0)
                <td class="p-2 text-right" colspan="2">MwSt
                    ({{ $settings->tax_rate_full . ' %' }}):
                </td>
                <td class="p-2 text-right" colspan="2">{{ number_format($total19, 2, ',', '.') . ' €' }}</td>
            @endif
        </x-ag.table.tr>
        <x-ag.table.tr class="text-sm">
            @if($total7 > 0)
                <td class="p-2 text-right" colspan="2">MwSt
                    ({{ $settings->tax_rate_reduced . ' %' }}):
                </td>
                <td class="p-2 text-right" colspan="2">{{ number_format($total7, 2, ',', '.') . ' €' }}</td>
            @endif
        </x-ag.table.tr>
        <x-ag.table.tr class="text-sm">
            @if($totalAT > 0)
                <td class="p-2 text-right" colspan="2">AT-Steuer
                    ({{ $settings->tax_rate_core . ' %' }}):
                </td>
                <td class="p-2 text-right" colspan="2">{{ number_format($totalAT, 2, ',', '.') . ' €' }}</td>
            @endif
        </x-ag.table.tr>
        <x-ag.table.tr class="text-sm">
            @if($total > 0)
                <td class="p-2 text-right font-bold" colspan="2">Gesamtbetrag:</td>
                <td class="p-2 text-right font-bold" colspan="2">{{ number_format(round($total, 2), 2, ',', '.') . ' €' }}</td>
            @endif
        </x-ag.table.tr>
        @if(false)
            <x-ag.table.tr class="text-sm">
                <td class="p-2" colspan="5"></td>
                <td class="p-2 text-right" colspan="2">Fremdgebühren*:</td>
                <td class="p-2 text-right" colspan="2"></td>
            </x-ag.table.tr>
        @endif
        {{--@if($toPay)
            <x-ag.table.tr class="text-sm">
                <td class="p-2" colspan="5"></td>
                <td class="p-2 text-right font-bold" colspan="2">zu zahlen:</td>
                <td class="p-2 text-right font-bold" colspan="2">{{ number_format(round($total, 2), 2, ',', '.') . ' €' }}</td>
            </x-ag.table.tr>
        @endif--}}
    </x-slot:tbody>
</x-ag.table.table>
