<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_06_092155_create_price_groups_table.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 09:21
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('price_groups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->decimal('priceGroup_price_vk_1', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_2', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_3', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_4', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_5', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_brutto_1', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_brutto_2', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_brutto_3', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_brutto_4', 10, 2)->default(0.00)->nullable();
            $table->decimal('priceGroup_price_vk_brutto_5', 10, 2)->default(0.00)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('price_groups');
    }
};
