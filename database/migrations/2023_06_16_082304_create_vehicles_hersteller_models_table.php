<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_16_082304_create_vehicles_hersteller_models_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 08:23
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles__hersteller__models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->string('vhm_hersteller_name', 128)->nullable();
            $table->foreignId('model_id')->nullable()->constrained();
            $table->string('vhm_model_name', 128)->nullable();
            $table->unsignedBigInteger('vehicles_id')->nullable();
            $table->string('vhm_typ', 128)->nullable();
            $table->string('vhm_prod_month_von', 16)->nullable();
            $table->string('vhm_prod_month_bis', 16)->nullable();
            $table->string('vhm_prod_year_von', 16)->nullable();
            $table->string('vhm_prod_year_bis', 16)->nullable();
            $table->string('vhm_ps', 16)->nullable();
            $table->string('vhm_kw', 16)->nullable();
            $table->string('vhm_hubraum', 16)->nullable();
            $table->string('vhm_fuel', 128)->nullable();
            $table->string('vhm_hsn', 16)->nullable();
            $table->string('vhm_tsn', 16)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles__hersteller__models');
    }
};
