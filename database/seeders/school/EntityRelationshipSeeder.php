<?php

namespace Database\Seeders;

use App\Models\EntityRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntityRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel entity_relationships
        EntityRelationship::insert([
            ['entity_id_1' => 1, 'entity_id_2' => 3, 'relationship_type' => 'Mengajar'],
            ['entity_id_1' => 2, 'entity_id_2' => 4, 'relationship_type' => 'Ditempatkan Di'],
        ]);
    }
}
