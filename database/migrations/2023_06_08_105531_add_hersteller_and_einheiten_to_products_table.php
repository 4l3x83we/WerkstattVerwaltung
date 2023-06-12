<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_08_105531_add_hersteller_and_einheiten_to_products_table.php
 * User: ${USER}
 * Date: 08.${MONTH_NAME_FULL}.2023
 * Time: 10:55
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('hersteller_id');
            $table->dropColumn('einheit_id');
            $table->string('product_hersteller')->nullable()->after('product_ersetzung');
            $table->string('product_einheit')->nullable()->after('product_hersteller');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
