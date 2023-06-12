<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_09_224418_create_uploads_table.php
 * User: ${USER}
 * Date: 09.${MONTH_NAME_FULL}.2023
 * Time: 22:44
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();
            $table->string('filename')->nullable();
            $table->string('folder')->nullable();
            $table->string('filepath')->nullable();
            $table->string('width')->nullable();
            $table->string('height')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('uploads');
    }
};
