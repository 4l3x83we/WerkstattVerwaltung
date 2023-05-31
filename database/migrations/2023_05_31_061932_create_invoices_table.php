<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_31_061932_create_invoices_table.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 06:19
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
            $table->string('email')->nullable();
            $table->date('invoice_date')->nullable();
            $table->date('invoice_due_date')->nullable();
            $table->decimal('subtotal', 2)->default(0)->nullable();
            $table->decimal('shipping', 2)->default(0)->nullable();
            $table->decimal('discount', 2)->default(0)->nullable();
            $table->decimal('vat', 2)->default(0)->nullable();
            $table->decimal('total', 2)->default(0)->nullable();
            $table->text('notes')->nullable();
            $table->string('invoice_type')->nullable();
            $table->string('status')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
