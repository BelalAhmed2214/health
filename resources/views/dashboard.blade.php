@extends('layouts.app')

@section('title', 'Dashboard - HealthCare')

@section('content')

{{-- Welcome Banner --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold text-secondary mb-0">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>{{ __('Dashboard') }}
        </h2>
        <small class="text-muted">{{ __('Welcome back,') }} <strong>{{ Auth::user()?->name }}</strong></small>
    </div>
    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('D, d M Y') }}</span>
</div>

{{-- Stats Cards --}}
<div class="row g-4 mb-4">

    {{-- Total Patients --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-people-fill fs-2 text-primary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $totalPatients }}</div>
                    <div class="text-muted small">{{ __('Total Patients') }}</div>
                    <a href="{{ route('patients.index') }}" class="text-primary small">
                        {{ __('Manage') }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Completed --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-success bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-check-circle-fill fs-2 text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $completedCount }}</div>
                    <div class="text-muted small">{{ __('Completed') }}</div>
                    <a href="{{ route('patients.index', ['is_completed' => 1]) }}" class="text-success small">
                        {{ __('View') }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Pending --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-danger bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-exclamation-circle-fill fs-2 text-danger"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-danger">{{ $pendingCount }}</div>
                    <div class="text-muted small">{{ __('Pending') }}</div>
                    <a href="{{ route('patients.index', ['is_completed' => 0]) }}" class="text-danger small">
                        {{ __('View') }} <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Total Revenue --}}
  
    {{-- Dekhila --}}
    @if(Auth::user()->isSuperAdmin() || Auth::user()->section?->value === 'dekhila')
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-info bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-building fs-2 text-info"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $DekhilaCount }}</div>
                    <div class="text-muted small">{{ __('Dekhila') }}</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Agamy --}}
    @if(Auth::user()->isSuperAdmin() || Auth::user()->section?->value === 'agamy')
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-warning bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-building fs-2 text-warning"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $AgamyCount }}</div>
                    <div class="text-muted small">العجمي</div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Charity --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-success bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-heart-fill fs-2 text-success"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $charityCount }}</div>
                    <div class="text-muted small">{{ __('Charity') }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Country --}}
    <div class="col-md-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3 flex-shrink-0">
                    <i class="bi bi-flag-fill fs-2 text-primary"></i>
                </div>
                <div>
                    <div class="fs-2 fw-bold text-dark">{{ $countryCount }}</div>
                    <div class="text-muted small">{{ __('Country') }}</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Recent Patients --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
        <h5 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i>{{ __('Recent Patients') }}</h5>
        <a href="{{ route('patients.index') }}" class="btn btn-sm btn-outline-primary">{{ __('View All') }}</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4 py-3">{{ __('Patient') }}</th>
                        <th class="py-3">{{ __('Problem') }}</th>
                        <th class="py-3">{{ __('Status') }}</th>
                        <th class="py-3">{{ __('Visit Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPatients as $patient)
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('patients.show', $patient->id) }}" class="fw-semibold text-dark text-decoration-none">
                                {{ $patient->name }}
                            </a>
                        </td>
                        <td class="text-muted">{{ Str::limit($patient->problem, 60) ?: '—' }}</td>
                        <td>
                            <span class="badge {{ $patient->is_completed ? 'bg-success' : 'bg-secondary' }}">
                                {{ $patient->is_completed ? __('Completed') : __('Pending') }}
                            </span>
                        </td>
                        <td>
                            @if($patient->visit_date)
                            <span class="badge bg-light text-dark border">{{ \Carbon\Carbon::parse($patient->visit_date)->format('d M Y') }}</span>
                            @else
                            <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">{{ __('No patients recorded yet.') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection