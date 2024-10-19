<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\EntityRelationship;
use App\Models\Entity;

class EntityRelationshipSeeder extends Seeder
{
    public function run()
    {
        $gurus = Entity::where('name', 'Guru')->get();
        $mataPelajaranList = Entity::where('name', 'Mata Pelajaran')->get();

        // Membuat relasi entitas (contoh: Guru mengajar Mata Pelajaran)
        foreach ($gurus as $guru) {
            foreach ($mataPelajaranList as $mataPelajaran) {
                EntityRelationship::create([
                    'parent_entity_id' => $guru->id,
                    'child_entity_id' => $mataPelajaran->id,
                    'relationship_type' => 'mengajar',
                ]);
            }
        }
    }
}
