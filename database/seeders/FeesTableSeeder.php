<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeesTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('fees')->insert([
            [
                'fee_code' => '馬',
                'fee_description' => '馬登録料',
                'fee_price' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => '公認',
                'fee_description' => '公認競技',
                'fee_price' => 12000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => '一般',
                'fee_description' => '一般競技',
                'fee_price' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => 'フレンドシップ',
                'fee_description' => '一般競技 (フレンドシップ)',
                'fee_price' => 7000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => 'ジムカーナ',
                'fee_description' => '一般競技 (ジムカーナ)',
                'fee_price' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => '大会参加',
                'fee_description' => '大会参加費',
                'fee_price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'fee_code' => '特別競技',
                'fee_description' => '特別競技参加費',
                'fee_price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more rows as needed
        ]);
    }
}
