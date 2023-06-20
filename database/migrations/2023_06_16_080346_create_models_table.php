<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_16_080346_create_models_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 08:03
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->integer('models_model_id')->nullable();
            $table->string('models_model_name', 128)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('models');
    }
};
