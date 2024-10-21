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
        $scheduleId = Schedule::where('name', 'Jadwal Universitas Semester 1')->first()->id;

        // Entitas untuk Dosen
        for ($i = 1; $i <= 3; $i++) {
            Entity::create([
                'name' => 'Dosen',
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Ruang Kelas
        for ($i = 1; $i <= 3; $i++) {
            Entity::create([
                'name' => 'Ruang Kelas',
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Mata Kuliah
        for ($i = 1; $i <= 5; $i++) {
            Entity::create([
                'name' => 'Mata Kuliah',
                'schedule_id' => $scheduleId,
            ]);
        }

        // Entitas untuk Jam Kuliah
        for ($i = 1; $i <= 6; $i++) {
            Entity::create([
                'name' => 'Jam Kuliah',
                'schedule_id' => $scheduleId,
            ]);
        }
    }
}
