<?php

namespace Database\Seeders;

use App\Models\EntityType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel entity_types
        EntityType::insert([
            ['type' => 'Sekolah'],
            ['type' => 'Perusahaan'],
            ['type' => 'Universitas'],
        ]);
    }
}
