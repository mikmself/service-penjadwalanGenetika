<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Schedule;

class EntitySeeder extends Seeder
{
    public function run()
    {
        // Ambil ID dari EntityType dan Schedule yang baru dibuat
        $dosenTypeId = EntityType::where('name', 'Dosen')->first()->id;
        $ruangTypeId = EntityType::where('name', 'Ruang')->first()->id;
        $mataKuliahTypeId = EntityType::where('name', 'Mata Kuliah')->first()->id;
        $jamKuliahTypeId = EntityType::where('name', 'Jam Kuliah')->first()->id;
        $scheduleId = Schedule::where('name', 'Jadwal Universitas Semester 1')->first()->id;

        // Entitas untuk Dosen
        for ($i = 1; $i <= 3; $i++) {
            Entity::create([
                'name' => 'Dosen',
                'entity_type_id' => $dosenTypeId,
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Ruang Kelas
        for ($i = 1; $i <= 3; $i++) {
            Entity::create([
                'name' => 'Ruang Kelas',
                'entity_type_id' => $ruangTypeId,
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Mata Kuliah
        for ($i = 1; $i <= 5; $i++) {
            Entity::create([
                'name' => 'Mata Kuliah',
                'entity_type_id' => $mataKuliahTypeId,
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Jam Kuliah
        for ($i = 1; $i <= 6; $i++) {
            Entity::create([
                'name' => 'Jam Kuliah',
                'entity_type_id' => $jamKuliahTypeId,
                'schedule_id' => $scheduleId,
            ]);
        }
    }
}
