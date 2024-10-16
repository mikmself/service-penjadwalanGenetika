<?php

namespace Database\Seeders\school;

use Illuminate\Database\Seeder;
use App\Models\AttributeValue;
use App\Models\Entity;
use App\Models\Attribute;

class AttributeValueSeeder extends Seeder
{
    public function run()
    {
        // Dummy data untuk guru
        $guru = Entity::where('name', 'Guru')->first();
        AttributeValue::create([
            'entity_id' => $guru->id,
            'attribute_id' => Attribute::where('name', 'Nama Lengkap')->first()->id,
            'value_string' => 'Budi Santoso'
        ]);
        AttributeValue::create([
            'entity_id' => $guru->id,
            'attribute_id' => Attribute::where('name', 'NIP')->first()->id,
            'value_string' => '123456789'
        ]);

        // Dummy data untuk siswa
        $siswa = Entity::where('name', 'Siswa')->first();
        AttributeValue::create([
            'entity_id' => $siswa->id,
            'attribute_id' => Attribute::where('name', 'Nama Lengkap')->first()->id,
            'value_string' => 'Adi Pratama'
        ]);
        AttributeValue::create([
            'entity_id' => $siswa->id,
            'attribute_id' => Attribute::where('name', 'NIS')->first()->id,
            'value_string' => '987654321'
        ]);

        // Dummy data untuk ruang kelas
        $ruangKelas = Entity::where('name', 'Ruang Kelas')->first();
        AttributeValue::create([
            'entity_id' => $ruangKelas->id,
            'attribute_id' => Attribute::where('name', 'Nama Ruang')->first()->id,
            'value_string' => 'Ruang 101'
        ]);
        AttributeValue::create([
            'entity_id' => $ruangKelas->id,
            'attribute_id' => Attribute::where('name', 'Kapasitas')->first()->id,
            'value_int' => 30
        ]);

        // Dummy data untuk mata pelajaran
        $mataPelajaran = Entity::where('name', 'Mata Pelajaran')->first();
        AttributeValue::create([
            'entity_id' => $mataPelajaran->id,
            'attribute_id' => Attribute::where('name', 'Nama Mata Pelajaran')->first()->id,
            'value_string' => 'Matematika'
        ]);
        AttributeValue::create([
            'entity_id' => $mataPelajaran->id,
            'attribute_id' => Attribute::where('name', 'Kurikulum')->first()->id,
            'value_string' => 'Kurikulum 2013'
        ]);

        // Dummy data untuk jam pelajaran
        $jamPelajaran = Entity::where('name', 'Jam Pelajaran')->first();
        AttributeValue::create([
            'entity_id' => $jamPelajaran->id,
            'attribute_id' => Attribute::where('name', 'Waktu Mulai')->first()->id,
            'value_datetime' => '2024-01-01 08:00:00'
        ]);
        AttributeValue::create([
            'entity_id' => $jamPelajaran->id,
            'attribute_id' => Attribute::where('name', 'Waktu Selesai')->first()->id,
            'value_datetime' => '2024-01-01 10:00:00'
        ]);
    }
}

