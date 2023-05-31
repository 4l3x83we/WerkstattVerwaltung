<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_31_062650_create_products_table.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 06:26
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->integer('product_qty')->nullable();
            $table->text('product_desc')->nullable();
            $table->integer('product_price')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
