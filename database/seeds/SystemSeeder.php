<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// use Config;

class SystemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $this->permission();
        $this->roles();
    }

    public function permission() {
        Permission::create(['name' => 'manage invitations', 'guard_name' => Config::get('system.system_guard')]);
        Permission::create(['name' => 'manage roles', 'guard_name' => Config::get('system.system_guard')]);
    }

    public function roles() {
        Role::create(['name' => 'invitation manager', 'guard_name' => Config::get('system.system_guard')])
            ->givePermissionTo(['manage invitations']);
        Role::create(['name' => 'Roles manager', 'guard_name' => Config::get('system.system_guard')])
            ->givePermissionTo(['manage roles']);
        $role = Role::create(['name' => 'super-admin', 'guard_name' => Config::get('system.system_guard')]);
        $role->givePermissionTo(Permission::all());
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    }
}
