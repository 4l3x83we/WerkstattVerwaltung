<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_02_084653_create_histories_table.php
 * User: ${USER}
 * Date: 02.${MONTH_NAME_FULL}.2023
 * Time: 08:46
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->string('history_status')->nullable();
            $table->string('history_inv_nr')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained();
            $table->string('history_art_nr')->nullable();
            $table->string('history_art_name')->nullable();
            $table->date('history_inv_date')->nullable();
            $table->string('history_vehicle')->nullable();
            $table->string('history_mileage_vehicle')->nullable();
            $table->integer('history_qty')->default(1)->nullable();
            $table->decimal('history_subtotal', 10, 2)->default(0)->nullable();
            $table->decimal('history_total', 10, 2)->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
