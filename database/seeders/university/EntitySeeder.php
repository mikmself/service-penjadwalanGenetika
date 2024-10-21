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
        define('SCHEDULE_ID', 1);
        Entity::create([
            'name' => 'Dosen',
            'schedule_id' => SCHEDULE_ID,
        ]);
        Entity::create([
            'name' => 'Ruang Kelas',
            'schedule_id' => SCHEDULE_ID,
        ]);
        Entity::create([
            'name' => 'Mata Kuliah',
            'schedule_id' => SCHEDULE_ID,
        ]);
        Entity::create([
            'name' => 'Jam Kuliah',
            'schedule_id' => SCHEDULE_ID,
        ]);
    }
}
