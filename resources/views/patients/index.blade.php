@extends('layouts.app')

@section('title', 'Patients List - HealthCare')

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
            <i class="bi bi-people-fill me-2 text-primary"></i>Patients Registry
        </h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('patients.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Add New Patient
        </a>
    </div>
</div>

<!-- @if (session('success'))
<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif -->

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light border-bottom text-muted">
                    <tr>
                        <th class="ps-4 py-3">Patient Name</th>
                        <th class="py-3">National ID</th>
                        <th class="py-3">Mobile No.</th>
                        <th class="py-3">Governorate</th>
                        <th class="py-3">Registered By</th>
                        <th class="text-end pe-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-dark d-block">{{ $patient->name }}</span>
                            <small class="text-muted">ID: #{{ $patient->id }}</small>
                        </td>

                        <td><code>{{ $patient->national_id }}</code></td>

                        <td>
                            @if($patient->mobile)
                            <i class="bi bi-telephone text-muted me-1"></i>{{ $patient->mobile }}
                            @else
                            <span class="text-muted fs-7"><em>None</em></span>
                            @endif
                        </td>

                        <td>
                            <span class="badge bg-light text-dark border px-2 py-1">
                                <i class="bi bi-geo-alt-fill text-danger me-1"></i>
                                {{ \App\Models\Patient::egyptianGovernorates()[$patient->governorate] ?? $patient->governorate ?? 'N/A' }}
                            </span>
                        </td>

                        <td>
                            <span class="text-secondary fs-7">
                                <i class="bi bi-person-badge me-1"></i>{{ $patient->user->name ?? 'System' }}
                            </span>
                        </td>

                        <td class="text-end pe-4">
                            <a href="{{ route('visits.create', ['patient_id' => $patient->id]) }}" class="btn btn-sm btn-success me-1 shadow-sm">
                                <i class="bi bi-file-earmark-medical-fill me-1"></i> Add Visit
                            </a>

                            <div class="btn-group" role="group">
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-outline-secondary" title="View Profile">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-primary" title="Edit Patient Details">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <button type="button" class="btn btn-sm btn-outline-danger" title="Remove Patient"
                                    onclick="if(confirm('Are you absolutely sure you want to delete this patient? This will wipe out their record history.')) { document.getElementById('delete-form-{{ $patient->id }}').submit(); }">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <form id="delete-form-{{ $patient->id }}" action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1 text-secondary d-block mb-2"></i>
                            <span class="fw-semibold">No patients recorded yet.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection