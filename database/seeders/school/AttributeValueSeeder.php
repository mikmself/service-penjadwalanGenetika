<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributeValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan data contoh ke tabel attribute_values
        AttributeValue::insert([
            ['attribute_id' => 1, 'value' => 'John Doe'], // Guru
            ['attribute_id' => 2, 'value' => 'Ruang 101'], // Ruang
            ['attribute_id' => 3, 'value' => 'Siswa 1'],   // Siswa
            ['attribute_id' => 4, 'value' => 'Senin'],      // Hari
            ['attribute_id' => 5, 'value' => '08:00'],      // Waktu
            ['attribute_id' => 6, 'value' => 'Kelas A'],    // Kelas
        ]);
    }
}
