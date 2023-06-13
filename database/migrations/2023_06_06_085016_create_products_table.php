<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_06_085016_create_products_table.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 08:50
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
            $table->string('product_artnr')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_name_zusatz')->nullable();
            $table->string('product_ean', 13)->nullable();
            $table->string('product_ersetzung')->nullable();
            $table->string('product_einheit')->nullable();
            $table->string('product_hersteller')->nullable();
            $table->decimal('product_price_netto_ek', 10, 2)->nullable();
            $table->decimal('product_price_netto_vk', 10, 2)->nullable();
            $table->string('product_mwst', 10)->nullable();
            $table->decimal('product_price_brutto_vk', 10, 2)->nullable();
            $table->text('product_notes')->nullable();
            $table->tinyInteger('product_not_price_update')->default(false)->nullable();
            $table->integer('product_qty')->default(0)->nullable();
            $table->longText('product_desc')->nullable();
            $table->tinyInteger('price_netto_brutto')->default(false)->nullable();
            $table->tinyInteger('no_warehouse_management')->default(false)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
