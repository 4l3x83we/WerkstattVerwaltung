<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_05_085201_create_company_settings_table.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 08:52
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_street')->nullable();
            $table->string('company_post_code')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_telefon')->nullable();
            $table->string('company_mobil')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_tax_number')->nullable();
            $table->string('company_vat_number')->nullable();
            $table->string('company_addition')->nullable();
            $table->string('company_country')->default('DE')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_email')->nullable();
            $table->bigInteger('bank_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
