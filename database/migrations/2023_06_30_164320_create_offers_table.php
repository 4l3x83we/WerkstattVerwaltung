<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_30_164320_create_offers_table.php
 * User: ${USER}
 * Date: 30.${MONTH_NAME_FULL}.2023
 * Time: 16:43
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('offer_nr')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->bigInteger('vehicles_id')->nullable();
            $table->date('offer_date')->nullable();
            $table->date('offer_due_date')->nullable();
            $table->decimal('offer_subtotal', 10, 2)->default(0)->nullable();
            $table->decimal('offer_shipping', 10, 2)->default(0)->nullable();
            $table->decimal('offer_discount', 10, 2)->default(0)->nullable();
            $table->decimal('offer_vat_19', 10, 2)->default(0)->nullable();
            $table->decimal('offer_vat_7', 10, 2)->default(0)->nullable();
            $table->decimal('offer_vat_at', 10, 2)->default(0)->nullable();
            $table->decimal('offer_total', 10, 2)->default(0)->nullable();
            $table->text('offer_notes_1')->nullable();
            $table->longText('offer_notes_2')->nullable();
            $table->string('offer_type')->nullable();
            $table->string('offer_status')->default('not_printed')->nullable();
            $table->decimal('offer_external_service', 10, 2)->default(0)->nullable();
            $table->string('offer_payment')->nullable();
            $table->string('offer_payment_status')->default('not_paid')->nullable();
            $table->string('offer_order_type')->nullable();
            $table->string('offer_clerk')->nullable();
            $table->date('delivery_performance_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
