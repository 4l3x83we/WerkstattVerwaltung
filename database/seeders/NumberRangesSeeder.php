<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: NumberRangesSeeder.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 17:07
 */

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class NumberRangesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('number_ranges')->insert([
            'invoice_nr' => '299999',
            'order_nr' => '199999',
            'offer_nr' => '99999',
            'cash_book_nr' => '399999',
            'customer_nr' => '999',
        ]);
    }
}
