<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel entities
        Entity::insert([
            ['name' => 'Kelas A'],
            ['name' => 'Kelas B'],
            ['name' => 'Shift Pagi'],
            ['name' => 'Shift Siang'],
            ['name' => 'Shift Malam'],
        ]);
    }
}
