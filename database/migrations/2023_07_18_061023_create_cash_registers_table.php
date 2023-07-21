<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_18_061023_create_card_registers_table.php
 * User: ${USER}
 * Date: 18.${MONTH_NAME_FULL}.2023
 * Time: 06:10
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id();
            $table->date('cashRegister_date')->nullable();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('cashRegister_clerk')->nullable();
            $table->decimal('cashRegister_output', 10, 2)->nullable();
            $table->decimal('cashRegister_revenue', 10, 2)->nullable();
            $table->decimal('cashRegister_saldo', 10, 2)->nullable();
            $table->tinyInteger('cashRegister_storno')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cash_registers');
    }
};
