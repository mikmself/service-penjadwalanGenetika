<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributeSeeder extends Seeder
{
    public function run()
    {
        // Atribut untuk Guru
        Attribute::create(['name' => 'Nama Lengkap', 'data_type' => 'string']);
        Attribute::create(['name' => 'NIP', 'data_type' => 'string']);

        // Atribut untuk Siswa
        Attribute::create(['name' => 'Nama Lengkap', 'data_type' => 'string']);
        Attribute::create(['name' => 'NIS', 'data_type' => 'string']);

        // Atribut untuk Ruang Kelas
        Attribute::create(['name' => 'Nama Ruang', 'data_type' => 'string']);
        Attribute::create(['name' => 'Kapasitas', 'data_type' => 'integer']);

        // Atribut untuk Mata Pelajaran
        Attribute::create(['name' => 'Nama Mata Pelajaran', 'data_type' => 'string']);
        Attribute::create(['name' => 'Kurikulum', 'data_type' => 'string']);

        // Atribut untuk Jam Pelajaran
        Attribute::create(['name' => 'Waktu Mulai', 'data_type' => 'datetime']);
        Attribute::create(['name' => 'Waktu Selesai', 'data_type' => 'datetime']);
    }
}
