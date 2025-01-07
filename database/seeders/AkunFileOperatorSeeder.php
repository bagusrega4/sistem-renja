<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AkunFileOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/akun_file_operator.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File akun_file_operator.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('akun_file_operator')->insert([
                'id' => $row[0],
                'id_akun_belanja' => $row[1],
                'id_jenis_file_operator' => $row[2],
            ]);
        }

        $this->command->info("Data akun file operator berhasil diimpor.");
    }
}
