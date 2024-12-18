<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();

        $csvFile = fopen(base_path("database/seeders/data/users.csv"), "r");

        $isFirstLine = true;
        while (($row = fgetcsv($csvFile, 1000, ",")) !== false) {
            if ($isFirstLine) {
                $isFirstLine = false;
                continue;
            }

            User::create([
                'nip_lama' => $row[0],
                'username' => $row[1],
                'password' => bcrypt('password123'),
                'email' => $row[3],
                'role' => $row[4] ?? 'user',
                'created_at' => now(),
            ]);
        }

        fclose($csvFile);
    }
}
