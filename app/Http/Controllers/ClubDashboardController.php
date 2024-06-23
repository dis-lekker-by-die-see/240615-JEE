<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClubDashboardController extends Controller
{
    public function index()
    {
        return view('club.dashboard');
    }
}
