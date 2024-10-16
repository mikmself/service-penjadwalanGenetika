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
            ['name' => 'Sekolah 1', 'entity_type_id' => 1,'user_id' => 2],
            ['name' => 'Sekolah 2', 'entity_type_id' => 1,'user_id' => 2],
            ['name' => 'Perusahaan 1', 'entity_type_id' => 2,'user_id' => 3],
            ['name' => 'Perusahaan 2', 'entity_type_id' => 2,'user_id' => 3],
            ['name' => 'Universitas 1', 'entity_type_id' => 3,'user_id' => 4],
            ['name' => 'Universitas 2', 'entity_type_id' => 3,'user_id' => 4],
        ]);
    }
}
