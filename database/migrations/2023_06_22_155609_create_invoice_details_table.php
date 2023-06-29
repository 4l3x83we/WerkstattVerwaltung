<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_22_155609_create_invoice_details_table.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2023
 * Time: 15:56
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('invoice_details');
    }
};
