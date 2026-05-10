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
            <i class="bi bi-people-fill me-2 text-primary"></i>Patients Management
        </h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('patients.create') }}" class="btn btn-primary shadow-sm">
            <i class="bi bi-person-plus-fill me-1"></i> Add New Patient
        </a>
    </div>
</div>



@php
    $filterField = request('filter_by', 'name');
    $filterValue = request('search', '');
    $dateFrom    = request('date_from', '');
    $dateTo      = request('date_to', '');
    $hasFilters  = $filterValue || $dateFrom || $dateTo;
    $placeholders = ['name' => 'Search by patient name...', 'national_id' => 'Search by national ID...', 'mobile' => 'Search by mobile number...'];
@endphp

<form method="GET" action="{{ route('patients.index') }}" class="mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="form-label text-muted small mb-1">Filter By</label>
            <select name="filter_by" class="form-select form-select-sm shadow-sm" id="filterBySelect">
                <option value="name"        {{ $filterField === 'name'        ? 'selected' : '' }}>Patient Name</option>
                <option value="national_id" {{ $filterField === 'national_id' ? 'selected' : '' }}>National ID</option>
                <option value="mobile"      {{ $filterField === 'mobile'      ? 'selected' : '' }}>Mobile No.</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label text-muted small mb-1">Search</label>
            <input type="text" name="search" value="{{ $filterValue }}"
                class="form-control form-control-sm shadow-sm"
                placeholder="{{ $placeholders[$filterField] }}"
                id="searchInput">
        </div>
        <div class="col-md-2">
            <label class="form-label text-muted small mb-1">
                <i class="bi bi-calendar-event me-1"></i>Registered From
            </label>
            <input type="date" name="date_from" value="{{ $dateFrom }}"
                class="form-control form-control-sm shadow-sm">
        </div>
        <div class="col-md-2">
            <label class="form-label text-muted small mb-1">
                <i class="bi bi-calendar-event-fill me-1"></i>Registered To
            </label>
            <input type="date" name="date_to" value="{{ $dateTo }}"
                class="form-control form-control-sm shadow-sm">
        </div>
        <div class="col-md-1 d-flex gap-2">
            <button type="submit" class="btn btn-primary btn-sm w-100 shadow-sm" title="Search">
                <i class="bi bi-search"></i>
            </button>
            @if($hasFilters)
            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm" title="Clear">
                <i class="bi bi-x-lg"></i>
            </a>
            @endif
        </div>
    </div>
</form>

<script>
    const placeholders = {
        name: 'Search by patient name...',
        national_id: 'Search by national ID...',
        mobile: 'Search by mobile number...'
    };
    document.getElementById('filterBySelect').addEventListener('change', function () {
        document.getElementById('searchInput').placeholder = placeholders[this.value] || '';
    });
</script>

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
                        <th class="py-3">Registered Date</th>
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

                        <td>
                            <span class="text-muted small">
                                <i class="bi bi-calendar3 me-1"></i>{{ $patient->created_at->format('d M Y') }}
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-folder-x fs-1 text-secondary d-block mb-2"></i>
                            <span class="fw-semibold">No patients recorded yet.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $patients->links() }}
    </div>
</div>

@endsection