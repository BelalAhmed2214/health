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
        $user = auth()->user();

        // Base query — scoped to user's section if they are a section user
        $base = Patient::query();
        if ($user->isSectionUser()) {
            $base->where('section', $user->section);
        }

        $totalPatients  = (clone $base)->count();
        $completedCount = (clone $base)->where('is_completed', true)->count();
        $pendingCount   = (clone $base)->where('is_completed', false)->count();
        $DekhilaCount   = (clone $base)->where('section', SectionEnum::Dekhila)->count();
        $AgamyCount     = (clone $base)->where('section', SectionEnum::Agamy)->count();
        $charityCount   = (clone $base)->where('source_of_money', SourceOfMoneyEnum::Charity)->count();
        $countryCount   = (clone $base)->where('source_of_money', SourceOfMoneyEnum::Country)->count();
        $recentPatients = (clone $base)->with('user')->latest()->take(5)->get();

        return view('dashboard', compact(
            'totalPatients', 'completedCount', 'pendingCount',
            'DekhilaCount', 'AgamyCount', 'charityCount', 'countryCount',
            'recentPatients'
        ));
    }
}
