<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\FormPengajuan;
use App\Models\Komponen;
use App\Models\KRO;
use App\Models\SubKomponen;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AkunBelanjaSeeder::class);
        $this->call(KROSeeder::class);
        $this->call(KegiatanSeeder::class);
        $this->call(KomponenSeeder::class);
        $this->call(SubKomponenSeeder::class);
        $this->call(OutputSeeder::class);
        $this->call(StatusPengajuanSeeder::class);
        $this->call(FormPengajuanSeeder::class);
        $this->call(JenisFileOperatorSeeder::class);
        $this->call(AkunFileOperatorSeeder::class);
        $this->call(JenisFileKeuanganSeeder::class);
        $this->call(AkunFileKeuanganSeeder::class);
        $this->call(FormKeuanganSeeder::class);

    }
}
