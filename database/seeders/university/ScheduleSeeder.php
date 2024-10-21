<?php

namespace Database\Seeders\university;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    public function run()
    {
        Schedule::insert([
            'user_id' => 2,
            'name' => 'Jadwal Universitas Semester 1',
        ]);
    }
}
