<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Country;
use App\Models\Club; 
use Illuminate\Support\Facades\Auth;
use App\Rules\Katakana;

class RiderController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $rider = Rider::where('user_id', $user->id)->first();
        $countries = Country::orderBy('country_code', 'asc')->get();
        $clubs = Club::orderBy('club_name', 'asc')->get(); 

        return view('rider.dashboard', compact('rider', 'countries', 'clubs')); 
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'rider_first_names' => 'required|string|max:255',
            'rider_first_names_furigana' => ['required', 'string', 'max:255', new Katakana],
            'rider_last_name' => 'required|string|max:255',
            'rider_last_name_furigana' => ['required', 'string', 'max:255', new Katakana],
            'rider_registration_number' => 'required|string|max:50',
            'rider_international_registration_number' => 'nullable|string|max:50',
            'rider_sex' => 'required|in:女子,男子',
            'rider_date_of_birth' => 'required|date',
            'country_id' => 'required|exists:countries,country_id',
            'club_id' => 'required|exists:clubs,club_id',
            'is_approved_by_club' => 'boolean',
        ]);

        $rider = Rider::where('user_id', $user->id)->first(); // determine if the current user has already registered their rider information.

        if ($rider && $rider->club_id != $validatedData['club_id']) {
            $validatedData['is_approved_by_club'] = false;
        } 

        $rider = Rider::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        return redirect()->route('rider.dashboard')->with('success', 'Information saved successfully.');
    }

    public function getRiderInfo($id)
    {
        $rider = Rider::with('country')->find($id);
        if (!$rider) {
            return response()->json(['error' => 'Rider not found'], 404);
        }
        return response()->json([
            'rider_first_names' => $rider->rider_first_names,
            'rider_first_names_furigana' => $rider->rider_first_names_furigana,
            'rider_last_name' => $rider->rider_last_name,
            'rider_last_name_furigana' => $rider->rider_last_name_furigana,
            'rider_registration_number' => $rider->rider_registration_number,
            'rider_international_registration_number' => $rider->rider_international_registration_number,
            'rider_sex' => $rider->rider_sex,
            'rider_date_of_birth' => $rider->rider_date_of_birth->format('Y-m-d'),
            'country_name' => $rider->country->country_name,
            'country_native_name' => $rider->country->country_native_name,
        ]);
    }


}
