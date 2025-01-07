<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class JenisFileKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/jenis_file_keuangan.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File jenis_file_keuangan.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('jenis_file_keuangan')->insert([
                'id' => $row[0],
                'nama_file' => $row[1],
                'flag' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Data jenis file keuangan berhasil diimpor.");
    }
}
