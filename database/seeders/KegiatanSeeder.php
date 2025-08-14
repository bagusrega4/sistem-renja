<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KegiatanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kegiatan')->insert([
            ['nama_kegiatan' => 'Rapat Koordinasi', 'deskripsi' => 'Rapat koordinasi internal tim', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kegiatan' => 'Sosialisasi Program', 'deskripsi' => 'Sosialisasi program kerja ke masyarakat', 'created_at' => now(), 'updated_at' => now()],
            ['nama_kegiatan' => 'Pelatihan', 'deskripsi' => 'Pelatihan untuk anggota tim', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
