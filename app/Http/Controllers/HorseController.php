<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horse;
use App\Models\Country;
use App\Models\Club;
use App\Models\User; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Rules\Katakana;
use App\Mail\RiderApprovalMail;

class HorseController extends Controller
{
    public function getHorseInfo($id)
    {
        $horse = Horse::with('country')->find($id);
        if (!$horse) {
            return response()->json(['error' => 'Horse not found'], 404);
        }
        return response()->json([
            'horse_name' => $horse->horse_name,
            'horse_name_furigana' => $horse->horse_name_furigana,
            'horse_registration_number' => $horse->horse_registration_number,
            'horse_international_registration_number' => $horse->horse_international_registration_number,
            'horse_sex' => $horse->horse_sex,
            'horse_age' => $horse->horse_age,
            'horse_color' => $horse->horse_color,
            'horse_breed' => $horse->horse_breed,
            'horse_origin' => $horse->horse_origin,
            'horse_owner' => $horse->horse_owner,
            'country_name' => $horse->country->country_name,
            'country_native_name' => $horse->country->country_native_name,
        ]);
    }
}