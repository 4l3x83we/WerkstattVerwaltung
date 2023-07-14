@php use Carbon\Carbon; @endphp
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? '' }}</title>

{{--    <link rel="stylesheet" href="{{ asset('assets/css/pdf.css') }}" type="text/css"/>--}}
    <style>
        @page {
            margin: 0 0;
        }

        table {
            width: 100%;
            /*page-break-before: always;*/
        }

        table td {
            vertical-align: top;
        }

        body {
             margin: 10.5cm 1cm 2cm 2cm;
             font-family: Arial, sans-serif;
             font-size: 12px;
             line-height: 16px;
        }

        header {
            position: fixed;
            top: 0.5cm;
            left: 2cm;
            right: 1cm;
            height: 10cm;
            /** Extra personal styles **/
            background-color: white;
            color: black;
            /*line-height: 1.5cm;*/
        }
    </style>
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
                <td colspan="3">
                    <h1 style="margin: 0;">Arbeitsauftrag</h1><br>
                    Auftragsdatum: {{ Carbon::parse($rechnung->order_date)->format('d.m.Y') }}
                </td>
            </tr>
            <tr>
                <td style="width: 33.33%;">
                    <div style="font-weight: bold;">{{ $rechnung->customer->customer_salutation . ' ' . $rechnung->customer->customer_additive . ' ' . $rechnung->customer->customer_firstname . ' ' . $rechnung->customer->customer_lastname }}</div>
                    <div>{{ $rechnung->customer->customer_street }}</div>
                    <div>{{ $rechnung->customer->customer_post_code . ' ' . $rechnung->customer->customer_location }}</div>
                    <div>
                        @foreach(countryCode() as $countryCode)
                            @if($countryCode['code'] === $rechnung->customer->customer_country)
                                {{ $countryCode['name'] }}
                            @endif
                        @endforeach
                    </div>
                    <div>{{ $rechnung->customer->customer_phone . ', ' . $rechnung->customer->customer_mobil_phone }}</div>
                </td>
                <td style="width: 33.34%; padding: 0 5px;">
                    <div style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_brand . ', ' . $rechnung->vehicle->vehicles_model . ', ' . $rechnung->vehicle->vehicles_type }}</div>
                    <div>Kennz.: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_license_plate }}</span></div>
                    <div>Erstzulassung: <span style="font-weight: bold;">{{ $rechnung->vehicle->firstReg() }}</span></div>
                    <div>Motorcode: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_engine_code }}</span></div>
                    <div>Hubraum: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_cubic_capacity . ' ccm' }}</span></div>
                    <div>VIN: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_identification_number }}</span></div>
                    <div>Farbcode: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicleFurtherData->vehicles_color_code }}</span></div>
                    <div>Nächste Überprüfung (TÜV): <span style="font-weight: bold;">{{ Carbon::parse($rechnung->vehicle->vehicles_hu)->format('d.m.Y') }}</span></div>
                </td>
                <td style="width: 33.33%;">
                    <div>Kraftstoff:
                        <span style="font-weight: bold;">
                            @foreach(json()['fuel'] as $fuel)
                                @if($fuel->id == $rechnung->vehicle->vehicles_fuel)
                                    {{ $fuel->name }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                    <div>Leistung: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_kw . ' kW / ' . $rechnung->vehicle->vehicles_hp . ' PS' }}</span></div>
                    <div>HSN: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_hsn }}</span></div>
                    <div>TSN: <span style="font-weight: bold;">{{ $rechnung->vehicle->vehicles_tsn }}</span></div>
                    <div>Laufleistung:
                        <span style="font-weight: bold;">
                            @if($rechnung->vehicle->vehicles_mileage)
                                {{ chunk_split($rechnung->vehicle->vehicles_mileage, 3, ' ') . ' km' }}
                            @endif
                        </span>
                    </div>
                    <div>Eigengewicht:
                        <span style="font-weight: bold;">
                            @if($rechnung->vehicle->vehicleFurtherData->vehicles_curb_weight)
                                {{ number_format($rechnung->vehicle->vehicleFurtherData->vehicles_curb_weight, 0, ',', '.') . ' kg' }}
                            @endif
                        </span>
                    </div>
                    <div>Gesamtgewicht:
                        <span style="font-weight: bold;">
                            @if($rechnung->vehicle->vehicleFurtherData->vehicles_total_weight)
                                {{ number_format($rechnung->vehicle->vehicleFurtherData->vehicles_total_weight, 0, ',', '.') . ' kg' }}
                            @endif
                        </span>
                    </div>
                    <div>Fzg-Kl.:
                        <span style="font-weight: bold;">
                            @foreach(json()['fzKlasse'] as $fuel)
                                @if($fuel->id == $rechnung->vehicle->vehicles_class)
                                    {{ $fuel->name }} |
                                @endif
                            @endforeach
                            @foreach(json()['fzCategory'] as $fuel)
                                @if($fuel->id == $rechnung->vehicle->vehicles_category)
                                    {{ $fuel->name }}
                                @endif
                            @endforeach
                        </span>
                    </div>
                    <div>Reifenlager:</div>
                </td>
            </tr>
        </table>
    </div>
</header>

<main id="container">
    <section id="content">
        @if($rechnung->invoice_notes_1)
            <table>
                <tr>
                    <td>
                        <div style="padding: 10px 0;">{{ $rechnung->invoice_notes_1 }}</div>
                    </td>
                </tr>
            </table>
        @endif
        <table cellspacing="0" cellpadding="0">
            <thead>
                <tr style="background-color: #e5e7eb;">
                    <th style="text-align: left; padding: 5px;">Menge</th>
                    <th style="text-align: left; padding: 5px;">Bezeichnung</th>
                    <th style="text-align: left; padding: 5px;">Mangel / Anmerkungen</th>
                    <th style="text-align: left; padding: 5px;">Arbeitszeit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rechnungDetails as $rechnungDetail)
                    <tr>
                        <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnungDetail->qty . ' ' . $rechnungDetail->product_einheit }}</td>
                        <td style="padding: 5px; border-bottom: 1px solid;">{{ $rechnungDetail->product_name }}</td>
                        <td style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
                        <td style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
                    </tr>
                @endforeach
                @for($tr = 1; $tr <= 6; $tr++)
                <tr>
                    @for($td = 1; $td <= 4; $td++)
                        <td style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
                    @endfor
                </tr>
                @endfor
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="padding: 5px; border-bottom: 1px solid;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <table style="margin-top: 1cm;">
            <tr style="line-height: 12px;">
                <td style="width: 33.33%; padding: 5px 0;">
                    <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                    <span style="margin-left: 5px;">Beleuchtung</span>
                </td>
                <td style="width: 33.34%; padding: 5px;">Bremse vorn li ____ re ____</td>
                <td style="width: 33.33%; padding: 5px 0;">Annahme _____________</td>
            </tr>
            <tr style="line-height: 12px;">
                <td style="width: 33.33%; padding: 5px 0;">
                    <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                    <span style="margin-left: 5px;">Flüssigkeiten</span>
                </td>
                <td style="width: 33.34%; padding: 5px;">Bremse hinten li ____ re ____</td>
                <td style="width: 33.33%; padding: 5px 0;">Abholung _____________</td>
            </tr>
            <tr style="line-height: 12px;">
                <td style="width: 33.33%; padding: 5px 0;">
                    <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                    <span style="margin-left: 5px;">Wischer</span>
                </td>
                <td style="width: 33.34%; padding: 5px;">Feststellbremse li ____ re ____</td>
                <td style="width: 33.33%; padding: 5px 0;">Alt-Teile _____________</td>
            </tr>
            <tr style="line-height: 12px;">
                <td style="width: 33.33%; padding: 5px 0;">
                    <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                    <span style="margin-left: 5px;">Reifen</span>
                </td>
                <td style="width: 33.34%; padding: 5px;">Bremsflüssigkeit ____</td>
                <td style="width: 33.33%; padding: 5px 0;">Teile bestellt _____________</td>
            </tr>
            <tr style="line-height: 12px;">
                <td style="width: 33.33%; padding: 5px 0;">
                    <div style="border: 1px solid; width: 10px; height: 10px; float: left;"></div>
                    <span style="margin-left: 5px;">Bremsen</span>
                </td>
                <td style="width: 33.34%; padding: 5px;"></td>
                <td style="width: 33.33%; padding: 5px 0;">Reinigung _____________</td>
            </tr>
        </table>
    </section>
</main>
<script type="text/php">
    if ( isset($pdf) ) {
        $x = 55;
        $y = 815;
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
</body>
</html>
