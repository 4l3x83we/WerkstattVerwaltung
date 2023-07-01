<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_30_173613_create_offer_details_table.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2023
 * Time: 17:36
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offer_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->integer('qty')->default(0)->nullable();
            $table->decimal('price', 10, 2)->default(0)->nullable();
            $table->decimal('discountPercent', 10, 2)->default(0)->nullable();
            $table->decimal('discount', 10, 2)->default(0)->nullable();
            $table->decimal('subtotal', 10, 2)->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offer_details');
    }
};
