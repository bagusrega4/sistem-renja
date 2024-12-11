<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/kegiatan.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File kegiatan.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('kegiatan')->insert([
                'id' => $row[0],
                'kode' => $row[1],
                'kegiatan' => $row[2],
                'flag' => $row[3],
            ]);
        }

        $this->command->info("Data kegiatan berhasil diimpor.");
    }
}
