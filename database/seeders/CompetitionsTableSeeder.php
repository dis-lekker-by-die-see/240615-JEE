<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetitionsTableSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        DB::table('competitions')->insert([
            [
                'association_id' => 1,
                'competition_name' => '第１回〜馬術競技大会',
                'competition_start_date' => '2020-04-01',
                'competition_end_date' => '2020-04-03',
                'competition_venue' => '蒜山ホースパーク',
                'competition_description' => '大会の簡単な説明をここに記入してください。',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
