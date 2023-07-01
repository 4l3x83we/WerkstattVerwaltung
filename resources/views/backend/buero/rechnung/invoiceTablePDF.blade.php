@php use Carbon\Carbon; @endphp
@extends('layouts.pdf.invoice.head')

@section('invoiceContent')
    <main id="container">
        <section id="content">
            <table>
                <tr>
                    <td style="width: 50%; font-weight: bold; font-size: 20px; line-height: 24px; padding-bottom: 0.15cm">{{ $type }}</td>
                    <td style="width: 50%; text-align: right; line-height: 24px; padding-bottom: 0.15cm"></td>
                </tr>
                <tr>
                    <td colspan="2" style="background-color: #e5e7eb; border-radius: 5px; padding: 5px; max-height: 1.58cm; font-size: 12px; line-height: 16px;">
                        <table>
                            <tr>
                                <td>Marke:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_brand }}</span>
                                </td>
                                <td>HSN:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_hsn }}</span>
                                </td>
                                <td>F.-Id.-Nr.:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_identification_number }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Modell:
                                    <span style="white-space: nowrap;">{{ Str::limit($rechnung->vehicle->vehicles_model . ' ' . $rechnung->vehicle->vehicles_type, 25) }}</span>
                                </td>
                                <td>TSN:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_tsn }}</span>
                                </td>
                                <td>EZ:
                                    <span style="white-space: nowrap;">{{ Carbon::parse($rechnung->vehicle->vehicles_hu)->format('d.m.Y') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>Kennzeichen:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_license_plate }}</span>
                                </td>
                                <td>HU:
                                    <span style="white-space: nowrap;">{{ Carbon::parse($rechnung->vehicle->vehicles_hu)->format('m.Y') }}</span>
                                </td>
                                <td>Km-Stand:
                                    <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_mileage }}</span>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            @if($rechnung->invoice_notes_1)
                <table>
                    <tr>
                        <td colspan="8">
                            <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_1 }}</div>
                        </td>
                    </tr>
                </table>
            @endif
            <table style="margin-top: 0.5cm;" cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width: 0.79cm; padding: 0 2px; border-bottom: 1px solid #374151;">Pos</td>
                    <td style="width: 1.8cm; padding: 0 2px; border-bottom: 1px solid #374151;">Artikelnr.</td>
                    <td style="width: 5.22cm; padding: 0 2px; border-bottom: 1px solid #374151;">
                        Bezeichnung/Beschreibung
                    </td>
                    <td style="width: 1.3cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">Menge
                    </td>
                    <td style="width: 1cm; padding: 0 2px; border-bottom: 1px solid #374151;">Einh.</td>
                    <td style="width: 0.99cm; padding: 0 2px; border-bottom: 1px solid #374151;">Rab.</td>
                    <td style="width: 1.5cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">
                        E-Preis
                    </td>
                    <td style="width: 1.9cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">
                        G-Preis
                    </td>
                </tr>
                @foreach($rechnungDetails as $key => $rechnungDetail)
                    <tr>
                        <td style="padding: 0 2px;">{{ $key + 1 }}</td>
                        <td style="padding: 0 2px;">{{ $rechnungDetail->product->product_artnr }}</td>
                        <td style="padding: 0 2px;">{{ $rechnungDetail->product->product_name }} {{ $rechnungDetail->product->product_desc }}</td>
                        <td style="padding: 0 2px; text-align: right;">{{ $rechnungDetail->qty }}</td>
                        <td style="padding: 0 2px;">{{ $rechnungDetail->product->product_einheit }}</td>
                        <td style="padding: 0 2px;">{{ is_null($rechnungDetail->discount) ? $rechnungDetail->discountPercent . ' %' : '' }}</td>
                        <td style="padding: 0 2px; text-align: right;">{{ number_format($rechnungDetail->price, 2, ',', '.') . ' €' }}</td>
                        <td style="padding: 0 2px; text-align: right;">{{ number_format($rechnungDetail->subtotal, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endforeach
                @if($rechnung->invoice_subtotal > 0)
                    <tr>
                        <td style="padding: 0 2px; border-top: 1px double #374151;" colspan="5" rowspan="7">
                            @if($toPay)
                                @if($skonto)
                                    Zahlbar bis
                                    zum {{ Carbon::parse($rechnung->invoice_date)->addDays(30)->isoFormat('DD. MMMM YYYY') }}
                                    ohne Abzug.<br>
                                    Bei Zahlung
                                    bis {{ Carbon::parse($rechnung->invoice_date)->addDays(14)->isoFormat('DD. MMMM YYYY') }}
                                    gewähren wir 2.00 % Skonto (= {{ number_format($skonto, 2, ',', '.') . ' €' }}) auf
                                    den
                                    Gesamtbetrag.<br>
                                    (Zahlbetrag abzüglich Skonto
                                    = {{ number_format($rechnung->invoice_total - $skonto, 2, ',', '.') . ' €' }})
                                @endif
                            @else
                                Zahlungsart: <span style="font-weight: bold;">Barzahlung</span><br/>
                            @endif
                        </td>
                        <td style="padding: 0 2px; text-align: right; border-top: 1px double #374151;" colspan="2">
                            Nettosumme:
                        </td>
                        <td style="text-align: right; border-top: 1px double #374151;">{{ number_format($rechnung->invoice_subtotal, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                <tr>
                    @if($rechnung->invoice_discount > 0)
                        <td style="padding: 0 2px; text-align: right;" colspan="2">Rabatt:</td>
                        <td style="text-align: right;">
                            -{{ number_format($rechnung->invoice_discount, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_shipping > 0)
                        <td style="padding: 0 2px; text-align: right;" colspan="2">Versandkosten:</td>
                        <td style="text-align: right;">{{ number_format($rechnung->invoice_shipping, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_19 > 0)
                        <td style="padding: 0 2px; text-align: right;" colspan="2">MwSt (19 %):</td>
                        <td style="text-align: right;">{{ number_format($rechnung->invoice_vat_19, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_7 > 0)
                        <td style="padding: 0 2px; text-align: right;" colspan="2">MwSt (7 %):</td>
                        <td style="text-align: right;">{{ number_format($rechnung->invoice_vat_7, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_at > 0)
                        <td style="padding: 0 2px; text-align: right;" colspan="2">AT-Steuer (20.9 %):</td>
                        <td style="text-align: right;">{{ number_format($rechnung->invoice_vat_at, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    <td style="padding: 0 2px; text-align: right; font-weight: bold;" colspan="2">Gesamtbetrag:</td>
                    <td style="text-align: right; font-weight: bold;">{{ number_format($rechnung->invoice_total, 2, ',', '.') . ' €' }}</td>
                </tr>
                @if($rechnung->invoice_external_service > 0)
                    <tr>
                        <td colspan="5"></td>
                        <td style="padding: 0 2px; text-align: right;" colspan="2">Fremdgebühren*:</td>
                        <td style="text-align: right;">{{ number_format($rechnung->invoice_external_service, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                @if($toPay)
                    <tr>
                        <td colspan="5"></td>
                        <td style="padding: 0 2px; text-align: right; font-weight: bold;" colspan="2">zu zahlen:</td>
                        <td style="text-align: right; font-weight: bold;">{{ number_format($rechnung->invoice_total, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                @if(!$type === 'Rechnung')
                    <tr>
                        <td colspan="8" style="font-weight: bold;">
                            Dieses Dokument ist ein {{ $type }} für eine noch zu erbringende Leistung. Dieser
                            {{ $type }} berechtigt nicht zum Vorsteuerabzug.
                        </td>
                    </tr>
                @endif
                @if($rechnung->invoice_notes_2)
                    <tr>
                        <td colspan="8">
                            <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_2 }}</div>
                        </td>
                    </tr>
                @endif
            </table>
        </section>
    </main>
@endsection
