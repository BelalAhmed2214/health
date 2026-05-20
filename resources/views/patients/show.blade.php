@extends('layouts.app')

@section('title', 'Patient Profile - HealthCare')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-6">
        <a href="{{ route('patients.index') }}" class="btn btn-link text-decoration-none p-0">
            <i class="bi bi-arrow-left"></i> {{ __('Back to Directory') }}
        </a>
        <h2 class="text-secondary fw-bold mb-0 mt-2">{{ __('Patient Profile') }}</h2>
    </div>
    <div class="col-md-6 text-end mt-2 mt-md-0">
        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil-square me-1"></i> {{ __('Edit Details') }}
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
                    <span class="badge bg-light text-secondary border">{{ __('Patient ID:') }} #{{ $patient->id }}</span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="vstack gap-3 fs-7">
                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('National ID') }}</small>
                        <span class="fw-bold text-dark"><code>{{ $patient->national_id }}</code></span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Mobile Number') }}</small>
                        <span class="fw-semibold text-dark">
                            @if($patient->mobile)
                            <i class="bi bi-telephone me-1 text-muted"></i>{{ $patient->mobile }}
                            @else
                            <span class="text-muted font-monospace"><em>{{ __('Not Provided') }}</em></span>
                            @endif
                        </span>
                    </div>

                    <div class="row g-0">
                        <div class="col-6">
                            <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Date of Birth') }}</small>
                            <span class="fw-semibold text-dark">{{ $patient->date_of_birth ?? 'N/A' }}</span>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Marital Status') }}</small>
                            <span class="fw-semibold text-dark">{{ $patient->marital_status ? __(ucfirst($patient->marital_status)) : 'N/A' }}</span>
                        </div>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Dependents / Children') }}</small>
                        <span class="fw-semibold text-dark">{{ $patient->children_count ?? '0' }} {{ __('child(ren)') }}</span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Governorate') }}</small>
                        <span class="badge bg-light text-dark border"><i class="bi bi-geo-alt text-danger me-1"></i>{{ $patient->governorate ?? 'N/A' }}</span>
                    </div>

                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Home Address') }}</small>
                        <p class="mb-0 text-secondary bg-light p-2 rounded border-start border-primary border-3" style="font-size: 0.85rem;">
                            {{ $patient->address ?? __('No physical address listed.') }}
                        </p>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <div class="bg-light p-2 rounded text-center">
                    <small class="text-muted fs-8">{{ __('Registered by:') }} <strong>{{ $patient->user->name ?? 'System' }}</strong></small>
                </div>

                @if($patient->follower || $patient->price)
                <div class="vstack gap-2 mt-2">
                    @if($patient->follower)
                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Follower') }}</small>
                        <span class="fw-semibold text-dark" dir="rtl">
                            <i class="bi bi-person-check-fill text-info me-1"></i>
                            {{ \App\Models\Patient::followers()[$patient->follower] ?? $patient->follower }}
                        </span>
                    </div>
                    @endif
                    @if($patient->price)
                    <div>
                        <small class="text-muted d-block uppercase fw-semibold tracking-wider">{{ __('Price') }}</small>
                        <span class="fw-semibold text-dark">
                            <i class="bi bi-cash-stack text-success me-1"></i>
                            {{ number_format($patient->price, 2) }} EGP
                        </span>
                    </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <h4 class="fw-bold text-dark mb-3">
            <i class="bi bi-clipboard2-pulse me-2 text-primary"></i>{{ __('Consultation Record') }}
        </h4>

        <div class="card shadow-sm border-0 bg-white">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center py-3">
                <h6 class="mb-0 fw-semibold text-dark">
                    <i class="bi bi-calendar-event me-2 text-success"></i>
                    {{ $patient->visit_date ? \Carbon\Carbon::parse($patient->visit_date)->format('M d, Y - h:i A') : __('Date Unspecified') }}
                </h6>
                <span class="badge {{ $patient->is_completed ? 'bg-success' : 'bg-secondary' }} px-3 py-2">
                    @if($patient->is_completed)
                        <i class="bi bi-check-circle-fill me-1"></i>{{ __('Completed') }}
                    @else
                        <i class="bi bi-hourglass-split me-1"></i>{{ __('Pending') }}
                    @endif
                </span>
            </div>

            <div class="card-body p-4 vstack gap-4">
                <div>
                    <h6 class="text-danger fw-bold fs-7 mb-2">
                        <i class="bi bi-exclamation-circle-fill me-1"></i>{{ __('Presented Symptoms / Problem') }}
                    </h6>
                    <div class="bg-light p-3 rounded border-start border-danger border-3 text-secondary" style="white-space: pre-line; min-height: 60px;">
                        {{ $patient->problem ?? '—' }}
                    </div>
                </div>

                <div>
                    <h6 class="text-success fw-bold fs-7 mb-2">
                        <i class="bi bi-prescription2 me-1"></i>{{ __('Diagnosis & Treatment Plan') }}
                    </h6>
                    <div class="bg-light p-3 rounded border-start border-success border-3 text-secondary" style="white-space: pre-line; min-height: 60px;">
                        {{ $patient->solution ?? '—' }}
                    </div>
                </div>

                @php $notesList = array_filter($patient->notes ?? []); @endphp
                @if(count($notesList) > 0)
                <div>
                    <h6 class="text-secondary fw-bold fs-7 mb-2">
                        <i class="bi bi-sticky me-1"></i>{{ __('Internal Clinic Notes') }}
                    </h6>
                    <div class="vstack gap-2">
                        @foreach($notesList as $note)
                        <div class="bg-light p-3 rounded border-start border-secondary border-3 text-secondary" style="white-space: pre-line;">
                            <em>{{ $note }}</em>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection