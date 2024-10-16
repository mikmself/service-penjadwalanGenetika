<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\EntityRelationship;
use App\Models\Entity;

class EntityRelationshipSeeder extends Seeder
{
    public function run()
    {
        // Membuat relasi entitas (contoh: Guru mengajar Mata Pelajaran)
        $guru = Entity::where('name', 'Guru')->first();
        $mataPelajaran = Entity::where('name', 'Mata Pelajaran')->first();

        EntityRelationship::create([
            'parent_entity_id' => $guru->id,
            'child_entity_id' => $mataPelajaran->id,
            'relationship_type' => 'mengajar',
        ]);

        // Membuat relasi entitas (contoh: Siswa belajar Mata Pelajaran)
        $siswa = Entity::where('name', 'Siswa')->first();

        EntityRelationship::create([
            'parent_entity_id' => $siswa->id,
            'child_entity_id' => $mataPelajaran->id,
            'relationship_type' => 'belajar',
        ]);
    }
}
