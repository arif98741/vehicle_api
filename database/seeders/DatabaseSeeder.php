<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(2)->create();
        \App\Models\ServiceCategory::factory()->count(3)->create();
        \App\Models\Service::factory()->count(10)->create();

        $roles = [
            'super admin',
            'admin',
            'provider',
            'data-entry'
        ];

        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);
            $permission = Permission::create(['name' => 'edit articles' . uniqid()]);
            $permission->assignRole($role);
        }
    }
}
