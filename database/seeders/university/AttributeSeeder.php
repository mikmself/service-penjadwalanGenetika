<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\Entity;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        // Ambil entity yang relevan dari tabel entities
        $dosenEntity = Entity::where('name', 'Dosen')->first();
        $ruangKelasEntity = Entity::where('name', 'Ruang Kelas')->first();
        $mataKuliahEntity = Entity::where('name', 'Mata Kuliah')->first();
        $jamKuliahEntity = Entity::where('name', 'Jam Kuliah')->first();

        // Atribut untuk Dosen
        Attribute::create([
            'entity_id' => $dosenEntity->id,
            'name' => 'Nama Lengkap',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $dosenEntity->id,
            'name' => 'NIDN',
            'data_type' => 'string'
        ]);

        // Atribut untuk Ruang Kelas
        Attribute::create([
            'entity_id' => $ruangKelasEntity->id,
            'name' => 'Nama Ruang',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $ruangKelasEntity->id,
            'name' => 'Kapasitas',
            'data_type' => 'integer'
        ]);

        // Atribut untuk Mata Kuliah
        Attribute::create([
            'entity_id' => $mataKuliahEntity->id,
            'name' => 'Nama Mata Kuliah',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $mataKuliahEntity->id,
            'name' => 'SKS',
            'data_type' => 'integer'
        ]);

        // Atribut untuk Jam Kuliah
        Attribute::create([
            'entity_id' => $jamKuliahEntity->id,
            'name' => 'Waktu Mulai',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $jamKuliahEntity->id,
            'name' => 'Waktu Selesai',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $jamKuliahEntity->id,
            'name' => 'Hari',
            'data_type' => 'string'
        ]);
    }
}
