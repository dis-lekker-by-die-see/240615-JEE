<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AssociationsTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run()
    {
        DB::table('associations')->insert([
            'association_name' => '岡山県馬術連盟',
            'association_email' => 'okayamabaren@gmail.com',
            'association_password' => Hash::make('1234'),
            'association_president' => '会長',
            'association_secretary' => '事務官',
            'association_mobile' => '123-456-7890',
            'association_phone' => '098-765-4321',
            'association_fax' => '111-222-3333',
            'association_prefecture' => '岡山県',
            'association_address' => '岡山県、日本',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
