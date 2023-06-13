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
            $table->string('invoice_prefix')->default('RE-')->nullable();
            $table->string('offer_prefix')->default('AN-')->nullable();
            $table->string('order_prefix')->default('AF-')->nullable();
            $table->string('delivery_note_prefix')->default('LS-')->nullable();
            $table->string('invoice_correction_prefix')->default('REK-')->nullable();
            $table->string('cost_estimate_prefix')->default('KV-')->nullable();
            $table->string('currency')->default(' €')->nullable();
            $table->string('enable_tax')->default(true)->nullable();
            $table->string('include_tax')->default(false)->nullable();
            $table->string('tax_rate_full')->default(19)->nullable();
            $table->string('tax_rate_reduced')->default(7)->nullable();
            $table->string('tax_rate_free')->default(0)->nullable();
            $table->string('tax_rate_core')->default(20.9)->nullable();
            $table->string('enable_19UStG')->default(false)->nullable();
            $table->string('invoice_initial_value')->default('10000')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_logo_width')->default(300)->nullable();
            $table->string('company_logo_height')->default(90)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
