<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_05_165525_create_number_ranges_table.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 16:55
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('number_ranges', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_nr')->nullable();
            $table->integer('order_nr')->nullable();
            $table->integer('offer_nr')->nullable();
            $table->integer('cash_book_nr')->nullable();
            $table->integer('customer_nr')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('number_ranges');
    }
};
