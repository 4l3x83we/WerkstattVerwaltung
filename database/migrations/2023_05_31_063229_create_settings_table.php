<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_31_063229_create_settings_table.php
 * User: ${USER}
 * Date: 31.${MONTH_NAME_FULL}.2023
 * Time: 06:32
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('company_email')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_address_1')->nullable();
            $table->string('company_address_2')->nullable();
            $table->string('company_city')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_post_code')->nullable();
            $table->string('currency')->nullable();
            $table->string('enable_tax')->default('true')->nullable();
            $table->string('include_tax')->default('false')->nullable();
            $table->string('tax_rate')->nullable();
            $table->string('invoice_prefix')->default('INV')->nullable();
            $table->string('invoice_initial_value')->default(1)->nullable();
            $table->string('invoice_theme')->default('#222222')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('company_logo_width')->default(300)->nullable();
            $table->string('company_logo_height')->default(90)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
