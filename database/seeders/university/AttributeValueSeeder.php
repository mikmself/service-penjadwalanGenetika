<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\Attribute;
use App\Models\AttributeValue;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        // Data untuk Dosen (12 dosen sesuai jurusan Informatika)
        $dosens = [
            ['name' => 'Dr. Budi Santoso', 'nidn' => '1100110011'],
            ['name' => 'Prof. Siti Rahmawati', 'nidn' => '1200120012'],
            ['name' => 'Dr. Joko Widodo', 'nidn' => '1300130013'],
            ['name' => 'Ir. Andi Wijaya', 'nidn' => '1400140014'],
            ['name' => 'Dr. Dewi Sartika', 'nidn' => '1500150015'],
            ['name' => 'Prof. Rahmat Hidayat', 'nidn' => '1600160016'],
            ['name' => 'Ir. Nia Nurul', 'nidn' => '1700170017'],
            ['name' => 'Dr. Agus Salim', 'nidn' => '1800180018'],
            ['name' => 'Prof. Faisal Amir', 'nidn' => '1900190019'],
            ['name' => 'Dr. Eko Susilo', 'nidn' => '2000200020'],
            ['name' => 'Ir. Ahmad Lutfi', 'nidn' => '2100210021'],
            ['name' => 'Dr. Nurul Huda', 'nidn' => '2200220022'],
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

        // Data untuk Ruang Kelas (4 ruang kelas)
        $rooms = [
            ['name' => 'Ruang 101', 'kapasitas' => 40],
            ['name' => 'Ruang 102', 'kapasitas' => 35],
            ['name' => 'Ruang 103', 'kapasitas' => 30],
            ['name' => 'Ruang 104', 'kapasitas' => 50],
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

        // Data untuk Mata Kuliah (10 mata kuliah: 6 mata kuliah 2 SKS dan 4 mata kuliah 3 SKS)
        $mataKuliahs = [
            ['name' => 'Algoritma dan Struktur Data', 'sks' => 3],
            ['name' => 'Pemrograman Berorientasi Objek', 'sks' => 3],
            ['name' => 'Basis Data', 'sks' => 3],
            ['name' => 'Sistem Operasi', 'sks' => 3],
            ['name' => 'Pemrograman Web', 'sks' => 2],
            ['name' => 'Jaringan Komputer', 'sks' => 2],
            ['name' => 'Matematika Diskrit', 'sks' => 2],
            ['name' => 'Kalkulus', 'sks' => 2],
            ['name' => 'Teori Graf', 'sks' => 2],
            ['name' => 'Pengantar Kecerdasan Buatan', 'sks' => 2],
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

        // Data untuk Jam Kuliah (Tetap sama)
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
