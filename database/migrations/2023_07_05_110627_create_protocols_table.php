<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_05_110627_create_protocols_table.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 11:06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('protocol_type_nr')->nullable();
            $table->string('protocol_type')->nullable();
            $table->string('protocol_text')->nullable();
            $table->string('protocol_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('protocols');
    }
};
