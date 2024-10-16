<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ['user_id' => 1, 'name' => 'Jadwal Kelas A', 'start_time' => '2024-10-05 08:00:00', 'end_time' => '2024-10-05 10:00:00'],
            ['user_id' => 2, 'name' => 'Shift Pagi', 'start_time' => '2024-10-05 06:00:00', 'end_time' => '2024-10-05 14:00:00'],
            ['user_id' => 3, 'name' => 'Shift Siang', 'start_time' => '2024-10-05 14:00:00', 'end_time' => '2024-10-05 22:00:00'],
            ['user_id' => 4, 'name' => 'Kelas B', 'start_time' => '2024-10-05 10:00:00', 'end_time' => '2024-10-05 12:00:00'],
        ]);
    }
}
