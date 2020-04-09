<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    private $adminPermissions = [
        ['name' => 'Home', 'slug' => 'admin.home'],
        ['name' => 'Manager View', 'slug' => 'manager.view'],
        ['name' => 'Employees List', 'slug' => 'employees.index'],
        ['name' => 'Employees Create Page', 'slug' => 'employees.create'],
        ['name' => 'Employees Create', 'slug' => 'employees.store'],
        ['name' => 'Employees Edit Page', 'slug' => 'employees.edit'],
        ['name' => 'Employees Edit', 'slug' => 'employees.update'],
        ['name' => 'Employees Show', 'slug' => 'employees.show'],
        ['name' => 'Employees Delete', 'slug' => 'employees.destroy'],
    ];

    private $managerPermissions = [
        ['name' => 'Home', 'slug' => 'manager.home']
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = \App\Role::whereSlug(\App\User::USER_ROLE_ADMIN)->first();
        $managerRole = \App\Role::whereSlug(\App\User::USER_ROLE_MANAGER)->first();

        foreach ($this->adminPermissions as $adminPermission) {
            $permission = \App\Permission::create($adminPermission);
            $adminRole->permissions()->attach($permission->id);
        }

        foreach ($this->managerPermissions as  $managerPermission) {
            $permission = \App\Permission::create($managerPermission);
            $managerRole->permissions()->attach($permission->id);
        }
    }
}
