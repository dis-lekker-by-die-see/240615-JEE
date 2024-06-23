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
            'name' => 't',
            'email' => 't@p.com',
            'password' => Hash::make('t'),
            'role' => 'member',
        ]);

        // User::create([
        //     'name' => 'Member User',
        //     'email' => 'member@example.com',
        //     'password' => Hash::make('password'),
        //     'role' => 'member',
        // ]);
    }
}

// php artisan db:seed --class=UserSeeder