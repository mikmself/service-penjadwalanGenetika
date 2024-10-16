<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\Entity;
use App\Models\User;

class EntitySeeder extends Seeder
{
    public function run()
    {
        // Membuat entitas untuk sekolah
        Entity::create([
            'name' => 'Guru',
            'entity_type_id' => 1, // Tipe: Manusia
            'schedule_id' => 1,
        ]);

        Entity::create([
            'name' => 'Siswa',
            'entity_type_id' => 1, // Tipe: Manusia
            'schedule_id' => 1,
        ]);

        Entity::create([
            'name' => 'Ruang Kelas',
            'entity_type_id' => 2, // Tipe: Benda
            'schedule_id' => 1,
        ]);

        Entity::create([
            'name' => 'Mata Pelajaran',
            'entity_type_id' => 2, // Tipe: Benda
            'schedule_id' => 1,
        ]);

        Entity::create([
            'name' => 'Jam Pelajaran',
            'entity_type_id' => 2, // Tipe: Benda
            'schedule_id' => 1,
        ]);
    }
}
