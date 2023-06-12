<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_11_235428_add_no_warehouse_management_to_products.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 23:54
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('no_warehouse_management')->after('price_netto_brutto')->default(false)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('no_warehouse_management');
        });
    }
};
