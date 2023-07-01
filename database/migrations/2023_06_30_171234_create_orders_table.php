<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_30_171234_create_orders_table.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2023
 * Time: 17:12
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_nr')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('vehicles_id')->nullable();
            $table->date('order_date')->nullable();
            $table->date('order_due_date')->nullable();
            $table->decimal('order_subtotal', 10, 2)->default(0)->nullable();
            $table->decimal('order_shipping', 10, 2)->default(0)->nullable();
            $table->decimal('order_discount', 10, 2)->default(0)->nullable();
            $table->decimal('order_vat_19', 10, 2)->default(0)->nullable();
            $table->decimal('order_vat_7', 10, 2)->default(0)->nullable();
            $table->decimal('order_vat_at', 10, 2)->default(0)->nullable();
            $table->decimal('order_total', 10, 2)->default(0)->nullable();
            $table->text('order_notes_1')->nullable();
            $table->longText('order_notes_2')->nullable();
            $table->string('order_type')->nullable();
            $table->string('order_status')->default('not_printed')->nullable();
            $table->decimal('order_external_service', 10, 2)->default(0)->nullable();
            $table->string('order_payment')->nullable();
            $table->string('order_payment_status')->default('not_paid')->nullable();
            $table->string('order_order_type')->nullable();
            $table->string('order_clerk')->nullable();
            $table->date('delivery_performance_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
