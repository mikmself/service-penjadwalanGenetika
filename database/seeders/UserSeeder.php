<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel users
        User::insert([
            ['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password')],
            ['name' => 'Guru 1', 'email' => 'guru1@example.com', 'password' => bcrypt('password')],
            ['name' => 'Siswa 1', 'email' => 'siswa1@example.com', 'password' => bcrypt('password')],
            ['name' => 'Siswa 2', 'email' => 'siswa2@example.com', 'password' => bcrypt('password')],
        ]);
    }
}
