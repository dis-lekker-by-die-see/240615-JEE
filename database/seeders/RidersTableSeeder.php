<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RidersTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('riders')->insert([
            'club_id' => 1, // Assuming a club with ID 1 exists
            'rider_first_names' => '一郎 Mike',
            'rider_first_names_furigana' => 'イチロウ マイク',
            'rider_last_name' => '岡山',
            'rider_last_name_furigana' => 'オカヤマ',
            'rider_registration_number' => '12345',
            'rider_international_registration_number' => 'FEI12345',
            'rider_sex' => '男子', // Example sex, adjust as needed
            'rider_date_of_birth' => '2000-01-01', // Example date of birth
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
