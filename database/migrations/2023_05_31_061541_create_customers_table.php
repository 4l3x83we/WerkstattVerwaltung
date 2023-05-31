<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_31_061541_create_customers_table.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 06:15
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();

            $table->string('post_code')->nullable();
            $table->string('ship_name')->nullable();
            $table->string('ship_phone')->nullable();
            $table->string('ship_email')->nullable();
            $table->string('ship_address_1')->nullable();
            $table->string('ship_address_2')->nullable();
            $table->string('ship_city')->nullable();
            $table->string('ship_country')->nullable();
            $table->string('ship_post_code')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
