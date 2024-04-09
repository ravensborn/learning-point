<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $systemAdminRole = Role::create([
            'name' => 'system admin'
        ]);

        $accountantRole = Role::create([
            'name' => 'accountant'
        ]);

        $systemAdminPermissions = [
            'manage students',
            'manage subjects',
            'manage sessions',
            'manage employees',
            'manage teachers',
            'manage expenses',
            'view reports',
            'manage users',
            'manage transactions',
            'manage groups',
            'manage schools',
            'manage families',
            'manage settings',
        ];

        $accountantPermissions = [
            'manage students',
            'manage subjects',
            'manage sessions',
            'manage employees',
            'manage teachers',
            'manage expenses',
            'view reports',
            'manage transactions',
            'manage groups',
            'manage schools',
            'manage families',
            'manage settings',
        ];

        foreach ($systemAdminPermissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $systemAdminRole->givePermissionTo($systemAdminPermissions);
        $accountantRole->givePermissionTo($accountantPermissions);


        User::factory()->create([
            'name' => 'Yad',
            'email' => 'yad.hoshyar@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@learning-point.krd',
        ]);


        foreach (User::all() as $user) {

            $avatars = User::getAvatarsArray('male');

            $user->addMedia($avatars[array_rand($avatars)])
                ->preservingOriginal()
                ->toMediaCollection('avatar');

            $user->assignRole($systemAdminRole);
        }
    }
}
