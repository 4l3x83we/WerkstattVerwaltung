<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_05_170340_add_fields_to_settings_table.php
 * User: ${USER}
 * Date: 05.${MONTH_NAME_FULL}.2023
 * Time: 17:03
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
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
        });
    }

    public function down(): void
    {
        Schema::table('company_settings', function (Blueprint $table) {
            $table->dropColumn('invoice_prefix');
            $table->dropColumn('offer_prefix');
            $table->dropColumn('order_prefix');
            $table->dropColumn('delivery_note_prefix');
            $table->dropColumn('invoice_correction_prefix');
            $table->dropColumn('cost_estimate_prefix');
            $table->dropColumn('currency');
            $table->dropColumn('enable_tax');
            $table->dropColumn('include_tax');
            $table->dropColumn('tax_rate_full');
            $table->dropColumn('tax_rate_reduced');
            $table->dropColumn('tax_rate_free');
            $table->dropColumn('tax_rate_core');
            $table->dropColumn('enable_19UStG');
            $table->dropColumn('invoice_initial_value');
            $table->dropColumn('company_logo');
            $table->dropColumn('company_logo_width');
            $table->dropColumn('company_logo_height');
        });
    }
};
