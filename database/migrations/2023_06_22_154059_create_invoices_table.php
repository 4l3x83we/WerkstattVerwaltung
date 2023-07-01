<?php

/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_22_154059_create_invoices_table.php
 * User: ${USER}
 * Date: 22.${MONTH_NAME_FULL}.2023
 * Time: 15:40
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_nr')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('vehicles_id')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_due_date')->nullable();
            $table->decimal('invoice_subtotal', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_shipping', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_discount', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_vat_19', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_vat_7', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_vat_at', 10, 2)->default(0)->nullable();
            $table->decimal('invoice_total', 10, 2)->default(0)->nullable();
            $table->text('invoice_notes_1')->nullable();
            $table->longText('invoice_notes_2')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('invoice_status')->default('not_printed')->nullable();
            $table->string('invoice_external_service')->nullable();
            $table->string('invoice_payment')->nullable();
            $table->string('invoice_payment_status')->default('not_paid')->nullable();
            $table->string('invoice_order_type')->nullable();
            $table->string('invoice_clerk')->nullable();
            $table->date('delivery_performance_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
