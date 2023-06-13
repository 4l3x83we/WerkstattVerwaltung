<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_13_063735_create_customers_table.php
 * User: ${USER}
 * Date: 13.${MONTH_NAME_FULL}.2023
 * Time: 06:37
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_kdnr')->nullable();
            $table->tinyInteger('customer_kdtype')->default(false)->nullable();
            $table->string('customer_salutation')->nullable();
            $table->string('customer_firstname')->nullable();
            $table->string('customer_lastname')->nullable();
            $table->string('customer_additive')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_post_code')->nullable();
            $table->string('customer_location')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_phone_business')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('customer_mobil_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_website')->nullable();
            $table->longText('customer_notes')->nullable();
            $table->date('customer_birthday')->nullable();
            $table->date('customer_since')->nullable();
            $table->string('customer_vat_number')->nullable();
            $table->tinyInteger('customer_show_notes_issues')->default(false)->nullable();
            $table->tinyInteger('customer_show_notes_appointments')->default(false)->nullable();
            $table->tinyInteger('customer_net_invoice')->default(false)->nullable();
            $table->bigInteger('data_protection_id')->nullable();
            $table->bigInteger('financial_accounting_conditions_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
