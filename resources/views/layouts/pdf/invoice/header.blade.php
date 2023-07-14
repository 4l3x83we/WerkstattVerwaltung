@php use Carbon\Carbon; @endphp

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
                            @if($type === 'Rechnung')
                                <td style="width: 50%; vertical-align: middle; font-weight: bold;">Rechnungs-Nr.:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; font-weight: bold; white-space: nowrap;">{{ $rechnung->invoice_nr }}</td>
                            @elseif($type === 'Auftrag')
                                <td style="width: 50%; vertical-align: middle; font-weight: bold;">Auftrags-Nr.:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; font-weight: bold; white-space: nowrap;">{{ $rechnung->order_nr }}</td>
                            @elseif($type === 'Entwurf')
                                <td colspan="2" style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; font-weight: bold; white-space: nowrap;">Entwurf</td>
                            @endif
                        </tr>
                        <tr style="margin-bottom: 5px;">
                            @if($type === 'Rechnung')
                                <td style="width: 50%; vertical-align: middle;">Rechnungsdatum:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ Carbon::parse($rechnung->invoice_date)->format('d.m.Y') }}</td>
                            @elseif($type === 'Auftrag')
                                <td style="width: 50%; vertical-align: middle;">Auftragsdatum:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ Carbon::parse($rechnung->invoice_date)->format('d.m.Y') }}</td>
                            @elseif($type === 'Entwurf')
                                <td style="width: 50%; vertical-align: middle;">Rechnungsdatum:</td>
                                <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;"></td>
                            @endif
                        </tr>
                        @if($type === 'Rechnung')
                            @if(!$rechnung->invoice_payment == 'Bar')
                                <tr style="margin-bottom: 5px;">
                                    <td style="width: 50%; vertical-align: middle;">Fällig am:</td>
                                    <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ Carbon::parse($rechnung->invoice_due_date)->format('d.m.Y') }}</td>
                                </tr>
                            @endif
                        @endif
                        @if($type === 'Rechnung')
                        <tr style="margin-bottom: 5px;">
                            <td style="width: 50%; vertical-align: middle;">Leistungszeitraum:</td>
                            <td style="width: 50%; background-color: white; text-align: right; line-height: 16px; vertical-align: middle; white-space: nowrap;">{{ $rechnung->checkInvoiceDateWithPerformanceDate() }}</td>
                        </tr>
                        @endif
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
