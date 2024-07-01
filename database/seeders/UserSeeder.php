<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'nick', // add user name
            'email' => 'nickmoralas@gmail.com',          
            'password' => Hash::make('nick'),
            'role' => 'rider', // roles: organizer, club, rider
        ]);

    }
}

// ./vendor/bin/sail shell
// php artisan db:seed --class=UserSeeder







// User::create([
//     'name' => 'nick', // add user name
//     'email' => 'nickmoralas@gmail.com',          
//     'password' => Hash::make('nick-240701'),
//     'role' => 'rider', // roles: organizer, club, rider
// ]);