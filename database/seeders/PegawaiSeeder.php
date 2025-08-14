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
        $filePath = database_path('seeders/data/Pegawai.json');

        if (!File::exists($filePath)) {
            $this->command->error("File Pegawai.json tidak ditemukan.");
            return;
        }

        $jsonData = File::get($filePath);
        $pegawaiList = json_decode($jsonData, true);

        if ($pegawaiList === null) {
            $this->command->error("Gagal decode JSON. Pastikan format JSON valid.");
            return;
        }

        foreach ($pegawaiList as $pegawai) {
            DB::table('pegawai')->insert([
                'id' => $pegawai['id'],
                'nama' => $pegawai['nama'],
                'nip_lama' => $pegawai['nip_lama'],
                'nip_baru' => $pegawai['nip_baru'],
                'jabatan' => $pegawai['jabatan'],
                'kode_wilayah' => $pegawai['kode_wilayah'],
                'nama_wilayah' => $pegawai['nama_wilayah'],
                'golongan' => $pegawai['golongan'],
            ]);
        }

        $this->command->info("Data pegawai berhasil diimpor dari JSON.");
    }
}
