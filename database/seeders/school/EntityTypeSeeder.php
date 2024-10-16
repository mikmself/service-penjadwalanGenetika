<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\EntityType;

class EntityTypeSeeder extends Seeder
{
    public function run()
    {
        // Membuat beberapa tipe entitas
        EntityType::create(['name' => 'Manusia']);    // Tipe entitas manusia (guru, siswa)
        EntityType::create(['name' => 'Benda']);      // Tipe entitas benda (ruang, jam)
    }
}
