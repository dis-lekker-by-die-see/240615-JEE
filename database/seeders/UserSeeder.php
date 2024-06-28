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
            'name' => 'User name - rider', // add user name
            'email' => 'rider@p',          
            'password' => Hash::make('rider'),
            'role' => 'rider', // roles: organizer, club, rider
        ]);

    }
}

// ./vendor/bin/sail shell
// php artisan db:seed --class=UserSeeder