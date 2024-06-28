<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('sports')->insert([
            [
                'sport_name' => '馬場馬術',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sport_name' => '障害馬術',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sport_name' => '総合馬術',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sport_name' => 'エンデュランス',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
