<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_14_043851_create_vehicles_table.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 04:38
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vehicles_internal_vehicle_number')->nullable();
            $table->string('vehicles_license_plate')->nullable();
            $table->string('vehicles_hsn', 4)->nullable();
            $table->string('vehicles_tsn', 10)->nullable();
            $table->string('vehicles_brand')->nullable();
            $table->string('vehicles_model')->nullable();
            $table->string('vehicles_type')->nullable();
            $table->integer('vehicles_class')->nullable();
            $table->integer('vehicles_category')->nullable();
            $table->string('vehicles_identification_number')->nullable();
            $table->date('vehicles_first_registration')->nullable();
            $table->string('vehicles_cubic_capacity')->nullable();
            $table->string('vehicles_hp', 5)->nullable();
            $table->string('vehicles_kw', 5)->nullable();
            $table->string('vehicles_mileage', 10)->nullable();
            $table->date('vehicles_hu')->nullable();
            $table->string('vehicles_tire_1')->nullable();
            $table->string('vehicles_tire_2')->nullable();
            $table->integer('vehicles_tpms')->nullable();
            $table->string('vehicles_engine_code')->nullable();
            $table->integer('vehicles_fuel')->nullable();
            $table->integer('vehicles_cat')->nullable();
            $table->integer('vehicles_plaque')->nullable();
            $table->integer('vehicles_emission_class')->nullable();
            $table->integer('vehicles_transmission')->nullable();
            $table->string('vehicles_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
