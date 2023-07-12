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
            $table->string('invoice_nr', 20)->nullable();
            $table->string('draft_nr', 20)->nullable();
            $table->string('order_nr', 20)->nullable();
            $table->string('offer_nr', 20)->nullable();
            $table->string('cash_book_nr', 20)->nullable();
            $table->string('customer_nr', 20)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('number_ranges');
    }
};
