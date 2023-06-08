<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_06_100605_create_categories_table.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 10:06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable();
            $table->string('category_title')->nullable();
            $table->string('category_keywords')->nullable();
            $table->string('category_desc')->nullable();
            $table->string('category_image')->nullable();
            $table->string('category_status', 6)->nullable();
            $table->string('category_slug')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
