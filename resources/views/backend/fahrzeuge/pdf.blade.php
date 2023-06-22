@php use Carbon\Carbon; @endphp
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

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
                                Kundenanschrift:
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 7.4cm; padding-top: 0.5cm;">
                    <table style="font-size: 12px; line-height: 16px;">
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle; font-weight: bold;">Kostenvoranschlag Nr.:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; font-weight: bold;">
                                123
                            </td>
                        </tr>
                        <tr style="margin-bottom: 5px;"><td colspan="2"></td></tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Datum:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle;">
                                {{ Carbon::parse(now())->format('d.m.Y') }}</td>
                        </tr>
                        <tr style="margin-bottom: 5px;"><td colspan="2"></td></tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Liefer-/Leistungsdatum:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle;">
                                {{ Carbon::parse(now())->format('d.m.Y') }}</td>
                        </tr>
                        <tr style="margin-bottom: 5px;"><td colspan="2"></td></tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Kundennummer:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle;">
                                Kundennr</td>
                        </tr>
                        <tr style="margin-bottom: 5px;"><td colspan="2"></td></tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Ihre USt-IdNr.:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle;">
                                KundenUstId</td>
                        </tr>
                        <tr style="margin-bottom: 5px;"><td colspan="2"></td></tr>
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Sachbearbeiter/-in:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle;">
                                {{ auth()->user()->name }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</header>

<div id="container">
    <section id="content">
        <table>
            <tr>
                <td style="width: 50%; font-weight: bold; font-size: 20px; line-height: 24px;">Kostenvoranschlag</td>
                <td style="width: 50%; text-align: right; line-height: 24px;"></td>
            </tr>
            <tr><td colspan="2" style="font-size: 0.2cm;">&nbsp;</td></tr>
            <tr>
                <td colspan="2" style="background-color: #e5e7eb; border-radius: 5px; padding: 5px; max-height: 1.58cm; font-size: 12px; line-height: 16px;">
                    <table>
                        <tr>
                            <td>Marke: <span>FORD (D)</span></td>
                            <td>HSN: <span>8566</span></td>
                            <td>F.-Id.-Nr.: <span>WF0NXXGCDN1M215183</span></td>
                        </tr>
                        <tr>
                            <td>Modell: <span>FOCUS DNW</span></td>
                            <td>TSN: <span>3640726</span></td>
                            <td>HU: <span>08.05.2001</span></td>
                        </tr>
                        <tr>
                            <td>Kennzeichen: <span>SÖM J197</span></td>
                            <td>HU: <span>04.2024</span></td>
                            <td>Km-Stand: <span>0</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="8">
                    <div style="padding: 10px 0;">Zusatztext 1</div>
                </td>
            </tr>
        </table>
        <table style="margin-top: 0.5cm;" cellspacing="0" cellpadding="0">
            <tr>
                <td style="width: 0.79cm; padding: 0 2px; border-bottom: 1px solid #374151;">Pos</td>
                <td style="width: 1.8cm; padding: 0 2px; border-bottom: 1px solid #374151;">Artikelnr.</td>
                <td style="width: 5.22cm; padding: 0 2px; border-bottom: 1px solid #374151;">Bezeichnung/Beschreibung</td>
                <td style="width: 1.3cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">Menge</td>
                <td style="width: 1cm; padding: 0 2px; border-bottom: 1px solid #374151;">Einh.</td>
                <td style="width: 0.99cm; padding: 0 2px; border-bottom: 1px solid #374151;">Rab.</td>
                <td style="width: 1.5cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">E-Preis</td>
                <td style="width: 1.9cm; padding: 0 2px; text-align: right; border-bottom: 1px solid #374151;">G-Preis</td>
            </tr>
{{--            @foreach()--}}
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
            <tr>
                <td style="padding: 0 2px;">1</td>
                <td style="padding: 0 2px;">1B02006000</td>
                <td style="padding: 0 2px;">Spannrolle Zahnriemen
                    Motorsteuerung erneuern</td>
                <td style="padding: 0 2px; text-align: right;">2,80</td>
                <td style="padding: 0 2px;">Std.</td>
                <td style="padding: 0 2px;"></td>
                <td style="padding: 0 2px; text-align: right;">32,14 €</td>
                <td style="padding: 0 2px; text-align: right;">89,99 €</td>
            </tr>
{{--            @endforeach--}}
            <tr>
                <td colspan="5" style="border-top: 1px solid #374151; padding: 5px 2px;">
                    <span style="font-weight: bold;">Zahlungsart:</span>
                    <div>*Durchlaufender Posten gem. §10 UStG.</div>
                </td>
                <td colspan="3" style="border-top: 1px solid #374151; padding: 5px 2px;">
                    <table>
                        <tr>
                            <td style="padding: 0 2px; text-align: right;">Nettosumme:</td>
                            <td style="text-align: right;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right;">MwSt (19 %):</td>
                            <td style="text-align: right;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right;">MwSt (7 %):</td>
                            <td style="text-align: right;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right;">AT-Steuer (20.9 %):</td>
                            <td style="text-align: right;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right; font-weight: bold;">Gesamtbetrag:</td>
                            <td style="text-align: right; font-weight: bold;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right;">Fremdgebühren*:</td>
                            <td style="text-align: right;">89.99 €</td>
                        </tr>
                        <tr>
                            <td style="padding: 0 2px; text-align: right; font-weight: bold;">zu zahlen:</td>
                            <td style="text-align: right; font-weight: bold;">89.99 €</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="8" style="font-weight: bold;">
                    Dieses Dokument ist ein Kostenvoranschlag für eine noch zu erbringende Leistung. Dieser Kostenvoranschlag berechtigt nicht zum Vorsteuerabzug.
                </td>
            </tr>
            <tr>
                <td colspan="8">
                    <div style="padding: 10px 0;">Zusatztext 2</div>
                </td>
            </tr>
        </table>
    </section>
</div>

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
                        @if($settings['company_telefon']) {{ 'Telefon: ' . $settings['company_telefon'] }}<br> @endif
                        @if($settings['company_mobil']) {{ 'Mobil: ' . $settings['company_mobil'] }}<br> @endif
                        @if($settings['company_fax']) {{ 'Telefax: ' . $settings['company_fax'] }}<br> @endif
                        @if($settings['company_email']) {{ 'E-Mail: ' . $settings['company_email'] }}<br> @endif
                        @if($settings['company_website']) {{ 'Internet: ' . $settings['company_website'] }} @endif
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
</body>
</html>
