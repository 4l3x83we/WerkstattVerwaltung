<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_06_051704_create_payments_table.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 05:17
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payment_nr')->nullable();
            $table->foreignId('invoice_id')->nullable()->constrained()->onDelete('cascade');
            $table->decimal('payment_amount', 10, 2)->default(0)->nullable();
            $table->date('date_of_payment')->nullable();
            $table->string('payment_method')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
