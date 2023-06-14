<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_14_044459_create_vehicle_customer_table.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 04:44
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_customer', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('vehicle_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_customer');
    }
};
