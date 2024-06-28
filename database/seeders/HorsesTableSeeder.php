<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HorsesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('horses')->insert([
            'club_id' => 1, // Assuming a club with ID 1 exists
            'horse_name' => 'Artax',
            'horse_name_furigana' => 'アルタクス',
            'horse_registration_number' => '12345',
            'horse_international_registration_number' => 'FEI12345',
            'horse_sex' => '牡', // Example sex, adjust as needed
            'horse_age' => 5,
            'horse_color' => '芦毛', // Example color, adjust as needed
            'horse_breed' => 'サラブレッド',
            'horse_origin' => '北海道 (JPN)',
            'horse_owner' => '岡山一郎',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
