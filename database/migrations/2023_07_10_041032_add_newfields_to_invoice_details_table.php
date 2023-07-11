<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_10_041032_add_newfields_to_invoice_details_table.php
 * User: ${USER}
 * Date: 10.${MONTH_NAME_FULL}.2023
 * Time: 04:10
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->string('product_art_nr')->after('product_id')->nullable();
            $table->string('product_name')->after('product_art_nr')->nullable();
            $table->string('product_desc')->after('product_name')->nullable();
            $table->decimal('tax', 10, 2)->after('price')->default(19)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('invoice_details', function (Blueprint $table) {
            $table->dropColumn('product_art_nr');
            $table->dropColumn('product_name');
            $table->dropColumn('product_desc');
            $table->dropColumn('tax');
        });
    }
};
