<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClubsTableSeeder extends Seeder
{
    use WithoutModelEvents;
    
    public function run(): void
    {
        DB::table('clubs')->insert([
            'association_id' => 1, // Assuming an association with ID 1 exists
            'club_name' => '乗馬クラブ',
            'club_email' => 'club@example.com',
            'club_password' => Hash::make('password'),
            'club_registration_officer' => '岡山一郎',
            'club_mobile' => '090-1234-5678',
            'club_phone' => '0867-12-3456',
            'club_fax' => '0867-12-3456',
            'club_address' => '〒700-0000 岡山県住所',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
