<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_13_064914_create_shippings_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 06:49
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('shipping_salutation')->nullable();
            $table->string('shipping_firstname')->nullable();
            $table->string('shipping_lastname')->nullable();
            $table->string('shipping_additive')->nullable();
            $table->string('shipping_street')->nullable();
            $table->string('shipping_country')->nullable();
            $table->string('shipping_post_code')->nullable();
            $table->string('shipping_location')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
