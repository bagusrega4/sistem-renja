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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(AkunBelanjaSeeder::class);
        $this->call(FormPengajuanSeeder::class);
        $this->call(KegiatanSeeder::class);
        $this->call(KomponenSeeder::class);
        $this->call(SubKomponenSeeder::class);
        $this->call(KROSeeder::class);
        $this->call(OutputSeeder::class);
        $this->call(PegawaiSeeder::class);
        // $this->call(ROSeeder::class);
    }
}
