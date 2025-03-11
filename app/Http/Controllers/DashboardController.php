<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;

class DashboardController extends Controller
{
    public function index()
    {
        // Haal de ingelogde gebruiker op
        $user = Auth::user();

        // Haal het profiel van de ingelogde gebruiker op
        $profile = Profile::where('user_id', $user->id)->first();

        // Stuur de data naar de view
        return view('dashboards.dashboard', compact('user', 'profile'));
    }
}
