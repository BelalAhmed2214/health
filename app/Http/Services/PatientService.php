<?php
namespace App\Http\Services;

use App\Http\DTOs\StorePatientDTO;
use App\Http\Repositories\PatientRepository;
use Illuminate\Database\Eloquent\Model;

class PatientService
{
    public function __construct(private readonly PatientRepository $patientRepository)
    {
    }
    public function getPatientData()
    {
        $user = auth()->user();

        if ($user->isSectionUser()) {
            return $this->patientRepository->filter(['section' => $user->section->value])
                ->paginate(10)
                ->withQueryString();
        }

        return $this->patientRepository->getAllPatients();
    }

    public function filterPatients(array $filters)
    {
        $user = auth()->user();

        // Section users are always locked to their own section
        if ($user->isSectionUser()) {
            $filters['section'] = $user->section->value;
        }

        return $this->patientRepository->filter($filters)->paginate(5)->withQueryString();
    }
    public function getPatientDetails(int $patient_id)
    {
        $patient = $this->patientRepository->getPatient($patient_id);
        return $patient;
    }
    public function createPatient(StorePatientDTO $dto)
    {
        $patient = $this->patientRepository->createPatient($dto->toArray());
        return $patient;
    }
    public function getEgyptianGovernorates()
    {
        return $this->patientRepository->getEgyptianGovernorates();
    }
    public function updatePatient(int $patient_id, array $data)
    {
        $patient = $this->patientRepository->updatePatient($patient_id, $data);
        return $patient;
    }
    public function deletePatient(int $patient_id)
    {
        $this->patientRepository->deletePatient($patient_id);
    }
}