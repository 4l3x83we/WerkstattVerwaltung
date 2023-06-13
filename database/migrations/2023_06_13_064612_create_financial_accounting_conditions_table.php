<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_13_064612_create_financial_accounting_conditions_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 06:46
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_accounting_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->integer('conditions_discount_items')->nullable();
            $table->integer('conditions_discount_labor_values')->nullable();
            $table->string('financial_terms_of_payment')->nullable();
            $table->string('financial_price_group')->nullable();
            $table->string('financial_debtor_number')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_accounting_conditions');
    }
};
