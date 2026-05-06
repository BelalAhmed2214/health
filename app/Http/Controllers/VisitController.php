<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVisitRequest;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visits = Visit::all();
        return view('visits.index', compact('visits'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::all();
        $selectedPatient = request('patient_id');
        return view('visits.create', compact('patients', 'selectedPatient'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVisitRequest $request)
    {
        Visit::create([
            'patient_id' => $request->patient_id,
            'user_id' => auth()->id(),

            'visit_date' => $request->visit_date ?? now(),

            'problem' => $request->problem,
            'solution' => $request->solution,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('visits.index')
            ->with('success', 'Visit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Visit $visit)
    {
        $visit->load(['patient', 'user']);
        return view('visits.show', compact('visit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visit $visit)
    {
        $patients = Patient::all();

        return view('visits.edit', compact('visit', 'patients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visit $visit)
    {
        $visit->update([
            'patient_id' => $request->patient_id,
            'visit_date' => $request->visit_date ?? $visit->visit_date,
            'problem' => $request->problem,
            'solution' => $request->solution,
            'notes' => $request->notes,
        ]);

        return redirect()
            ->route('visits.index')
            ->with('success', 'Visit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visit $visit)
    {
        $visit->delete();
        return redirect()
            ->route('visits.index')
            ->with('success', 'Visit deleted successfully');
    }
}
