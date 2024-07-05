<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

use App\Models\User; 
use Illuminate\Support\Facades\Mail;
use App\Mail\RiderApprovalMail;
use App\Models\Association;
use Illuminate\Support\Facades\Log;

use App\Models\Country;

class ClubController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $club = Club::where('user_id', $user->id)->first();
        
        if ($club) {
            $ridersForApproval = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->get();
            return view('club.dashboard', compact('ridersForApproval'));
        }

        return redirect()->route('dashboard')->with('error', 'Club not found.');
    }

    public function approveRider($rider_id)
    {
        $rider = Rider::find($rider_id);

        if ($rider) {
            $rider->is_approved_by_club = true;
            $rider->save();
        }

        $riderUser = User::find($rider->user_id);
        Mail::to($riderUser->email)->send(new RiderApprovalMail(
            'Rider Registration Approved',
            "Your rider registration has been approved by the club."
        ));

        return redirect()->route('club.dashboard')->with('success', 'Rider approved successfully.');
    }

    public function declineRider($rider_id)
    {
        $rider = Rider::find($rider_id);

        if ($rider) {
            $rider->delete();
        }

        $riderUser = User::find($rider->user_id);
        Mail::to($riderUser->email)->send(new RiderApprovalMail(
            'Rider Registration Declined',
            "Your rider registration has been declined by the club.\n
            Please re-register."
        ));

        return redirect()->route('club.dashboard')->with('success', 'Rider declined successfully.');
    }

    public function show()
    {
        $user = Auth::user();
        $rider = Club::where('user_id', $user->id)->first();
        $countries = Country::orderBy('country_code', 'asc')->get();
        $associations = Association::orderBy('association_name', 'asc')->get();

        return view('club.dashboard', compact('club', 'countries', 'associations'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            
        
            
            'club_name',
            'club_registration_officer',
            'club_mobile',
            'club_phone',
            'club_fax',
            'club_address',
            'country_id' => 'required|exists:countries,country_id',
            'association_id' => 'required|exists:associations,association_id',
            'is_approved_by_association' => 'boolean',

        ]);

    }





}
