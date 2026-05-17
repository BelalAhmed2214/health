<?php

namespace App\Http\Controllers;

use App\Enums\SectionEnum;
use App\Enums\SourceOfMoneyEnum;
use App\Models\Patient;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPatients    = Patient::count();
        $completedCount   = Patient::where('is_completed', true)->count();
        $pendingCount   = Patient::where('is_completed', false)->count();
        $DekhilaCount   = Patient::where('section', SectionEnum::Dekhila)->count();
        $AgamyCount   = Patient::where('section', SectionEnum::Agamy)->count();
        $totalPrice       = Patient::sum('price');
        $charityCount     = Patient::where('source_of_money', SourceOfMoneyEnum::Charity)->count();
        $countryCount     = Patient::where('source_of_money', SourceOfMoneyEnum::Country)->count();
        $recentPatients   = Patient::with('user')->latest()->take(5)->get();
        return view('dashboard', compact('totalPatients', 'completedCount', 'pendingCount', 'DekhilaCount', 'AgamyCount', 'charityCount', 'countryCount', 'totalPrice', 'recentPatients'));
    }
}
