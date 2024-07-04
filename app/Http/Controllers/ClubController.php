<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Rider;
// use App\Models\Club;
// use Illuminate\Support\Facades\Auth;

// class ClubController extends Controller
// {
//     public function dashboard()
//     {
//         $club_id = Auth::user()->club->club_id;
//         $ridersForApproval = Rider::where('club_id', $club_id)->where('is_approved_by_club', false)->get();

//         return view('club.dashboard', compact('ridersForApproval'));
//     }

//     public function approveRider(Request $request, $rider_id)
//     {
//         $rider = Rider::findOrFail($rider_id);
//         $rider->is_approved_by_club = true;
//         $rider->save();

//         return response()->json(['success' => true]);
//     }

//     public function declineRider(Request $request, $rider_id)
//     {
//         $rider = Rider::findOrFail($rider_id);
//         $rider->delete(); // or set a status indicating decline

//         return response()->json(['success' => true]);
//     }
// }


// class ClubController extends Controller
// {
//     public function dashboard()
//     {
//         $user = Auth::user();
//         $club_id = $user->club_id;
//         $ridersForApproval = Rider::where('club_id', $club_id)->where('is_approved_by_club', 0)->get();

//         return view('club.dashboard', compact('ridersForApproval'));
//     }

//     public function approveRider($rider_id)
//     {
//         $rider = Rider::find($rider_id);

//         if ($rider) {
//             $rider->is_approved_by_club = true;
//             $rider->save();
//         }

//         return redirect()->route('club.dashboard')->with('success', 'Rider approved successfully.');
//     }

//     public function declineRider($rider_id)
//     {
//         $rider = Rider::find($rider_id);

//         if ($rider) {
//             $rider->delete();
//         }

//         return redirect()->route('club.dashboard')->with('success', 'Rider declined successfully.');
//     }
// }

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rider;
use App\Models\Club;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('club.dashboard')->with('success', 'Rider approved successfully.');
    }

    public function declineRider($rider_id)
    {
        $rider = Rider::find($rider_id);

        if ($rider) {
            $rider->delete();
        }

        return redirect()->route('club.dashboard')->with('success', 'Rider declined successfully.');
    }
}
