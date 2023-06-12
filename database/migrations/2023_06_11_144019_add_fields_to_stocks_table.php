<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_11_144019_add_fields_to_stocks_table.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 14:40
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->date('stock_movement_date')->nullable()->after('product_id');
            $table->string('stock_movement_qty')->nullable()->after('stock_available');
            $table->string('stock_movement_note')->nullable()->after('maximum_amount');
        });
    }

    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('stock_movement_date');
            $table->dropColumn('stock_movement_qty');
            $table->dropColumn('stock_movement_note');
        });
    }
};
