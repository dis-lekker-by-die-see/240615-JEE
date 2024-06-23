<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionSportsTableSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        DB::table('competition_sports')->insert([
            [
                'competition_id' => 1, // Replace with an actual competition ID
                'sport_id' => 1,       // Replace with an actual sport ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'competition_id' => 1, // Replace with an actual competition ID
                'sport_id' => 2,       // Replace with an actual sport ID
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
