<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EventsImport;

class EventsTableSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
    {
        Excel::import(new EventsImport, '/Users/user1/Barrabas/Okayamabaren/240611-JEE/JapanEquestrianEvents/stuff/Book23.xlsx');
    }
}