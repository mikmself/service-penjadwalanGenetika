<?php

namespace Database\Seeders;

use Database\Seeders\school\AttributeSeeder;
use Database\Seeders\school\AttributeValueSeeder;
use Database\Seeders\school\EntityRelationshipSeeder;
use Database\Seeders\school\EntitySeeder;
use Database\Seeders\school\EntityTypeSeeder;
use Database\Seeders\school\ScheduleSeeder;
use Database\Seeders\school\UserSeeder;
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
            EntityTypeSeeder::class,
            EntitySeeder::class,
            AttributeSeeder::class,
            AttributeValueSeeder::class,
            EntityRelationshipSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}
