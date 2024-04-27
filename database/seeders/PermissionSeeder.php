<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ROLE
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'delete role']);
        Permission::create(['name' => 'add role']);
        Permission::create(['name' => 'edit role']);

        // PERMISSION
        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'delete permission']);
        Permission::create(['name' => 'add permission']);
        Permission::create(['name' => 'edit permission']);

        // USER BASED PERMISSION
        Permission::create(['name' => 'asign userBasedPermission']);

        // ROLE BASED PERMISSION
        Permission::create(['name' => 'asign roleBasedPermission']);

        //ASIGN ROLE TO USER

        Permission::create(['name' => 'asign roleToUser']);
        Permission::create(['name' => 'revoke roleToUser']);

        //user
        Permission::create(['name' => 'User']);
        Permission::create(['name' => 'User Add']);
        Permission::create(['name' => 'User List']);
        Permission::create(['name' => 'user profile']);
        Permission::create(['name' => 'user active deactive']);
        Permission::create(['name' => 'user edit']);
        Permission::create(['name' => 'Change Password']);
        Permission::create(['name' => 'user delete']);

        //Customer
        // Permission::create(['name' => 'Customer']);
        // Permission::create(['name' => 'Customer Add']);
        // Permission::create(['name' => 'Customer List']);
        // Permission::create(['name' => 'Customer delete']);
        // Permission::create(['name' => 'Customer edit']);

        // Permission::create(['name' => 'Set Up']);
        // Permission::create(['name' => 'General Setting']);
    }
}
