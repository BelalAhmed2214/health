<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = Patient::egyptianGovernorates();
        return view('patients.create', compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $patient = Patient::create([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'mobile' => $request->mobile,
            'date_of_birth' => $request->date_of_birth,
            'marital_status' => $request->marital_status,
            'children_count' => $request->children_count,
            'governorate' => $request->governorate,
            'address' => $request->address,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('patients.index')->with(['success' => 'Patient Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        $patient->load('user', 'visits');
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        $governorates = Patient::egyptianGovernorates();
        return view('patients.edit', compact('patient', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update([
            'name' => $request->name,
            'national_id' => $request->national_id,
            'mobile' => $request->mobile,
            'date_of_birth' => $request->date_of_birth,
            'marital_status' => $request->marital_status,
            'children_count' => $request->children_count,
            'governorate' => $request->governorate,
            'address' => $request->address,
        ]);
        return redirect()->route('patients.index')->with(['success' => 'Patient Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with(['success' => 'Patient Deleted Successfully']);
    }
}
