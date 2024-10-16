<?php

namespace Database\Seeders\school;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel schedules
        Schedule::insert([
            ['user_id' => 2, 'name' => 'Jadwal Sekolah', 'start_time' => '2024-10-05 08:00:00', 'end_time' => '2024-10-05 10:00:00'],
        ]);
    }
}
