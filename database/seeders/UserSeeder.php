<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->first();

        $user = User::create([
            'name' => 'admin',
            'email'=> 'admin@mail.com',
            'username' => 'admin',
            'password' => Hash::make('Test1234!'),
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFMnFpC4hRXGKHDOcTWn5JG3v0Pg9Ei6Hn8a9Z79Q&s',
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        $role = Role::where('name', 'user')->first();

        $user = User::create([
            'name' => 'user',
            'email'=> 'user@mail.com',
            'username' => 'user',
            'password' => Hash::make('Test1234!'),
            'profile_pic' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSFMnFpC4hRXGKHDOcTWn5JG3v0Pg9Ei6Hn8a9Z79Q&s',
        ]);

        UserRole::create([
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);
    }
}
