<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
        $role_manger = Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Admin']);
        $role_admin = Role::create(['name' => 'User']);
        Role::create(['name' => 'SubUser']);
        Role::create(['name' => 'AffiliaterForMarketPlace']);

        // Permission Manger
        Permission::create(['name' => 'add_manger']);
        Permission::create(['name' => 'remove_manger']);
        Permission::create(['name' => 'edit_manger']);
        Permission::create(['name' => 'view_mangers']);

        Permission::create(['name' => 'add_sub_manger']);
        Permission::create(['name' => 'remove_sub_manger']);
        Permission::create(['name' => 'edit_sub_manger']);
        Permission::create(['name' => 'view_sub_mangers']);

        Permission::create(['name' => 'add_admin']);
        Permission::create(['name' => 'remove_admin']);
        Permission::create(['name' => 'edit_admin']);
        Permission::create(['name' => 'view_admins']);

        Permission::create(['name' => 'add_sub_admin']);
        Permission::create(['name' => 'remove_sub_admin']);
        Permission::create(['name' => 'edit_sub_admin']);
        Permission::create(['name' => 'view_sub_admins']);

        Permission::create(['name' => 'export_data']);

        //assign Permission to Role Manger
        $role_manger->givePermissionTo(Permission::all());
    }
}
