<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel users
        User::insert([
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => Hash::make('password')],
            // buatkan entiti untuk admin sekolah, perusahaan dan universitas
            ['name' => 'Admin Sekolah', 'email' => 'adminsekolah@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Admin Perusahaan', 'email' => 'adminperusahaan@gmail.com', 'password' => Hash::make('password')],
            ['name' => 'Admin Universitas', 'email' => 'adminuniv@gmail.com', 'password' => Hash::make('password')],
        ]);
    }
}
