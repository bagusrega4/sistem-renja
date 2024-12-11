<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/pegawai.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File pegawai.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('pegawai')->insert([
                'id' => $row[0],
                'nama' => $row[1],
                'nip_lama' => $row[2],
                'nip_baru' => $row[3],
                'jabatan' => $row[4],
                'kode_wilayah' => $row[5],
                'nama_wilayah' => $row[6],
                'golongan' => $row[7],
            ]);
        }

        $this->command->info("Data pegawai berhasil diimpor.");
    }
}
