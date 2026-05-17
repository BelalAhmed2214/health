<?php

namespace App\Http\Controllers;

use App\Http\DTOs\StorePatientDTO;
use App\Http\DTOs\UpdatePatientDTO;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Http\Services\PatientService;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    public function __construct(private readonly PatientService $patientService) {}

    public function index(Request $request)
    {
        $search        = $request->input('search');
        $filterBy      = $request->input('filter_by', 'name');
        $dateFrom      = $request->input('date_from');
        $dateTo        = $request->input('date_to');
        $isCompleted   = $request->input('is_completed', '');
        $follower      = $request->input('follower');
        $section       = $request->input('section');
        $sourceOfMoney = $request->input('source_of_money');

        $filters = [];
        if ($search)           $filters[$filterBy]        = $search;
        if ($dateFrom)         $filters['date_from']       = $dateFrom;
        if ($dateTo)           $filters['date_to']         = $dateTo;
        if ($isCompleted !== '') $filters['is_completed']  = $isCompleted;
        if ($follower)         $filters['follower']        = $follower;
        if ($section)          $filters['section']         = $section;
        if ($sourceOfMoney)    $filters['source_of_money'] = $sourceOfMoney;

        $patients = $filters
            ? $this->patientService->filterPatients($filters)
            : $this->patientService->getPatientData();

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        $governorates = $this->patientService->getEgyptianGovernorates();
        return view('patients.create', compact('governorates'));
    }

    public function store(StorePatientRequest $request)
    {
        $dto = StorePatientDTO::fromRequest($request);
        $this->patientService->createPatient($dto);
        return redirect()->route('patients.index')->with(['success' => 'Patient Created Successfully']);
    }

    public function show(int $patient_id)
    {
        $patient = $this->patientService->getPatientDetails($patient_id);
        return view('patients.show', compact('patient'));
    }

    public function edit(int $patient_id)
    {
        $patient = $this->patientService->getPatientDetails($patient_id);
        $governorates = $this->patientService->getEgyptianGovernorates();
        return view('patients.edit', compact('patient', 'governorates'));
    }

    public function update(UpdatePatientRequest $request, int $patient_id)
    {
        $dto = UpdatePatientDTO::fromRequest($request);
        $this->patientService->updatePatient($patient_id, $dto->toArray());
        return redirect()->route('patients.index')->with(['success' => 'Patient Updated Successfully']);
    }

    public function destroy(int $patient_id)
    {
        $this->patientService->deletePatient($patient_id);
        return redirect()->route('patients.index')->with(['success' => 'Patient Deleted Successfully']);
    }

    public function toggleCompleted(Patient $patient)
    {
        $patient->update(['is_completed' => ! $patient->is_completed]);
        return back()->with('success', 'Patient status updated successfully.');
    }
}
