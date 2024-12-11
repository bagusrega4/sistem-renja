<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FormPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/form_pengajuan.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File form_pengajuan.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('form_pengajuan')->insert([
                'no_fp' => $row[0],
                'id_output' => $row[1],
                'kode_komponen' => $row[2],
                'kode_subkomponen' => $row[3],
                'kode_akun' => $row[4],
                'tanggal_mulai' => $row[5],
                'tanggal_akhir' => $row[6],
                'no_sk' => $row[7],
                'uraian' => $row[8],
                'nominal' => $row[9],
                'nip_pengaju' => $row[10],
            ]);
        }

        $this->command->info("Data form_pengajuan berhasil diimpor.");
    }
}
