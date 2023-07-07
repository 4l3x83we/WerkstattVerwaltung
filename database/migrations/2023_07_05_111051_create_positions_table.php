<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_05_111051_create_positions_table.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 11:10
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('positions_art_nr')->nullable();
            $table->string('positions_name')->nullable();
            $table->bigInteger('positions_sales')->nullable();
            $table->float('sales_total')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
