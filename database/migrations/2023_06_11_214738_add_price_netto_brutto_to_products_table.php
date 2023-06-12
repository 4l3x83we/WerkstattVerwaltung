<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_11_214738_add_price_netto_brutto_to_products_table.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 21:47
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('price_netto_brutto')->after('product_desc')->default(false)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('price_netto_brutto');
        });
    }
};
