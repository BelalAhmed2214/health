<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;
use App\Models\Visit;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients = Patient::count();
        $totalVisits   = Visit::count();
        $totalUsers    = User::count();
        $recentVisits  = Visit::with('patient')->latest()->take(5)->get();

        return view('dashboard', compact('totalPatients', 'totalVisits', 'totalUsers', 'recentVisits'));
    }
}
