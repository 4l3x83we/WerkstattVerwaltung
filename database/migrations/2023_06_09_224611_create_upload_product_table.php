<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_09_224611_create_image_products_table.php
 * User: ${USER}
 * Date: 09.${MONTH_NAME_FULL}.2023
 * Time: 22:46
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upload_product', function (Blueprint $table) {
            $table->unsignedBigInteger('upload_id')->nullable();
            $table->unsignedBigInteger('products_id')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upload_product');
    }
};
