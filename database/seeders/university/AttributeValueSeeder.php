<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use App\Models\Attribute;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        // Data untuk Dosen
        $dosens = [
            ['name' => 'Dr. Ahmad Fauzi', 'nidn' => '1100110011'],
            ['name' => 'Prof. Siti Nurhaliza', 'nidn' => '1200120012'],
            ['name' => 'Ir. Budi Prasetyo', 'nidn' => '1300130013'],
        ];

        foreach ($dosens as $dosenData) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Nama Lengkap')->first()->id,
                'value_string' => $dosenData['name']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'NIDN')->first()->id,
                'value_string' => $dosenData['nidn']
            ]);
        }

        // Data untuk Ruang Kelas
        $rooms = [
            ['name' => 'Ruang 101', 'kapasitas' => 40],
            ['name' => 'Ruang 102', 'kapasitas' => 30],
            ['name' => 'Ruang 103', 'kapasitas' => 50],
        ];

        foreach ($rooms as $roomData) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Nama Ruang')->first()->id,
                'value_string' => $roomData['name']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Kapasitas')->first()->id,
                'value_int' => $roomData['kapasitas']
            ]);
        }

        // Data untuk Mata Kuliah
        $mataKuliahs = [
            ['name' => 'Pemrograman Web', 'sks' => 3],
            ['name' => 'Kalkulus', 'sks' => 2],
            ['name' => 'Struktur Data', 'sks' => 3],
            ['name' => 'Basis Data', 'sks' => 3],
            ['name' => 'Algoritma', 'sks' => 3],
        ];

        foreach ($mataKuliahs as $mataKuliahData) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Nama Mata Kuliah')->first()->id,
                'value_string' => $mataKuliahData['name']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'SKS')->first()->id,
                'value_int' => $mataKuliahData['sks']
            ]);
        }

        // Data untuk Jam Kuliah
        $scheduleTimes = [
            ['start' => '08:00:00', 'end' => '10:00:00', 'day' => 'Senin'],
            ['start' => '10:00:00', 'end' => '12:00:00', 'day' => 'Selasa'],
            ['start' => '13:00:00', 'end' => '15:00:00', 'day' => 'Rabu'],
            ['start' => '15:00:00', 'end' => '17:00:00', 'day' => 'Kamis'],
            ['start' => '08:00:00', 'end' => '10:00:00', 'day' => 'Jumat'],
            ['start' => '10:00:00', 'end' => '12:00:00', 'day' => 'Sabtu'],
        ];

        foreach ($scheduleTimes as $time) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Waktu Mulai')->first()->id,
                'value_string' => $time['start']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Waktu Selesai')->first()->id,
                'value_string' => $time['end']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Hari')->first()->id,
                'value_string' => $time['day']
            ]);
        }
    }
}
