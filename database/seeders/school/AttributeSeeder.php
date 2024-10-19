<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\Entity;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        // Ambil entity yang relevan dari tabel entities
        $guruEntity = Entity::where('name', 'Guru')->first();
        $ruangKelasEntity = Entity::where('name', 'Ruang Kelas')->first();
        $mataPelajaranEntity = Entity::where('name', 'Mata Pelajaran')->first();
        $jamPelajaranEntity = Entity::where('name', 'Jam Pelajaran')->first();

        // Atribut untuk Guru
        Attribute::create([
            'entity_id' => $guruEntity->id,
            'name' => 'Nama Lengkap',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $guruEntity->id,
            'name' => 'NIP',
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

        // Atribut untuk Mata Pelajaran
        Attribute::create([
            'entity_id' => $mataPelajaranEntity->id,
            'name' => 'Nama Mata Pelajaran',
            'data_type' => 'string'
        ]);
        Attribute::create([
            'entity_id' => $mataPelajaranEntity->id,
            'name' => 'Kurikulum',
            'data_type' => 'string'
        ]);

        // Atribut untuk Jam Pelajaran
        Attribute::create([
            'entity_id' => $jamPelajaranEntity->id,
            'name' => 'Waktu Mulai',
            'data_type' => 'datetime'
        ]);
        Attribute::create([
            'entity_id' => $jamPelajaranEntity->id,
            'name' => 'Waktu Selesai',
            'data_type' => 'datetime'
        ]);
    }
}
