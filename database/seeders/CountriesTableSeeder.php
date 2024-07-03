<?php

// namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB;

// class CountriesTableSeeder extends Seeder
// {
    
//     public function run(): void
//     {
//         $json = file_get_contents('https://restcountries.com/v3.1/all');
//         $countries = json_decode($json, true);

//         foreach ($countries as $country) {
//             $official_name = $country['name']['official'];
//             $native_name = collect($country['name']['nativeName'])->map(function ($item) {
//                 return $item['official'];
//             })->first();
//             $country_code = $country['cca3'];
//             $country_emoji = $country['flag'];
//             $flag_code = strtolower($country['cca2']);
//             $flag_1x1 = "storage/flags/1x1/{$flag_code}.svg";
//             $flag_4x3 = "storage/flags/4x3/{$flag_code}.svg";

//             DB::table('countries')->insert([
//                 'country_name' => $official_name,
//                 'country_native_name' => $native_name,
//                 'country_code' => $country_code,
//                 'country_emoji' => $country_emoji,
//                 'country_flag_1x1' => $flag_1x1,
//                 'country_flag_4x3' => $flag_4x3,
//             ]);
//         }
//     }
// }
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $json = file_get_contents('https://restcountries.com/v3.1/all');
        $countries = json_decode($json, true);

        foreach ($countries as $country) {
            $official_name = $country['name']['official'];
            $native_name = isset($country['name']['nativeName']) 
                           ? collect($country['name']['nativeName'])->map(function ($item) {
                               return $item['official'];
                           })->first()
                           : $official_name;
            $country_code = $country['cca3'];
            $country_emoji = $country['flag'];
            $flag_code = strtolower($country['cca2']);
            $flag_1x1 = "storage/flags/1x1/{$flag_code}.svg";
            $flag_4x3 = "storage/flags/4x3/{$flag_code}.svg";

            DB::table('countries')->insert([
                'country_name' => $official_name,
                'country_native_name' => $native_name,
                'country_code' => $country_code,
                'country_emoji' => $country_emoji,
                'country_flag_1x1' => $flag_1x1,
                'country_flag_4x3' => $flag_4x3,
            ]);
        }
    }
}





// run inside sail
// php artisan db:seed --class=CountriesTableSeeder
