<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_07_21_082822_create_emails_table.php
 * User: ${USER}
 * Date: 21.${MONTH_NAME_FULL}.2023
 * Time: 08:28
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoice_id')->nullable();
            $table->bigInteger('customer_id')->nullable();
            $table->string('email_art')->nullable();
            $table->string('email_empfaenger')->nullable();
            $table->string('email_betreff')->nullable();
            $table->date('email_send_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
