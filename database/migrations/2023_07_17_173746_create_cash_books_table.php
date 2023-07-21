<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_17_173746_create_cash_books_table.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 17:37
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cashBook_nr')->nullable();
            $table->date('cashBook_date')->nullable();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->text('cashBook_desc')->nullable();
            $table->string('cashBook_clerk')->nullable();
            $table->decimal('cashBook_output_amount', 10, 2)->nullable();
            $table->decimal('cashBook_revenue_amount', 10, 2)->nullable();
            $table->decimal('cashBook_saldo', 10, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_books');
    }
};
