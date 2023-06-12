<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_06_11_215423_add_merge_to_price_groups_table.php
 * User: ${USER}
 * Date: 11.${MONTH_NAME_FULL}.2023
 * Time: 21:54
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('price_groups', function (Blueprint $table) {
            $table->string('priceGroup_marge_1')->nullable();
            $table->string('priceGroup_marge_2')->nullable();
            $table->string('priceGroup_marge_3')->nullable();
            $table->string('priceGroup_marge_4')->nullable();
            $table->string('priceGroup_marge_5')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('price_groups', function (Blueprint $table) {
            $table->dropColumn('priceGroup_marge_1');
            $table->dropColumn('priceGroup_marge_2');
            $table->dropColumn('priceGroup_marge_3');
            $table->dropColumn('priceGroup_marge_4');
            $table->dropColumn('priceGroup_marge_5');
        });
    }
};
