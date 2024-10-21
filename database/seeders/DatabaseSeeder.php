<?php

namespace Database\Seeders;

use Database\Seeders\university\AttributeSeeder;
use Database\Seeders\university\AttributeValueSeeder;
use Database\Seeders\university\EntityRelationshipSeeder;
use Database\Seeders\university\EntitySeeder;
use Database\Seeders\university\EntityTypeSeeder;
use Database\Seeders\university\ScheduleSeeder;
use Database\Seeders\university\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ScheduleSeeder::class,
            EntitySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            EntityRelationshipSeeder::class,
        ]);
    }
}
