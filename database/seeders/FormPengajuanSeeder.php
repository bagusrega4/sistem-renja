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
                'id' => $row[0],
                'no_fp' => $row[1],
                'id_output' => $row[2],
                'id_komponen' => $row[3],
                'id_subkomponen' => $row[4],
                'id_akun_belanja' => $row[5],
                'tanggal_mulai' => $row[6],
                'tanggal_akhir' => $row[7],
                'no_sk' => $row[8],
                'uraian' => $row[9],
                'nominal' => $row[10],
                'nip_pengaju' => $row[11],
                'id_status' => $row[12],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info("Data form pengajuan berhasil diimpor.");
    }
}
