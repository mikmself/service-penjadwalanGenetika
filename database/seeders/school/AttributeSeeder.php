<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel attributes
        Attribute::insert([
            ['name' => 'nama', 'data_type' => 'string'],
            ['name' => 'Ruangan', 'data_type' => 'string'],
            ['name' => 'Siswa', 'data_type' => 'string'],
            ['name' => 'Hari', 'data_type' => 'string'],
            ['name' => 'Waktu', 'data_type' => 'datetime'],
            ['name' => 'Kelas', 'data_type' => 'string'],
        ]);
    }
}
