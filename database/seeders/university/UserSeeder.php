<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // User Superadmin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // User Admin Universitas
        User::create([
            'name' => 'Admin Universitas',
            'email' => 'admin@universitas.com',
            'password' => Hash::make('password'),
        ]);
    }
}
