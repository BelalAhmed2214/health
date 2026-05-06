@extends('layouts.app')

@section('title', 'Log Consultation Visit - HealthCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <a href="{{ route('visits.index') }}" class="btn btn-link text-decoration-none mb-3 p-0">
            <i class="bi bi-arrow-left"></i> Discard and Return to Visits Directory
        </a>

        <div class="card shadow border-0 mb-5">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-file-earmark-medical-fill me-2"></i>New Clinical Consultation Entry
                </h5>
            </div>
            
            <div class="card-body p-4 bg-white">
                <form action="{{ route('visits.store') }}" method="POST">
                    @csrf

                    <div class="mb-4 bg-light p-3 rounded border">
                        <label for="patient_id" class="form-label fw-bold text-secondary">
                            <i class="bi bi-person-fill me-1"></i>Select Patient Profile <span class="text-danger">*</span>
                        </label>
                        <select name="patient_id" 
                                id="patient_id" 
                                class="form-select @error('patient_id') is-invalid @enderror" 
                                required>
                            
                            <option value="">-- Search / Choose a Patient Record --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" 
                                    {{ (old('patient_id') == $patient->id || request('patient_id') == $patient->id) ? 'selected' : '' }}>
                                    {{ $patient->name }} (Mobile Number: {{ $patient->mobile }})
                                </option>
                            @endforeach
                            
                        </select>
                        @error('patient_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-4">
                        
                        <div class="col-12">
                            <label for="problem" class="form-label fw-semibold text-danger">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>Presented Symptoms / Problem <span class="text-danger">*</span>
                            </label>
                            <textarea name="problem" 
                                      id="problem" 
                                      rows="4" 
                                      class="form-control @error('problem') is-invalid @enderror" 
                                      placeholder="Describe the clinical symptoms, complaints, or physical checks presented by the patient..." 
                                      required>{{ old('problem') }}</textarea>
                            @error('problem')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="solution" class="form-label fw-semibold text-success">
                                <i class="bi bi-prescription me-1"></i>Diagnosis & Treatment Solution <span class="text-danger">*</span>
                            </label>
                            <textarea name="solution" 
                                      id="solution" 
                                      rows="4" 
                                      class="form-control @error('solution') is-invalid @enderror" 
                                      placeholder="Enter medical prescriptions, recommended laboratory workups, or medical care solutions..." 
                                      required>{{ old('solution') }}</textarea>
                            @error('solution')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-7">
                            <label for="notes" class="form-label fw-semibold text-secondary">
                                <i class="bi bi-sticky-fill me-1"></i>Internal Clinic Notes / Follow-up Instructions
                            </label>
                            <textarea name="notes" 
                                      id="notes" 
                                      rows="3" 
                                      class="form-control @error('notes') is-invalid @enderror" 
                                      placeholder="Optional internal workflow comments or structural reminders...">{{ old('notes') }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="visit_date" class="form-label fw-semibold">
                                <i class="bi bi-calendar-check-fill text-primary me-1"></i>Consultation Timestamp
                            </label>
                            <input type="datetime-local" 
                                   name="visit_date" 
                                   id="visit_date" 
                                   class="form-control @error('visit_date') is-invalid @enderror" 
                                   value="{{ old('visit_date', date('Y-m-d\TH:i')) }}">
                            <small class="text-muted d-block mt-1 fs-7">Defaults automatically to the current date and time.</small>
                            @error('visit_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-light border px-4">Clear All</button>
                        <button type="submit" class="btn btn-success px-5 shadow-sm">
                            <i class="bi bi-journal-plus me-1"></i> Save Consultation File
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection