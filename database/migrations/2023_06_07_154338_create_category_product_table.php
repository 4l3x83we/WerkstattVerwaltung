<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_07_154338_create_category_product_table.php
 * User: ${USER}
 * Date: 07.${MONTH_NAME_FULL}.2023
 * Time: 15:43
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained();
            $table->foreignId('products_id')->constrained();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_product');
    }
};
