<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_06_134210_create_einheitens_table.php
 * User: ${USER}
 * Date: 06.${MONTH_NAME_FULL}.2023
 * Time: 13:42
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('einheitens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('einheitens');
    }
};
