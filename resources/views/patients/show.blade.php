@extends('layouts.app')

@section('title', 'Patient Profile - HealthCare')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <a href="{{ route('patients.index') }}" class="btn btn-link text-decoration-none p-0">
            <i class="bi bi-arrow-left"></i> Back to Directory
        </a>
        <h2 class="text-secondary fw-bold mb-0 mt-2">Patient Profile</h2>
    </div>
    <div class="col-md-6 text-end mt-2 mt-md-0">
        <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn btn-success me-2">
            <i class="bi bi-file-earmark-medical-fill me-1"></i> Log New Visit
        </a>
        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil-square me-1"></i> Edit Details
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4 sticky-top" style="top: 20px; z-index: 1;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-person-bounding-box fs-1"></i>
                    </div>
                    <h4 class="fw-bold text-dark mb-1">{{ $patient->name }}</h4>
                    <span class="badge bg-light text-secondary border">Patient ID: #{{ $patient->id }}</span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="vstack gap-3 fs-7">
                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">National ID</small>
                        <span class="fw-bold text-dark"><code>{{ $patient->national_id }}</code></span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">Mobile Number</small>
                        <span class="fw-semibold text-dark">
                            @if($patient->mobile)
                            <i class="bi bi-telephone me-1 text-muted"></i>{{ $patient->mobile }}
                            @else
                            <span class="text-muted font-monospace"><em>Not Provided</em></span>
                            @endif
                        </span>
                    </div>

                    <div class="row g-0">
                        <div class="col-6">
                            <small class="text-muted d-block uppercase fw-semibold tracking-wider">Date of Birth</small>
                            <span class="fw-semibold text-dark">{{ $patient->date_of_birth ?? 'N/A' }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block uppercase fw-semibold tracking-wider">Marital Status</small>
                            <span class="fw-semibold text-dark text-capitalize">{{ $patient->marital_status ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">Dependents / Children</small>
                        <span class="fw-semibold text-dark">{{ $patient->children_count ?? '0' }} child(ren)</span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">Governorate</small>
                        <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt text-danger me-1"></i>{{ $patient->governorate ?? 'N/A' }}</span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">Home Address</small>
                        <p class="mb-0 text-secondary bg-light p-2 rounded border-start border-primary border-3" style="font-size: 0.85rem;">
                            {{ $patient->address ?? 'No physical address listed.' }}
                        </p>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <div class="bg-light p-2 rounded text-center">
                    <small class="text-muted fs-8">Registered by: <strong>{{ $patient->user->name ?? 'System' }}</strong></small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <h4 class="fw-bold text-dark mb-3">
            <i class="bi bi-clock-history me-2 text-primary"></i>Medical History Timeline
        </h4>

        @if($patient->visits->isEmpty())
        <div class="card shadow-sm border-0 text-center py-5 bg-white">
            <div class="card-body">
                <i class="bi bi-folder-plus text-muted fs-1 mb-3 d-block"></i>
                <h5 class="text-secondary fw-semibold">No visits recorded yet</h5>
                <p class="text-muted small mb-4">This patient doesn't have any consultation logs linked to this profile.</p>
                <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-primary">
                    <i class="bi bi-plus-lg"></i> Record Initial Consultation
                </a>
            </div>
        </div>
        @else
        <div class="vstack gap-3">
            @foreach($patient->visits->sortByDesc('visit_date') as $visit)
            <div class="card shadow-sm border-0 border-start border-success border-4 bg-white">
                <div class="card-header bg-white border-0 pt-3 pb-0 d-flex justify-content-between align-items-center">
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fw-bold">
                        <i class="bi bi-calendar-event me-1"></i>
                        {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('M d, Y - h:i A') : 'Date Unspecified' }}
                    </span>
                    <small class="text-muted">
                        <i class="bi bi-doctor me-1"></i>{{ $visit->user->name ?? 'Unknown' }}
                    </small>
                </div>

                <div class="card-body py-3">
                    <div class="mb-3">
                        <span class="d-block text-danger fw-bold fs-7 mb-1"><i class="bi bi-exclamation-circle me-1"></i>Presented Problem / Symptoms</span>
                        <p class="text-dark bg-light p-2 rounded mb-0 border-start border-danger border-2">{{ $visit->problem }}</p>
                    </div>

                    <div class="mb-3">
                        <span class="d-block text-success fw-bold fs-7 mb-1"><i class="bi bi-prescription me-1"></i>Diagnosis & Treatment Plan</span>
                        <p class="text-dark bg-light p-2 rounded mb-0 border-start border-success border-2">{{ $visit->solution }}</p>
                    </div>

                    @if($visit->notes)
                    <div class="mb-0">
                        <span class="d-block text-secondary fw-bold fs-7 mb-1"><i class="bi bi-sticky me-1"></i>Internal Clinic Notes</span>
                        <p class="text-muted small italic-style bg-light p-2 rounded mb-0 border-start border-secondary border-2">
                            <em>{{ $visit->notes }}</em>
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection