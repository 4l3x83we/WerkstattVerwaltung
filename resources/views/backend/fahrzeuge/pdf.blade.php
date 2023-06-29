@php use Carbon\Carbon; @endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? '' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/pdf.css') }}" type="text/css"/>
</head>

<body>


<header>
    <div class="inner">
        <table style="height: 4cm; max-height: 4cm;">
            <tr>
                <td style="text-align: left; width: 50%;">
                    <img src="{{ empty($setting['company_logo']) ? asset($settings['company_logo']) : asset('images/Logo_neu.png') }}" alt="Logo" style="width: 100%; max-width: {{ $settings['company_logo_width'] }}px;">
                </td>
                <td style="text-align: right; font-size: 12px; line-height: 16px; width: 50%;">
                    {{ $settings['company_name'] }}<br>
                    {{ $settings['company_street'] }}<br>
                    {{ $settings['company_country'] . ' - ' . $settings['company_post_code'] . ' ' . $settings['company_city'] }}
                    <br>
                    @if($settings['company_telefon'])
                        <br> {{  'Telefon: ' . $settings['company_telefon'] }}
                    @endif
                    @if($settings['company_mobil'])
                        <br> {{ 'Mobil: ' . $settings['company_mobil'] }}
                    @endif
                    @if($settings['company_fax'])
                        <br> {{ 'Fax: ' . $settings['company_fax'] }}
                    @endif
                    @if($settings['company_email'])
                        <br><br> {{ $settings['company_email'] }}
                    @endif
                    @if($settings['company_website'])
                        <br> {{ $settings['company_website'] }}
                    @endif
                </td>
            </tr>
        </table>
        <table style="height: 4.5cm; max-height: 4.5cm;">
            <tr>
                <td style="width: 10.6cm">
                    <table style="width: 8.5cm;">
                        <tr>
                            <td style="height: 1.77cm; padding-left: 0.5cm">
                                <div style="font-size: 8px; text-decoration: underline; line-height: 12px;">{!! $settings['company_name'] . ' - ' . $settings['company_street'] . ' - ' . $settings['company_post_code'] . ' ' . $settings['company_city'] !!}</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="height: 2.73cm; padding-left: 0.5cm; font-size: 12px; line-height: 16px;">
                                <span style="white-space: nowrap;">{{ $rechnung->customer->customer_salutation . ' ' . $rechnung->customer->customer_firstname . ' ' . $rechnung->customer->customer_lastname }}</span><br />
                                <span style="white-space: nowrap;">{{ $rechnung->customer->customer_additive }}</span><br />
                                <span style="white-space: nowrap;">{{ $rechnung->customer->customer_street }}</span><br />
                                <span style="white-space: nowrap;">{{ $rechnung->customer->customer_post_code . ' ' . $rechnung->customer->customer_location }}</span><br />
                                @foreach(countryCode() as $country)
                                    <span style="white-space: nowrap;">@if($country['code'] === $rechnung->customer->customer_country){{ $country['name'] }}@endif</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 7.4cm; padding-top: 0.5cm;">
                    <table style="font-size: 12px; line-height: 16px;">
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle; font-weight: bold;">{{ $type }}s-Nr.:
                            </td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; font-weight: bold; white-space: nowrap;">{{ $rechnung->invoice_nr }}</td>
                        </tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Datum:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">
                                {{ Carbon::parse($rechnung->invoice_date)->format('d.m.Y') }}</td>
                        </tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Liefer-/Leistungsdatum:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">
                                {{ Carbon::parse($rechnung->delivery_performance_date)->format('d.m.Y') }}</td>
                        </tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Kundennummer:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ $rechnung->customer->customer_kdnr }}</td>
                        </tr>
                        @if($rechnung->customer->customer_vat_number)
                            <tr style="margin-bottom: 5px;">
                                <td style="width: 50%; vertical-align: middle;">Ihre USt-IdNr.:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ $rechnung->customer->customer_vat_number }}</td>
                            </tr>
                        @endif
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Sachbearbeiter/-in:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ $rechnung->invoice_clerk }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</header>

<footer>
    <div class="inner">
        <div class="border">
            <script type="text/php">
                if ( isset($pdf) ) {
                    $x = 515;
                    $y = 277;
                    $text = "Seite: {PAGE_NUM} von {PAGE_COUNT}";
                    $font = $fontMetrics->get_font("helvetica", "bold");
                    $size = 8;
                    $color = array(0,0,0);
                    $word_space = 0.0;  //  default
                    $char_space = 0.0;  //  default
                    $angle = 0.0;   //  default
                    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
                }
            </script>
            <table>
                <tr style="font-size: 8px; line-height: 12px;">
                    <td style="padding: 0 5px;">
                        {{ $settings['company_name'] }}<br>
                        {{ $settings['company_addition'] }}<br>
                        {{ $settings['company_street'] }}<br>
                        {{ $settings['company_post_code'] . ' ' . $settings['company_city'] }}
                    </td>
                    <td style="padding: 0 5px;">
                        @if($settings['company_telefon'])
                            {{ 'Telefon: ' . $settings['company_telefon'] }}<br>
                        @endif
                        @if($settings['company_mobil'])
                            {{ 'Mobil: ' . $settings['company_mobil'] }}<br>
                        @endif
                        @if($settings['company_fax'])
                            {{ 'Telefax: ' . $settings['company_fax'] }}<br>
                        @endif
                        @if($settings['company_email'])
                            {{ 'E-Mail: ' . $settings['company_email'] }}<br>
                        @endif
                        @if($settings['company_website'])
                            {{ 'Internet: ' . $settings['company_website'] }}
                        @endif
                    </td>
                    <td style="padding: 0 5px;">
                        {{ 'USt.-IdentNr: ' . $settings['company_vat_number'] }}<br>
                        {{ 'SteuerNr: ' . $settings['company_tax_number'] }}<br>
                        {{ 'Inhaber: ' . $settings['company_addition'] }}
                    </td>
                    <td style="padding: 0 5px;">
                        {{ $bank['bank_bank_name'] }}<br>
                        {{ 'Kontoinhaber: ' . $bank['bank_account_owner'] }}<br>
                        {{ 'IBAN: ' . $bank['bank_iban'] }}<br>
                        {{ 'BIC: ' . $bank['bank_bic'] }}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</footer>

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
                            <td>Marke: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_brand }}</span></td>
                            <td>HSN: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_hsn }}</span></td>
                            <td>F.-Id.-Nr.: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_identification_number }}</span></td>
                        </tr>
                        <tr>
                            <td>Modell: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_model . ' ' . $rechnung->vehicle->vehicles_type }}</span></td>
                            <td>TSN: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_tsn }}</span></td>
                            <td>EZ: <span style="white-space: nowrap;">{{ Carbon::parse($rechnung->vehicle->vehicles_hu)->format('d.m.Y') }}</span></td>
                        </tr>
                        <tr>
                            <td>Kennzeichen: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_license_plate }}</span></td>
                            <td>HU: <span style="white-space: nowrap;">{{ Carbon::parse($rechnung->vehicle->vehicles_hu)->format('m.Y') }}</span></td>
                            <td>Km-Stand: <span style="white-space: nowrap;">{{ $rechnung->vehicle->vehicles_mileage }}</span></td>
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
                <td style="width: 5.22cm; padding: 0 2px; border-bottom: 1px solid #374151;">Bezeichnung/Beschreibung
                </td>
                <td style="width: 1.3cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">Menge
                </td>
                <td style="width: 1cm; padding: 0 2px; border-bottom: 1px solid #374151;">Einh.</td>
                <td style="width: 0.99cm; padding: 0 2px; border-bottom: 1px solid #374151;">Rab.</td>
                <td style="width: 1.5cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">E-Preis
                </td>
                <td style="width: 1.9cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">G-Preis
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
                                Zahlbar bis zum {{ Carbon::parse($rechnung->invoice_date)->addDays(30)->isoFormat('DD. MMMM YYYY') }} ohne Abzug.<br>
                                Bei Zahlung bis {{ Carbon::parse($rechnung->invoice_date)->addDays(14)->isoFormat('DD. MMMM YYYY') }} gewähren wir 2.00 % Skonto (= {{ number_format($skonto, 2, ',', '.') . ' €' }}) auf den Gesamtbetrag.<br>
                                (Zahlbetrag abzüglich Skonto = {{ number_format($rechnung->invoice_total - $skonto, 2, ',', '.') . ' €' }})
                            @endif
                        @else
                            Zahlungsart: <span style="font-weight: bold;">Barzahlung</span><br />
                        @endif
                    </td>
                    <td style="padding: 0 2px; text-align: right; border-top: 1px double #374151;" colspan="2">Nettosumme:</td>
                    <td style="text-align: right; border-top: 1px double #374151;">{{ number_format($rechnung->invoice_subtotal, 2, ',', '.') . ' €' }}</td>
                </tr>
            @endif
            <tr>
                @if($rechnung->invoice_discount > 0)
                    <td style="padding: 0 2px; text-align: right;" colspan="2">Rabatt:</td>
                    <td style="text-align: right;">-{{ number_format($rechnung->invoice_discount, 2, ',', '.') . ' €' }}</td>
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

</body>
</html>
