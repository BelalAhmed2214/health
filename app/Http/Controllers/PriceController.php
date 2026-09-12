<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Enums\SectionEnum;
use App\Enums\SourceOfMoneyEnum;

class PriceController extends Controller
{
    public function index()
    {
        // Totals per section
        $sectionTotals = [];
        foreach (SectionEnum::cases() as $case) {
            $sectionTotals[$case->value] = [
                'label' => $case->label(),
                'total' => Patient::where('section', $case->value)->sum('price'),
                'count' => Patient::where('section', $case->value)->count(),
            ];
        }

        // Totals per source of money
        $sourceTotals = [];
        foreach (SourceOfMoneyEnum::cases() as $case) {
            $sourceTotals[$case->value] = [
                'label' => $case->label(),
                'total' => Patient::where('source_of_money', $case->value)->sum('price'),
                'count' => Patient::where('source_of_money', $case->value)->count(),
            ];
        }

        $grandTotal = Patient::sum('price');
        $totalPatients = Patient::count();

        return view('prices.index', compact(
            'sectionTotals',
            'sourceTotals',
            'grandTotal',
            'totalPatients'
        ));
    }
}
