<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: 2023_05_28_073405_add_address_picture_birthday_to_users_table.php
 * User: ${USER}
 * Date: 28.${MONTH_NAME_FULL}.2023
 * Time: 07:34
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('strasse')->nullable()->after('remember_token');
            $table->string('plz', 5)->nullable()->after('strasse');
            $table->string('ort')->nullable()->after('plz');
            $table->string('telefon')->nullable()->after('ort');
            $table->string('mobil')->nullable()->after('telefon');
            $table->string('geburtstag')->nullable()->after('mobil');
            $table->string('image', 2048)->nullable()->after('geburtstag');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('strasse');
            $table->dropColumn('plz');
            $table->dropColumn('ort');
            $table->dropColumn('telefon');
            $table->dropColumn('mobil');
            $table->dropColumn('geburtstag');
            $table->dropColumn('image');
        });
    }
};
