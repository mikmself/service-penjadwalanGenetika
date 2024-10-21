<?php

namespace Database\Seeders\university;

use Illuminate\Database\Seeder;
use App\Models\EntityRelationship;
use App\Models\Entity;

class EntityRelationshipSeeder extends Seeder
{
    public function run()
    {
        // Ambil data Dosen dan Mata Kuliah
        $dosens = Entity::where('name', 'Dosen')->get();
        $mataKuliahs = Entity::where('name', 'Mata Kuliah')->get();

        // Buat pasangan dosen dan mata kuliah secara spesifik
        $assignments = [
            'Dr. Budi Santoso' => 'Algoritma dan Struktur Data',
            'Prof. Siti Rahmawati' => 'Pemrograman Berorientasi Objek',
            'Dr. Joko Widodo' => 'Basis Data',
            'Ir. Andi Wijaya' => 'Sistem Operasi',
            'Dr. Dewi Sartika' => 'Pemrograman Web',
            'Prof. Rahmat Hidayat' => 'Jaringan Komputer',
            'Ir. Nia Nurul' => 'Matematika Diskrit',
            'Dr. Agus Salim' => 'Kalkulus',
            'Prof. Faisal Amir' => 'Teori Graf',
            'Dr. Eko Susilo' => 'Pengantar Kecerdasan Buatan',
            'Ir. Ahmad Lutfi' => 'Sistem Operasi',
            'Dr. Nurul Huda' => 'Basis Data',
        ];

        // Loop melalui assignment untuk membuat relasi dosen-mata kuliah
        foreach ($assignments as $dosenName => $mataKuliahName) {
            // Cari dosen berdasarkan nama
            $dosen = $dosens->firstWhere('name', $dosenName);
            // Cari mata kuliah berdasarkan nama
            $mataKuliah = $mataKuliahs->firstWhere('name', $mataKuliahName);

            if ($dosen && $mataKuliah) {
                // Buat relasi antara dosen dan mata kuliah
                EntityRelationship::create([
                    'parent_entity_id' => $dosen->id,
                    'child_entity_id' => $mataKuliah->id,
                    'relationship_type' => 'mengajar',
                ]);
            }
        }
    }
}
