<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/status_pengajuan.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File status_pengajuan.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('status_pengajuan')->insert([
                'id' => $row[0],
                'status' => $row[1],
            ]);
        }

        $this->command->info("Data status pengajuan berhasil diimpor.");
    }
}
