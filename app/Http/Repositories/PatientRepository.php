<?php

namespace App\Http\Repositories;

use App\Models\Patient;

class PatientRepository
{
    public function getAllPatients()
    {
        $patients = Patient::orderBy('visit_date', 'desc')->paginate(10);
        return $patients;
    }
    public function query()
    {
        return Patient::query();
    }
    public function filter(array $filters)
    {
        $query = $this->query();

        $query->when(
            $filters['name'] ?? null,
            fn($q, $name) => $q->where('name', 'like', "%{$name}%")
        );

        $query->when(
            $filters['national_id'] ?? null,
            fn($q, $id) => $q->where('national_id', 'like', "%{$id}%")
        );

        $query->when(
            $filters['mobile'] ?? null,
            fn($q, $mobile) => $q->where('mobile', 'like', "%{$mobile}%")
        );

        $query->when(
            $filters['date_from'] ?? null,
            fn($q, $date) => $q->whereDate('created_at', '>=', $date)
        );

        $query->when(
            $filters['date_to'] ?? null,
            fn($q, $date) => $q->whereDate('created_at', '<=', $date)
        );

        if (isset($filters['is_completed']) && $filters['is_completed'] !== '') {
            $query->where('is_completed', (bool) $filters['is_completed']);
        }

        $query->when(
            $filters['follower'] ?? null,
            fn($q, $follower) => $q->where('follower', $follower)
        );

        $query->when(
            $filters['source_of_money'] ?? null,
            fn($q, $source) => $q->where('source_of_money', $source)
        );

        $query->when(
            $filters['section'] ?? null,
            fn($q, $section) => $q->where('section', $section)
        );

        $query->orderBy('visit_date', 'desc');

        return $query;
    }
    public function getPatient(int $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $patient->load('user');
        return $patient;
    }
    public function createPatient(array $data)
    {
        $patient = Patient::create($data);
        return $patient;
    }
    public function getEgyptianGovernorates()
    {
        return Patient::egyptianGovernorates();
    }
    public function updatePatient(int $patient_id, array $data)
    {
        $patient = Patient::findOrFail($patient_id);
        $patient->update($data);
        return $patient;
    }
    public function deletePatient(int $patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $patient->delete();
    }
}
