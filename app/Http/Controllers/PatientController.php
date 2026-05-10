<?php

namespace App\Http\Controllers;

use App\Http\DTOs\StorePatientDTO;
use App\Http\DTOs\UpdatePatientDTO;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Services\PatientService;
use App\Models\Patient;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function __construct(private readonly PatientService $patientService) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search    = $request->input('search');
        $filterBy  = $request->input('filter_by', 'name');
        $dateFrom  = $request->input('date_from');
        $dateTo    = $request->input('date_to');

        $filters = [];
        if ($search)    $filters[$filterBy] = $search;
        if ($dateFrom)  $filters['date_from'] = $dateFrom;
        if ($dateTo)    $filters['date_to']   = $dateTo;

        $patients = $filters
            ? $this->patientService->filterPatients($filters)
            : $this->patientService->getPatientData();

        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $governorates = $this->patientService->getEgyptianGovernorates();
        return view('patients.create', compact('governorates'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        $dto = StorePatientDTO::fromRequest($request);
        $this->patientService->createPatient($dto);
        return redirect()->route('patients.index')->with(['success' => 'Patient Created Successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $patient_id)
    {
        $patient = $this->patientService->getPatientDetails($patient_id);
        $patient->load('user', 'visits');
        return view('patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $patient_id)
    {
        $patient = $this->patientService->getPatientDetails($patient_id);
        $governorates = $this->patientService->getEgyptianGovernorates();
        return view('patients.edit', compact('patient', 'governorates'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, int $patient_id)
    {
        $dto = UpdatePatientDTO::fromRequest($request);
        $patient = $this->patientService->updatePatient($patient_id, $dto->toArray());
        return redirect()->route('patients.index')->with(['success' => 'Patient Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $patient_id)
    {
        $this->patientService->deletePatient($patient_id);
        return redirect()->route('patients.index')->with(['success' => 'Patient Deleted Successfully']);
    }
}
