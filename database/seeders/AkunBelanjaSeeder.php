<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AkunBelanjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = database_path('seeders/data/akun_belanja.csv');

        if (!File::exists($filePath)) {
            $this->command->error("File akun_belanja.csv tidak ditemukan.");
            return;
        }

        $data = array_map('str_getcsv', file($filePath));
        $header = array_shift($data);

        foreach ($data as $row) {
            DB::table('akun_belanja')->insert([
                'id' => $row[0],
                'kode' => $row[1],
                'nama_akun' => $row[2],
                'flag' => $row[3],
            ]);
        }

        $this->command->info("Data akun_belanja berhasil diimpor.");
    }
}
