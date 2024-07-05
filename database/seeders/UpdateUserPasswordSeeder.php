<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        DB::table('users')->where('name', 'User name - club')->update([
            //DB::table('users')->where('email', 'john@example.com')->update([    
                //'name' => 'John Doe',
                //'email' => 'john@example.com',
                'password' => Hash::make('club'),
                //'role' => 'association',
                'updated_at' => now(),

        ]);
    }
}

// ./vendor/bin/sail shell
// php artisan db:seed --class=UpdateUserPasswordSeeder
