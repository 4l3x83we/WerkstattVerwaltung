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
