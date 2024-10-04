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
            ['name' => 'Guru'],
            ['name' => 'Ruang'],
            ['name' => 'Siswa'],
            ['name' => 'Hari'],
            ['name' => 'Waktu'],
            ['name' => 'Kelas'],
        ]);
    }
}
