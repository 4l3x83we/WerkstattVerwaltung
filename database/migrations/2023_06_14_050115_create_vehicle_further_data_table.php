<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_14_050115_create_vehicle_further_data_table.php
 * User: ${USER}
 * Date: 14.${MONTH_NAME_FULL}.2023
 * Time: 05:01
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vehicle_further_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicles_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('vehicles_color')->nullable();
            $table->string('vehicles_color_code')->nullable();
            $table->string('vehicles_upholstery_type')->nullable();
            $table->string('vehicles_upholstery_color')->nullable();
            $table->string('vehicles_radio_code')->nullable();
            $table->string('vehicles_key_number')->nullable();
            $table->integer('vehicles_seats')->default(0)->nullable();
            $table->integer('vehicles_doors')->default(0)->nullable();
            $table->integer('vehicles_sleeping_places')->default(0)->nullable();
            $table->integer('vehicles_axles')->default(0)->nullable();
            $table->integer('vehicles_number_of_gears')->default(0)->nullable();
            $table->integer('vehicles_cylinder')->default(0)->nullable();
            $table->integer('vehicles_curb_weight')->nullable();
            $table->integer('vehicles_payload')->nullable();
            $table->integer('vehicles_total_weight')->nullable();
            $table->integer('vehicles_length')->nullable();
            $table->integer('vehicles_broad')->nullable();
            $table->integer('vehicles_height')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vehicle_further_data');
    }
};
