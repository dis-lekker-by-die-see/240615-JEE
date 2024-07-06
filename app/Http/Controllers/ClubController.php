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
use App\Mail\ClubApprovalMail;


// class ClubController extends Controller
// {
//     public function dashboard()
//     {
//         $user = Auth::user();
//         $club = Club::where('user_id', $user->id)->first();
        
//         if ($club) {
//             $pendingRidersCount = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->count();
//             return view('club.dashboard', compact('club', 'pendingRidersCount'));
//         }

//         return redirect()->route('dashboard')->with('error', 'Club not found.');
//     }

//     public function show()
//     {
//         $user = Auth::user();
//         $club = Club::where('user_id', $user->id)->first();
//         $countries = Country::orderBy('country_code', 'asc')->get();
//         $associations = Association::orderBy('association_name', 'asc')->get();

//         return view('club.details', compact('club', 'countries', 'associations'));
//     }

//     public function store(Request $request)
//     {
//         $user = Auth::user();
//         $validatedData = $request->validate([
//             'club_name' => 'required|string|max:255',
//             'club_registration_officer' => 'required|string|max:255',
//             'club_mobile' => 'required|string|max:20',
//             'club_phone' => 'nullable|string|max:20',
//             'club_fax' => 'nullable|string|max:20',
//             'club_address' => 'required|string|max:255',
//             'country_id' => 'required|exists:countries,country_id',
//             'association_id' => 'required|exists:associations,association_id',
//             'is_approved_by_association' => 'boolean',
//         ]);

//         $validatedData['user_id'] = $user->id;
//         $validatedData['is_approved_by_association'] = false; // Ensure new club approval is false by default

//         $club = Club::updateOrCreate(
//             ['user_id' => $user->id],
//             $validatedData
//         );

//         $association = Association::find($validatedData['association_id']);
//         $associationUser = User::find($association->user_id);

//         Mail::to($associationUser->email)->send(new ClubApprovalMail(
//             'New Club Approval Request',
//             "A new club has requested approval for your association."
//         ));

//         return redirect()->route('club.dashboard')->with('success', 'Club information saved successfully.');
//     }

//     public function getClubInfo($id)
//     {
//         $club = Club::with('country')->find($id);
//         if (!$club) {
//             return response()->json(['error' => 'Club not found'], 404);
//         }
//         return response()->json([
//             'club_name' => $club->club_name,
//             'club_registration_officer' => $club->club_registration_officer,
//             'club_mobile' => $club->club_mobile,
//             'club_phone' => $club->club_phone,
//             'club_fax' => $club->club_fax,
//             'club_address' => $club->club_address,
//             'country_name' => $club->country->country_name,
//             'country_native_name' => $club->country->country_native_name,
//             'association_name' => $club->association->association_name,
//         ]);
//     }
    
//     public function clubRiders()
//     {
//         $user = Auth::user();
//         $club = Club::where('user_id', $user->id)->first();
        
//         if ($club) {
//             $ridersForApproval = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->get();
//             return view('club.riders', compact('ridersForApproval')); //compact('ridersForApproval', 'club'));
//         }

//         return redirect()->route('club.riders')->with('error', 'Club not found.');
//     }

//     public function approveRider($rider_id)
//     {
//         $rider = Rider::find($rider_id);

//         if ($rider) {
//             $rider->is_approved_by_club = true;
//             $rider->save();
//         }

//         $riderUser = User::find($rider->user_id);
//         Mail::to($riderUser->email)->send(new RiderApprovalMail(
//             'Rider Registration Approved',
//             "Your rider registration has been approved by the club."
//         ));

//         return redirect()->route('club.riders')->with('success', 'Rider approved successfully.');
//     }

//     public function declineRider($rider_id)
//     {
//         $rider = Rider::find($rider_id);

//         if ($rider) {
//             $rider->delete();
//         }

//         $riderUser = User::find($rider->user_id);
//         Mail::to($riderUser->email)->send(new RiderApprovalMail(
//             'Rider Registration Declined',
//             "Your rider registration has been declined by the club.\n
//             Please re-register."
//         ));

//         return redirect()->route('club.riders')->with('success', 'Rider declined successfully.');
//     }

//     public function storeRider(Request $request)
//     {
//         $user = Auth::user();
//         $club = Club::where('user_id', $user->id)->first();

//         $validatedData = $request->validate([
//             'rider_first_names' => 'required|string|max:255',
//             'rider_first_names_furigana' => 'required|string|max:255',
//             'rider_last_name' => 'required|string|max:255',
//             'rider_last_name_furigana' => 'required|string|max:255',
//             'rider_registration_number' => 'nullable|string|max:50',
//             'rider_international_registration_number' => 'nullable|string|max:50',
//             'rider_sex' => 'required|in:女子,男子',
//             'rider_date_of_birth' => 'required|date',
//             'country_id' => 'required|exists:countries,country_id',
//         ]);

//         $validatedData['club_id'] = $club->club_id;
//         $validatedData['is_approved_by_club'] = true; // Automatically approved by club

//         Rider::create($validatedData);

//         return redirect()->route('club.riders')->with('success', 'Rider added successfully.');
//     }
// }

class ClubController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $club = Club::where('user_id', $user->id)->first();
        
        if ($club) {
            $pendingRidersCount = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->count();
            return view('club.dashboard', compact('club', 'pendingRidersCount'));
        }

        return redirect()->route('dashboard')->with('error', 'Club not found.');
    }

    public function show()
    {
        $user = Auth::user();
        $club = Club::where('user_id', $user->id)->first();
        $countries = Country::orderBy('country_code', 'asc')->get();
        $associations = Association::orderBy('association_name', 'asc')->get();

        return view('club.details', compact('club', 'countries', 'associations'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'club_name' => 'required|string|max:255',
            'club_registration_officer' => 'required|string|max:255',
            'club_mobile' => 'required|string|max:20',
            'club_phone' => 'nullable|string|max:20',
            'club_fax' => 'nullable|string|max:20',
            'club_address' => 'required|string|max:255',
            'country_id' => 'required|exists:countries,country_id',
            'association_id' => 'required|exists:associations,association_id',
            'is_approved_by_association' => 'boolean',
        ]);

        $validatedData['user_id'] = $user->id;
        $validatedData['is_approved_by_association'] = false; // Ensure new club approval is false by default

        $club = Club::updateOrCreate(
            ['user_id' => $user->id],
            $validatedData
        );

        $association = Association::find($validatedData['association_id']);
        $associationUser = User::find($association->user_id);

        Mail::to($associationUser->email)->send(new ClubApprovalMail(
            'New Club Approval Request',
            "A new club has requested approval for your association."
        ));

        return redirect()->route('club.dashboard')->with('success', 'Club information saved successfully.');
    }

    public function getClubInfo($id)
    {
        $club = Club::with('country')->find($id);
        if (!$club) {
            return response()->json(['error' => 'Club not found'], 404);
        }
        return response()->json([
            'club_name' => $club->club_name,
            'club_registration_officer' => $club->club_registration_officer,
            'club_mobile' => $club->club_mobile,
            'club_phone' => $club->club_phone,
            'club_fax' => $club->club_fax,
            'club_address' => $club->club_address,
            'country_name' => $club->country->country_name,
            'country_native_name' => $club->country->country_native_name,
            'association_name' => $club->association->association_name,
        ]);
    }
    
    // public function clubRiders()
    // {
    //     $user = Auth::user();
    //     $club = Club::where('user_id', $user->id)->first();
        
    //     if ($club) {
    //         $ridersForApproval = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->get();
    //         $countries = Country::orderBy('country_code', 'asc')->get();
    //         return view('club.riders', compact('ridersForApproval', 'countries'));
    //     }

    //     return redirect()->route('club.riders')->with('error', 'Club not found.');
    // }
    // public function clubRiders()
    // {
    //     $user = Auth::user();
    //     $club = Club::where('user_id', $user->id)->first();
        
    //     if ($club) {
    //         $ridersForApproval = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->get();
    //         $countries = Country::orderBy('country_code', 'asc')->get();
    //         return view('club.riders', compact('ridersForApproval', 'countries'));
    //     }

    //     return redirect()->route('club.riders')->with('error', 'Club not found.');
    // }
    public function clubRiders()
    {
        $user = Auth::user();
        $club = Club::where('user_id', $user->id)->first();
        
        if ($club) {
            $ridersForApproval = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 0)->get();
            $registeredRiders = Rider::where('club_id', $club->club_id)->where('is_approved_by_club', 1)->get();
            $countries = Country::orderBy('country_code', 'asc')->get();
            return view('club.riders', compact('ridersForApproval', 'registeredRiders', 'countries'));
        }

        return redirect()->route('club.riders')->with('error', 'Club not found.');
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

        return redirect()->route('club.riders')->with('success', 'Rider approved successfully.');
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

        return redirect()->route('club.riders')->with('success', 'Rider declined successfully.');
    }

    public function storeRider(Request $request)
    {
        $user = Auth::user();
        $club = Club::where('user_id', $user->id)->first();
        
        if (!$club) {
            return redirect()->route('club.riders')->with('error', 'Club not found.');
        }

        $validatedData = $request->validate([
            'rider_first_names' => 'required|string|max:255',
            'rider_first_names_furigana' => 'required|string|max:255',
            'rider_last_name' => 'required|string|max:255',
            'rider_last_name_furigana' => 'required|string|max:255',
            'rider_registration_number' => 'nullable|string|max:50',
            'rider_international_registration_number' => 'nullable|string|max:50',
            'rider_sex' => 'required|in:女子,男子',
            'rider_date_of_birth' => 'required|date',
            'country_id' => 'required|exists:countries,country_id',
        ]);

        $validatedData['club_id'] = $club->club_id;
        $validatedData['is_approved_by_club'] = true;

        Rider::create($validatedData);

        return redirect()->route('club.riders')->with('success', 'Rider added successfully.');
    }
}
