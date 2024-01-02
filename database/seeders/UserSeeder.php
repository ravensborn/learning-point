<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $systemUserRole = Role::create([
            'name' => 'system user'
        ]);

//        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Yad Hoshyar',
            'email' => 'yad@gmail.com',
            'gender' => 'male'
        ]);


        foreach (User::all() as $user) {

            $avatars = User::getAvatarsArray(['male','female'][array_rand(['male', 'female'])]);

            $user->addMedia($avatars[array_rand($avatars)])
                ->preservingOriginal()
                ->toMediaCollection('avatar');
            $user->assignRole($systemUserRole);
        }
    }
}
