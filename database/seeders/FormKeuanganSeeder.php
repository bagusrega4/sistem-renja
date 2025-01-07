<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FormKeuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/form_keuangan.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File form_keuangan.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('form_keuangan')->insert([
                'id' => $row[0],
                'id_form_pengajuan' => $row[1],
                'nip_pengawas' => $row[2],
                'no_spby' => $row[3],
                'no_drpp' => $row[4],
                'no_spm' => $row[5],
                'tanggal_drpp' => $row[6],
                'tanggal_spm' => $row[7],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Data form keuangan berhasil diimpor.");
    }
}
