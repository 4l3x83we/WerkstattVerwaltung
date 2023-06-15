<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_15_055148_create_emission_classes_table.php
 * User: ${USER}
 * Date: 15.${MONTH_NAME_FULL}.2023
 * Time: 05:51
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emission_classes', function (Blueprint $table) {
            $table->id();
            $table->string('emission_class')->nullable();
            $table->integer('kat_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emission_classes');
    }
};
