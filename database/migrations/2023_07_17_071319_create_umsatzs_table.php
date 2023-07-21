<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_17_071319_create_umsatzs_table.php
 * User: ${USER}
 * Date: 17.${MONTH_NAME_FULL}.2023
 * Time: 07:13
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('umsatzs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('umsatz_brutto', 10, 2)->default(0)->nullable();
            $table->decimal('umsatz_netto', 10, 2)->default(0)->nullable();
            $table->decimal('einnahmen_netto', 10, 2)->default(0)->nullable();
            $table->decimal('einnahmen_brutto', 10, 2)->default(0)->nullable();
            $table->string('steuer')->default(19)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umsatzs');
    }
};
