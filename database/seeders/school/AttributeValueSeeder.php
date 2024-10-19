<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use App\Models\Attribute;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        // Dummy data untuk banyak guru
        $gurus = [
            ['name' => 'Budi Santoso', 'nip' => '123456789'],
            ['name' => 'Ani Rahmawati', 'nip' => '987654321'],
            ['name' => 'Cahyo Putro', 'nip' => '111222333'],
            ['name' => 'Dian Wijaya', 'nip' => '444555666'],
            ['name' => 'Eko Saputra', 'nip' => '777888999'],
        ];

        foreach ($gurus as $guruData) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Nama Lengkap')->first()->id,
                'value_string' => $guruData['name']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'NIP')->first()->id,
                'value_string' => $guruData['nip']
            ]);
        }

        // Dummy data untuk banyak ruang kelas
        $rooms = [
            ['name' => 'Ruang 101', 'kapasitas' => 30],
            ['name' => 'Ruang 102', 'kapasitas' => 25],
            ['name' => 'Ruang 103', 'kapasitas' => 20],
            ['name' => 'Ruang 104', 'kapasitas' => 40],
            ['name' => 'Ruang 105', 'kapasitas' => 35],
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

        // Dummy data untuk mata pelajaran
        $subjects = [
            ['name' => 'Matematika', 'kurikulum' => 'Kurikulum 2013'],
            ['name' => 'Bahasa Indonesia', 'kurikulum' => 'Kurikulum 2013'],
            ['name' => 'Fisika', 'kurikulum' => 'Kurikulum 2013'],
            ['name' => 'Kimia', 'kurikulum' => 'Kurikulum 2013'],
            ['name' => 'Biologi', 'kurikulum' => 'Kurikulum 2013'],
        ];

        foreach ($subjects as $subjectData) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Nama Mata Pelajaran')->first()->id,
                'value_string' => $subjectData['name']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Kurikulum')->first()->id,
                'value_string' => $subjectData['kurikulum']
            ]);
        }

        // Dummy data untuk jam pelajaran
        $scheduleTimes = [
            ['start' => '2024-01-01 08:00:00', 'end' => '2024-01-01 10:00:00'],
            ['start' => '2024-01-01 10:00:00', 'end' => '2024-01-01 12:00:00'],
            ['start' => '2024-01-01 13:00:00', 'end' => '2024-01-01 15:00:00'],
            ['start' => '2024-01-01 15:00:00', 'end' => '2024-01-01 17:00:00'],
        ];

        foreach ($scheduleTimes as $time) {
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Waktu Mulai')->first()->id,
                'value_datetime' => $time['start']
            ]);
            AttributeValue::create([
                'attribute_id' => Attribute::where('name', 'Waktu Selesai')->first()->id,
                'value_datetime' => $time['end']
            ]);
        }
    }
}
