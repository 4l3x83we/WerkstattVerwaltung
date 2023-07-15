@php use Carbon\Carbon; @endphp
@extends('layouts.pdf.invoice.head')

@section('invoiceContent')
    <main id="container">
        <section id="content">
            <table>
                <tr>
                    <td style="width: 50%; font-weight: bold; font-size: 20px; line-height: 24px; padding-bottom: 0.15cm">@if($rechnung->invoice_status !== 'storno') {{ $type }} @else Stornorechnung @endif</td>
                    <td style="width: 50%; text-align: right; line-height: 24px; padding-bottom: 0.15cm"></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 0;">
                        <table cellpadding="0" cellspacing="0">
                            <tr style="background-color: #e5e7eb;">
                                <th style="padding: 5px; width: 2.5cm; text-align: left;">Fahrzeug</th>
                                <th style="padding: 5px; width: 1.5cm; text-align: left;">Motor</th>
                                <th style="padding: 5px; width: 2cm; text-align: left;">Kennz</th>
                                <th style="padding: 5px; width: 1.5cm; text-align: left;">HSN/TSN</th>
                                <th style="padding: 5px; width: 1.5cm; text-align: left;">Erstzul</th>
                                <th style="padding: 5px; width: 2.5cm; text-align: left;">Fahrzeug VIN</th>
                                <th style="padding: 5px; width: 2.5cm; text-align: left;">Laufleistung</th>
                            </tr>
                            <tr>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->vehicles_brand .' '. Str::limit($rechnung->vehicle->vehicles_model . ' ' . $rechnung->vehicle->vehicles_type, 25) }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->vehicles_engine_code }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->vehicles_license_plate }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->vehicles_hsn . ' / ' . $rechnung->vehicle->vehicles_tsn }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->firstReg() }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnung->vehicle->vehicles_identification_number }}</td>
                                <td style="padding: 5px; border-bottom: 1px solid;">@if($rechnung->vehicle->vehicles_mileage){{ chunk_split($rechnung->vehicle->vehicles_mileage, 3, ' ') . ' km' }}@endif</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            {{--@if($rechnung->invoice_notes_1)
                <table>
                    <tr>
                        <td colspan="8">
                            <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_1 }}</div>
                        </td>
                    </tr>
                </table>
            @endif--}}
            <table style="margin-top: 0.5cm;" cellspacing="0" cellpadding="0">
                <tr style="background-color: #e5e7eb;">
                    <th style="width: 0.79cm; padding: 5px; text-align: left;">Pos</th>
                    <th style="width: 1.8cm; padding: 5px; text-align: left;">Artikelnr.</th>
                    <th style="width: 5.22cm; padding: 5px; text-align: left;">Bezeichnung/Beschreibung</th>
                    <th style="width: 1.3cm; padding: 5px; text-align: right;">Menge</th>
                    @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                        <th style="width: 0.99cm; padding: 5px; text-align: left;">Rab.</th>
                    @endif
                    <th style="width: 1.5cm; padding: 5px; text-align: right;">Einzelpreis</th>
                    <th style="width: 1cm; padding: 5px; text-align: right;">MwSt.</th>
                    <th style="width: 1.9cm; padding: 5px; text-align: right;">Gesamt</th>
                </tr>
                @foreach($rechnungDetails as $key => $rechnungDetail)
                    <tr>
                        <td style="padding: 5px;">{{ $key + 1 }}</td>
                        <td style="padding: 5px;">{{ $rechnungDetail->product_art_nr }}</td>
                        <td style="padding: 5px;">{{ $rechnungDetail->product_name }}
                            @if($rechnungDetail->product_desc)
                                <br><br>{{ $rechnungDetail->product_desc }}
                            @endif
                        </td>
                        <td style="padding: 5px; text-align: right;">{{ $rechnungDetail->qty .' '. $rechnungDetail->product_einheit }}</td>
                        @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                            <td style="padding: 5px;">{{ is_null($rechnungDetail->discount) ? $rechnungDetail->discountPercent . ' %' : '' }}</td>
                        @endif
                        <td style="padding: 5px; text-align: right;">{{ number_format($rechnungDetail->price, 2, ',', '.') . ' €' }}</td>
                        <td style="padding: 5px; text-align: right;">{{ number_format($rechnungDetail->tax, 1, ',', '.') . ' %' }}</td>
                        <td style="padding: 5px; text-align: right;">{{ number_format($rechnungDetail->subtotal, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endforeach
                @if($rechnung->invoice_subtotal > 0 or $rechnung->invoice_subtotal < 0)
                    <tr>
                        @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                        <td style="padding: 0 5px; border-top: 1px solid" colspan="5" rowspan="7">
                        @else
                        <td style="padding: 0 5px; border-top: 1px solid" colspan="4" rowspan="7">
                        @endif
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
                                Zahlungsart: <span style="font-weight: bold;">Bar</span><br/>
                            @endif
                        </td>
                        <td style="padding: 0 5px; text-align: right; border-top: 1px solid" colspan="2">
                            Nettosumme:
                        </td>
                        <td style="padding: 0 5px; text-align: right; border-top: 1px solid">{{ number_format($rechnung->invoice_subtotal, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                <tr>
                    @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                        <td style="padding: 0 5px; text-align: right;" colspan="2">Rabatt:</td>
                        <td style="padding: 0 5px; text-align: right;">
                            -{{ number_format($rechnung->invoice_discount, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_shipping > 0 or $rechnung->invoice_shipping < 0)
                        <td style="padding: 0 5px; text-align: right;" colspan="2">Versandkosten:</td>
                        <td style="padding: 0 5px; text-align: right;">{{ number_format($rechnung->invoice_shipping, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_19 > 0 or $rechnung->invoice_vat_19 < 0)
                        <td style="padding: 0 5px; text-align: right;" colspan="2">MwSt (19 %):</td>
                        <td style="padding: 0 5px; text-align: right;">{{ number_format($rechnung->invoice_vat_19, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_7 > 0 or $rechnung->invoice_vat_7 < 0)
                        <td style="padding: 0 5px; text-align: right;" colspan="2">MwSt (7 %):</td>
                        <td style="padding: 0 5px; text-align: right;">{{ number_format($rechnung->invoice_vat_7, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    @if($rechnung->invoice_vat_at > 0 or $rechnung->invoice_vat_at < 0)
                        <td style="padding: 0 5px; text-align: right;" colspan="2">AT-Steuer (20.9 %):</td>
                        <td style="padding: 0 5px; text-align: right;">{{ number_format($rechnung->invoice_vat_at, 2, ',', '.') . ' €' }}</td>
                    @endif
                </tr>
                <tr>
                    <td style="padding: 0 5px; text-align: right; font-weight: bold; border-top: 1px solid;" colspan="2">Gesamtbetrag:</td>
                    <td style="padding: 0 5px; text-align: right; font-weight: bold; border-top: 1px solid;">{{ number_format($rechnung->invoice_total, 2, ',', '.') . ' €' }}</td>
                </tr>
                @if($rechnung->invoice_external_service > 0 or $rechnung->invoice_external_service < 0)
                    <tr>
                        <td colspan="5"></td>
                        <td style="padding: 0 5px; text-align: right;" colspan="2">Fremdgebühren*:</td>
                        <td style="padding: 0 5px; text-align: right;">{{ number_format($rechnung->invoice_external_service, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                @if($toPay)
                    <tr>
                        @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                        <td colspan="5"></td>
                        @else
                        <td colspan="4"></td>
                        @endif
                        <td style="padding: 0 5px; text-align: right; font-weight: bold;" colspan="2">zu zahlen:</td>
                        <td style="padding: 0 5px; text-align: right; font-weight: bold;">{{ number_format($rechnung->invoice_total, 2, ',', '.') . ' €' }}</td>
                    </tr>
                @endif
                @if(!$type === 'Rechnung')
                    <tr>
                        @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                        <td colspan="8" style="font-weight: bold;">
                        @else
                        <td colspan="7" style="font-weight: bold;">
                        @endif
                            Dieses Dokument ist ein {{ $type }} für eine noch zu erbringende Leistung. Dieser
                            {{ $type }} berechtigt nicht zum Vorsteuerabzug.
                        </td>
                    </tr>
                @endif
                @if($type === 'Rechnung' or $type === 'Entwurf')
                    @if($rechnung->invoice_notes_2)
                        <tr>
                            @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                            <td colspan="8">
                            @else
                            <td colspan="7">
                            @endif
                                <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_2 }}</div>
                            </td>
                        </tr>
                    @endif
                @else
                    @if($rechnung->invoice_notes_1)
                        <tr>
                            @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                            <td colspan="8">
                            @else
                            <td colspan="7">
                            @endif
                                <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_1 }}</div>
                            </td>
                        </tr>
                    @endif
                @endif
                @if($type === 'Auftrag')
                    <tr>
                        @if($rechnung->invoice_discount > 0 or $rechnung->invoice_discount < 0)
                            <td colspan="8">123</td>
                        @else
                            <td colspan="7">
                                Erforderliche Mehrarbeiten ausführen?<br>
                                <table cellpadding="0" cellspacing="0">
                                    <tr style="line-height: 12px;">
                                        <td style=" padding: 5px 0;">ggfs. bis max _____________________ €</td>
                                        <td style="width: 1.25cm; vertical-align: middle !important; padding: 5px 0;">
                                            <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                                            <span style="margin-left: 5px;">Ja</span>
                                        </td>
                                        <td style="width: 2cm; vertical-align: middle !important; padding: 5px 0;">
                                            <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                                            <span style="margin-left: 5px;">Nein</span>
                                        </td>
                                    </tr>
                                    <tr style="line-height: 12px;">
                                        <td style=" padding: 5px 0;">Die ersetzten Teile sollen ausgeliefert werden</td>
                                        <td style="width: 1.25cm; vertical-align: middle !important; padding: 5px 0;">
                                            <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                                            <span style="margin-left: 5px;">Ja</span>
                                        </td>
                                        <td style="width: 2cm; vertical-align: middle !important; padding: 5px 0;">
                                            <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                                            <span style="margin-left: 5px;">Nein</span>
                                        </td>
                                    </tr>
                                </table>
                                Kunde gibt folgenden Wageninhalt in Verwahrung:<br>
                                <div style="width: 100%; height: 20px; border-bottom: 1px dotted;"></div>
                                <div style="width: 100%; height: 30px; border-bottom: 1px solid;"></div>
                                Unterschrift des Kunden
                            </td>
                        @endif
                    </tr>
                @endif
            </table>
        </section>
    </main>
@endsection
