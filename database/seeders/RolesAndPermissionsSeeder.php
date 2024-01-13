<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $futsalManagerRole = Role::create(['name' => 'futsal_manager']);

        // Permissions
        $manageUsersPermission = Permission::create(['name' => 'manage_users']);

        // Assign Permissions to Roles
        $adminRole->givePermissionTo($manageUsersPermission);
    }
}
