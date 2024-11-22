<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfluencerDashboardController extends Controller
{
    public function index()
    {
        return view('influencer.dashboard');
    }
}
