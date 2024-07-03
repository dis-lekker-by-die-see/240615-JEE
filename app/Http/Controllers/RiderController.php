<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;

class RiderController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $rider = Rider::where('user_id', $user->id)->first();
        $countries = Country::all();

        return view('rider.dashboard', compact('rider', 'countries'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'rider_first_names' => 'required|string|max:255',
            'rider_first_names_furigana' => 'required|string|max:255',
            'rider_last_name' => 'required|string|max:255',
            'rider_last_name_furigana' => 'required|string|max:255',
            'rider_registration_number' => 'required|string|max:50',
            'rider_international_registration_number' => 'nullable|string|max:50',
            'rider_sex' => 'required|in:女子,男子',
            'rider_date_of_birth' => 'required|date',
            'country_id' => 'required|exists:countries,country_id',
        ]);

        $rider = Rider::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        return redirect()->route('rider.dashboard')->with('success', 'Information saved successfully.');
    }
}
