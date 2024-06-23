<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KamiDashboardController extends Controller
{
    public function index()
    {
        return view('kami.dashboard');
    }
}
