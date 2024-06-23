<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamsTableSeeder extends Seeder
{
    use WithoutModelEvents;
    
    public function run(): void
    {
        DB::table('teams')->insert([
            'club_id' => 1, 
            'team_name' => '乗馬クラブ・チーム A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

        