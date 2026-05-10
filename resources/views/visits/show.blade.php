@extends('layouts.app')

@section('title', 'Consultation Details - HealthCare')

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 border-start border-success border-4 mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle-fill fs-4 me-3 text-success"></i>
            <div>
                <strong class="d-block text-success">Action Completed</strong>
                <span class="text-secondary">{{ session('success') }}</span>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <a href="{{ route('visits.index') }}" class="btn btn-link text-decoration-none p-0">
            <i class="bi bi-arrow-left"></i> Back to Consultation Directory
        </a>
        <h2 class="text-secondary fw-bold mb-0 mt-2">Consultation Summary File</h2>
    </div>
    <div class="col-md-6 text-end mt-2 mt-md-0">
        <a href="{{ route('patients.show', $visit->patient_id ?? 0) }}" class="btn btn-outline-secondary me-2">
            <i class="bi bi-person-folder2 me-1"></i> View Entire Chart
        </a>
        <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-pencil-square me-1"></i> Edit Case Details
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="card shadow-sm border-0 mb-4 bg-white">
            <div class="card-body p-4">
                <h6 class="text-uppercase tracking-wider fw-bold text-secondary mb-3 small">
                    <i class="bi bi-person-vcard-fill me-2 text-primary"></i>Patient Identity
                </h6>
                
                <h4 class="fw-bold text-dark mb-1">{{ $visit->patient->name ?? 'N/A' }}</h4>
                <div class="mb-3">
                    <span class="badge bg-light text-secondary border">ID Ref: #{{ $visit->patient_id ?? 'N/A' }}</span>
                </div>

                <div class="vstack gap-2 border-top pt-3 fs-7">
                    <div>
                        <small class="text-muted d-block">National Identification Number</small>
                        <span class="fw-bold text-secondary font-monospace">{{ $visit->patient->national_id ?? 'N/A' }}</span>
                    </div>
                    
                    <div>
                        <small class="text-muted d-block">Mobile Network Phone</small>
                        <span class="fw-semibold text-secondary">
                            @if($visit->patient && $visit->patient->mobile)
                                <i class="bi bi-telephone me-1 opacity-50"></i>{{ $visit->patient->mobile }}
                            @else
                                <em class="text-muted">Not provided</em>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 bg-light-subtle">
            <div class="card-body p-4 fs-7">
                <h6 class="text-uppercase tracking-wider fw-bold text-secondary mb-3 small">
                    <i class="bi bi-info-circle me-2 text-primary"></i>Log Parameters
                </h6>
                <div class="vstack gap-3">
                    <div>
                        <small class="text-muted d-block">Consultation Date/Time</small>
                        <span class="fw-bold text-dark">
                            <i class="bi bi-calendar3 text-primary me-1"></i>
                            {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('M d, Y - h:i A') : 'N/A' }}
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Attending Clinical Recorder</small>
                        <span class="fw-semibold text-dark">
                            <i class="bi bi-person-badge-fill text-muted me-1"></i>{{ $visit->user->name ?? 'System' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100 bg-white">
            <div class="card-header bg-dark text-white py-3 border-0">
                <h5 class="mb-0 d-flex align-items-center">
                    <i class="bi bi-clipboard2-pulse me-2 text-warning"></i>Case Consultation Report
                </h5>
            </div>
            
            <div class="card-body p-4 vstack gap-4">
                
                <div>
                    <h6 class="text-danger fw-bold fs-7 uppercase tracking-wider mb-2">
                        <i class="bi bi-exclamation-circle-fill me-1"></i>1. Presented Symptoms & Clinical Intake
                    </h6>
                    <div class="bg-light p-3 rounded border-start border-danger border-3 text-secondary" style="white-space: pre-line; min-height: 80px;">
                        {{ $visit->problem }}
                    </div>
                </div>

                <div>
                    <h6 class="text-success fw-bold fs-7 uppercase tracking-wider mb-2">
                        <i class="bi bi-prescription2 me-1"></i>2. Diagnosis & Formulated Action Plan
                    </h6>
                    <div class="bg-light p-3 rounded border-start border-success border-3 text-secondary" style="white-space: pre-line; min-height: 80px;">
                        {{ $visit->solution }}
                    </div>
                </div>

                <div>
                    <h6 class="text-secondary fw-bold fs-7 uppercase tracking-wider mb-2">
                        <i class="bi bi-sticky me-1"></i>3. Miscellaneous Internal Observations / Instructions
                    </h6>
                    @if($visit->notes)
                        <div class="bg-light p-3 rounded border-start border-secondary border-3 text-secondary font-italic" style="white-space: pre-line;">
                            <em>{{ $visit->notes }}</em>
                        </div>
                    @else
                        <p class="text-muted bg-light p-3 rounded mb-0 text-center small border border-dashed">
                            <em>No explicit administrative observations recorded for this session entry.</em>
                        </p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection