@extends('layouts.app')

@section('title', 'Dashboard - HealthCare')

@section('content')

{{-- Welcome Banner --}}
<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h2 class="fw-bold text-secondary mb-0">
            <i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard
        </h2>
        <small class="text-muted">Welcome back, <strong>{{ Auth::user()?->name }}</strong></small>
    </div>
    <span class="text-muted small"><i class="bi bi-calendar3 me-1"></i>{{ now()->format('D, d M Y') }}</span>
</div>

{{-- Stats Cards --}}
<div class="row g-4 mb-4">

    {{-- Patients --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-people-fill fs-1 text-primary"></i>
                </div>
                <div>
                    <div class="fs-1 fw-bold text-dark">{{ $totalPatients }}</div>
                    <div class="text-muted">Total Patients</div>
                    <a href="{{ route('patients.index') }}" class="text-primary small">
                        Manage <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Visits --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-file-earmark-medical-fill fs-1 text-success"></i>
                </div>
                <div>
                    <div class="fs-1 fw-bold text-dark">{{ $totalVisits }}</div>
                    <div class="text-muted">Total Visits</div>
                    <a href="{{ route('visits.index') }}" class="text-success small">
                        Manage <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Users --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-4 p-4">
                <div class="bg-warning bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-person-badge-fill fs-1 text-warning"></i>
                </div>
                <div>
                    <div class="fs-1 fw-bold text-dark">{{ $totalUsers }}</div>
                    <div class="text-muted">Total Users</div>
                    <a href="{{ route('users.index') }}" class="text-warning small">
                        Manage <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Recent Visits --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex align-items-center justify-content-between">
        <h5 class="mb-0 fw-semibold"><i class="bi bi-clock-history me-2 text-primary"></i>Recent Visits</h5>
        <a href="{{ route('visits.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-muted">
                    <tr>
                        <th class="ps-4 py-3">Patient</th>
                        <th class="py-3">Problem</th>
                        <th class="py-3">Visit Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentVisits as $visit)
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('patients.show', $visit->patient_id) }}" class="fw-semibold text-dark text-decoration-none">
                                {{ $visit->patient->name ?? '—' }}
                            </a>
                        </td>
                        <td class="text-muted">{{ Str::limit($visit->problem, 60) }}</td>
                        <td><span class="badge bg-light text-dark border">{{ \Carbon\Carbon::parse($visit->visit_date)->format('d M Y') }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">No visits recorded yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection