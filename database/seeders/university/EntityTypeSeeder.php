<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\EntityType;

class EntityTypeSeeder extends Seeder
{
    public function run()
    {
        // Tipe entitas manusia (dosen)
        EntityType::create(['name' => 'Dosen']);

        // Tipe entitas benda (ruang, jam kuliah, mata kuliah)
        EntityType::create(['name' => 'Ruang']);
        EntityType::create(['name' => 'Mata Kuliah']);
        EntityType::create(['name' => 'Jam Kuliah']);
    }
}
