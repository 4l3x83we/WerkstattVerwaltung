<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_10_063516_create_stocks_table.php
 * User: ${USER}
 * Date: 10.${MONTH_NAME_FULL}.2023
 * Time: 06:35
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('stock_reserved', 20)->default(0)->nullable();
            $table->string('stock_available', 20)->nullable();
            $table->tinyInteger('no_warehouse_management')->default(false)->nullable();
            $table->string('storage_location')->nullable();
            $table->string('minimum_amount', 20)->default(0)->nullable();
            $table->string('maximum_amount', 20)->default(0)->nullable();
            $table->date('stock_movement_date')->nullable();
            $table->string('stock_movement_qty')->nullable();
            $table->string('stock_movement_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
