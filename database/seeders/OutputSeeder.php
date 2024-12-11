<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class OutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/output.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File output.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('output')->insert([
                'id' => $row[0],
                'kode_kegiatan' => $row[1],
                'kode_kro' => $row[2],
                'kode_ro' => $row[3],
                'output' => $row[4],
                'flag' => $row[5],
            ]);
        }

        $this->command->info("Data output berhasil diimpor.");
    }
}
