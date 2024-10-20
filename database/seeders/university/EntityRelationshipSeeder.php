<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\EntityRelationship;
use App\Models\Entity;

class EntityRelationshipSeeder extends Seeder
{
    public function run()
    {
        $dosens = Entity::where('name', 'Dosen')->get();
        $mataKuliahs = Entity::where('name', 'Mata Kuliah')->get();

        foreach ($dosens as $dosen) {
            foreach ($mataKuliahs as $mataKuliah) {
                EntityRelationship::create([
                    'parent_entity_id' => $dosen->id,
                    'child_entity_id' => $mataKuliah->id,
                    'relationship_type' => 'mengajar',
                ]);
            }
        }
    }
}
