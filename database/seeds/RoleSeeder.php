<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Role::create([
            'name' => 'Admin',
            'slug' => \App\User::USER_ROLE_ADMIN
        ]);
        \App\Role::create([
            'name' => 'Manager',
            'slug' => \App\User::USER_ROLE_MANAGER
        ]);
    }
}
