<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

use App\Models\User; 
use Illuminate\Support\Facades\Mail;
use App\Mail\RiderApprovalMail;

use Illuminate\Support\Facades\Log;

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

}
