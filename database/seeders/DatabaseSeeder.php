<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::table('users')
            ->insert(
                [
                    [
                        'first_name' => 'Admin',
                        'last_name' => 'User',
                        'email' => 'admin@gmail.com ',
                        'phone' => '01733499574',
                        'password' => Hash::make('123'),
                        'role' => 1,
                        'user_slug' => 'admin',
                    ],

                ]
            );


        \App\Models\ServiceCategory::factory()->count(3)->create();
        \App\Models\Service::factory()->count(10)->create();

        $roles = [
            'super admin',
            'admin',
            'provider',
            'seeker',
            'data-entry'
        ];

        foreach ($roles as $role) {
            $role = Role::create(['name' => $role]);
            $permission = Permission::create(['name' => 'edit articles' . uniqid()]);
            $permission->assignRole($role);
        }
    }
}
