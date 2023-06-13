<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_13_070715_create_data_protections_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 07:07
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_protections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('cascade');
            $table->tinyInteger('letters')->default(false)->nullable();
            $table->tinyInteger('phone')->default(false)->nullable();
            $table->tinyInteger('fax')->default(false)->nullable();
            $table->tinyInteger('mobile_phone')->default(false)->nullable();
            $table->tinyInteger('text_message')->default(false)->nullable();
            $table->tinyInteger('whatsapp')->default(false)->nullable();
            $table->tinyInteger('email')->default(false)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_protections');
    }
};
