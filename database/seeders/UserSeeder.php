<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $csvFile = fopen(base_path("database/seeders/data/users.csv"), "r");

        $isFirstLine = true;
        while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            User::create([
                'id' => $row[0],
                'nip_lama' => $row[1],
                'username' => $row[2],
                'password' => bcrypt('password123'),
                'email' => $row[4],
                'id_role' => $row[5],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($csvFile);
    }
}
