<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: RoleAndPermissionSeeder.php
 * User: ${USER}
 * Date: 23.${MONTH_NAME_FULL}.2023
 * Time: 08:52
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::create(['name' => 'create']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'show']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'calendarCreate']);

        $superAdminRole = Role::create(['name' => 'super_admin']);
        $adminRole = Role::create(['name' => 'admin']);
        $garageRole = Role::create(['name' => 'garage']);
        $userRole = Role::create(['name' => 'user']);

        $superAdminRole->givePermissionTo(Permission::all());
        $adminRole->givePermissionTo(Permission::all());
        $garageRole->givePermissionTo(['create', 'edit', 'show']);
        $userRole->givePermissionTo(['calendarCreate', 'show']);
    }
}
