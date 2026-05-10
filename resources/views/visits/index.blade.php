@extends('layouts.app')

@section('title', 'Medical Visits Directory - HealthCare')

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
        <h2 class="text-secondary fw-bold mb-0">
            <i class="bi bi-file-earmark-medical text-primary me-2"></i>Visits Management
        </h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('visits.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle-fill me-1"></i> Log New Medical Visit
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-bottom text-muted">
                    <tr>
                        <th class="ps-4 py-3">Patient Name</th>
                        <th class="py-3" style="width: 25%;">Presented Problem</th>
                        <th class="py-3" style="width: 25%;">Treatment Plan</th>
                        <th class="py-3">Visit Date</th>
                        <th class="py-3"> Created By</th>
                        <th class="text-end pe-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visits as $visit)
                    <tr>
                        <td class="ps-4">
                            <a href="{{ route('patients.show', $visit->patient_id ?? 0) }}" class="fw-bold text-decoration-none text-dark d-block hover-primary">
                                {{ $visit->patient->name ?? 'N/A' }}
                            </a>
                            <small class="text-muted font-monospace">Patient ID: #{{ $visit->patient_id ?? '0' }}</small>
                        </td>

                        <td>
                            <div class="text-truncate text-secondary" style="max-width: 280px;" title="{{ $visit->problem }}">
                                <span class="badge bg-danger-subtle text-danger me-1">problem</span>{{ $visit->problem }}
                            </div>
                        </td>

                        <td>
                            <div class="text-truncate text-secondary" style="max-width: 280px;" title="{{ $visit->solution }}">
                                <span class="badge bg-success-subtle text-success me-1">solution</span>{{ $visit->solution }}
                            </div>
                        </td>

                        <td>
                            <span class="text-dark fw-semibold" style="font-size: 0.9rem;">
                                <i class="bi bi-calendar3 text-muted me-1"></i>
                                {{ $visit->visit_date ? \Carbon\Carbon::parse($visit->visit_date)->format('Y-m-d') : 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <span class="text-secondary small">
                                <i class="bi bi-person-badge-fill me-1 text-light-indigo"></i>{{ $visit->user->name ?? 'System' }}
                            </span>
                        </td>

                        <td class="text-end pe-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-sm btn-outline-secondary" title="View Detailed Report">
                                    <i class="bi bi-eye"></i> View
                                </a>

                                <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Medical Report">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-danger" title="Remove Visit Log"
                                    onclick="if(confirm('Are you sure you want to delete this specific medical consultation log? This data point will be removed completely.')) { document.getElementById('delete-visit-form-{{ $visit->id }}').submit(); }">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <form id="delete-visit-form-{{ $visit->id }}" action="{{ route('visits.destroy', $visit->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-card-checklist fs-1 text-secondary d-block mb-2"></i>
                            <span class="fw-semibold">No medical visits have been logged yet.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection