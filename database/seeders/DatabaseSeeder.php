<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //     ]);
    // }

    public function run(): void
    {
        $this->call([

            // AssociationsTableSeeder::class,
            // ClubsTableSeeder::class,
            // TeamsTableSeeder::class,
            // HorsesTableSeeder::class,
            // RidersTableSeeder::class,
            // SportsTableSeeder::class,
            // CompetitionsTableSeeder::class,
            // CompetitionSportsTableSeeder::class,
            // FeesTableSeeder::class,
            // EventsTableSeeder::class,
            // UserSeeder::class,


            // php artisan db:seed

        ]);
    }



}
