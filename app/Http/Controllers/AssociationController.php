<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Club;
use App\Models\User;
use App\Mail\ClubApprovalMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AssociationController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $clubsForApproval = Club::where('is_approved_by_association', false)->get();

        return view('association.dashboard', compact('clubsForApproval'));
    }

    public function approveClub($club_id)
    {
        $club = Club::find($club_id);

        if ($club) {
            $club->is_approved_by_association = true;
            $club->save();
        }

        $clubUser = User::find($club->user_id);
        Mail::to($clubUser->email)->send(new ClubApprovalMail(
            'Club Registration Approved',
            "Your club registration has been approved by the association."
        ));

        return redirect()->route('association.dashboard')->with('success', 'Club approved successfully.');
    }

    public function declineClub($club_id)
    {
        $club = Club::find($club_id);

        if ($club) {
            $club->delete();
        }

        $clubUser = User::find($club->user_id);
        Mail::to($clubUser->email)->send(new ClubApprovalMail(
            'Club Registration Declined',
            "Your club registration has been declined by the association.\n
            Please re-register."
        ));

        return redirect()->route('association.dashboard')->with('success', 'Club declined successfully.');
    }
}
