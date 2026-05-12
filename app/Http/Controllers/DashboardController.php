<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients    = Patient::count();
        $completedCount   = Patient::where('is_completed', true)->count();
        $totalUsers       = User::count();
        $recentPatients   = Patient::with('user')->latest()->take(5)->get();

        return view('dashboard', compact('totalPatients', 'completedCount', 'totalUsers', 'recentPatients'));
    }
}
