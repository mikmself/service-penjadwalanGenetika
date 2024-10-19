<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\Entity;

class EntitySeeder extends Seeder
{
    public function run()
    {
        // Membuat banyak entitas untuk Guru
        for ($i = 1; $i <= 5; $i++) {
            Entity::create([
                'name' => 'Guru',
                'entity_type_id' => 1, // Tipe: Manusia
                'schedule_id' => 1,
            ]);
        }

        // Membuat banyak entitas untuk Ruang Kelas
        for ($i = 1; $i <= 5; $i++) {
            Entity::create([
                'name' => 'Ruang Kelas',
                'entity_type_id' => 2, // Tipe: Benda
                'schedule_id' => 1,
            ]);
        }

        // Membuat banyak entitas untuk Mata Pelajaran
        for ($i = 1; $i <= 5; $i++) {
            Entity::create([
                'name' => 'Mata Pelajaran',
                'entity_type_id' => 2, // Tipe: Benda
                'schedule_id' => 1,
            ]);
        }

        // Membuat banyak entitas untuk Jam Pelajaran
        for ($i = 1; $i <= 4; $i++) {
            Entity::create([
                'name' => 'Jam Pelajaran',
                'entity_type_id' => 2, // Tipe: Benda
                'schedule_id' => 1,
            ]);
        }
    }
}
