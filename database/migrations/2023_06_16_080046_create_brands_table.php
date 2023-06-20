<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_16_080046_create_brands_table.php
 * User: ${USER}
 * Date: 16.${MONTH_NAME_FULL}.2023
 * Time: 08:00
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->integer('brands_brand_id')->nullable();
            $table->string('brands_brand_name', 128)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
