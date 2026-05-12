@extends('layouts.app')

@section('title', 'Add Patient - HealthCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">

        <a href="{{ route('patients.index') }}" class="btn btn-link text-decoration-none mb-3 p-0">
            <i class="bi bi-arrow-left"></i> Back to Patients Directory
        </a>

        <div class="card shadow border-0 mb-5">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-person-plus-fill me-2"></i>Patient Intake Registry
                </h5>
            </div>

            <div class="card-body p-4 bg-white">
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-person-vcard me-2"></i>1. Personal Identification
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">Patient Name <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="First & Last Name"
                                    required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="national_id" class="form-label fw-semibold">National ID <span class="text-danger">*</span></label>
                                <input type="text"
                                    name="national_id"
                                    id="national_id"
                                    maxlength="14"
                                    class="form-control @error('national_id') is-invalid @enderror"
                                    value="{{ old('national_id') }}"
                                    placeholder="14-digit National ID"
                                    required>
                                @error('national_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-telephone-inbound me-2"></i>2. Demographics & Contact Info
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="mobile" class="form-label fw-semibold">Mobile Phone</label>
                                <input type="text"
                                    name="mobile"
                                    id="mobile"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    value="{{ old('mobile') }}"
                                    placeholder="e.g., +2010...">
                                @error('mobile')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label fw-semibold">Date of Birth</label>
                                <input type="date"
                                    name="date_of_birth"
                                    id="date_of_birth"
                                    class="form-control @error('date_of_birth') is-invalid @enderror"
                                    value="{{ old('date_of_birth') }}">
                                @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="marital_status" class="form-label fw-semibold">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                    <option value="" selected>-- Select --</option>
                                    <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                @error('marital_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="children_count" class="form-label fw-semibold">Number of Children</label>
                                <input type="number"
                                    name="children_count"
                                    id="children_count"
                                    min="0"
                                    class="form-control @error('children_count') is-invalid @enderror"
                                    value="{{ old('children_count', 0) }}">
                                @error('children_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <label for="governorate" class="form-label fw-semibold">Governorate</label>
                                <select name="governorate"
                                    id="governorate"
                                    class="form-select @error('governorate') is-invalid @enderror">

                                    <option value="" selected>-- Select Governorate --</option>
                                    @foreach($governorates as $englishKey => $arabicName)
                                    <option value="{{ $englishKey }}" {{ old('governorate') == $englishKey ? 'selected' : '' }}>
                                        {{ $arabicName }}
                                    </option>
                                    @endforeach

                                </select>

                                @error('governorate')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-geo-alt me-2"></i>3. Full Residential Address
                        </h6>
                        <div class="mb-3">
                            <label for="address" class="form-label d-none">Address Details</label>
                            <textarea name="address"
                                id="address"
                                rows="3"
                                class="form-control @error('address') is-invalid @enderror"
                                placeholder="Street name, building number, apartment, landmarks...">{{ old('address') }}</textarea>
                            @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-clipboard2-pulse me-2"></i>4. Consultation / Visit Data
                        </h6>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="problem" class="form-label fw-semibold text-danger">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>Presented Symptoms / Problem
                                </label>
                                <textarea name="problem" id="problem" rows="3"
                                    class="form-control @error('problem') is-invalid @enderror"
                                    placeholder="Describe the clinical symptoms or complaints...">{{ old('problem') }}</textarea>
                                @error('problem')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="solution" class="form-label fw-semibold text-success">
                                    <i class="bi bi-prescription me-1"></i>Diagnosis &amp; Treatment Plan
                                </label>
                                <textarea name="solution" id="solution" rows="3"
                                    class="form-control @error('solution') is-invalid @enderror"
                                    placeholder="Medical prescriptions, lab workups, treatment plan...">{{ old('solution') }}</textarea>
                                @error('solution')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="visit_date" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-check-fill text-primary me-1"></i>Visit Date &amp; Time
                                </label>
                                <input type="datetime-local" name="visit_date" id="visit_date"
                                    class="form-control @error('visit_date') is-invalid @enderror"
                                    value="{{ old('visit_date', date('Y-m-d\TH:i')) }}">
                                @error('visit_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="price" class="form-label fw-semibold">
                                    <i class="bi bi-currency-dollar text-success me-1"></i>Price (EGP)
                                </label>
                                <input type="number"
                                    name="price"
                                    id="price"
                                    min="0"
                                    step="0.01"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price') }}"
                                    placeholder="0.00">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="follower" class="form-label fw-semibold">
                                    <i class="bi bi-person-check-fill text-info me-1"></i>Follower / المتابع
                                </label>
                                <select name="follower" id="follower"
                                    class="form-select @error('follower') is-invalid @enderror"
                                    dir="rtl">
                                    <option value="">-- اختر المتابع --</option>
                                    @foreach(\App\Models\Patient::followers() as $key => $arabic)
                                    <option value="{{ $key }}" {{ old('follower') == $key ? 'selected' : '' }}>
                                        {{ $arabic }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('follower')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary">
                                    <i class="bi bi-sticky-fill me-1"></i>Internal Clinic Notes
                                </label>
                                @php $notesOld = old('notes', ['']); @endphp
                                <div id="notes-container" class="vstack gap-2 mb-2">
                                    @foreach($notesOld as $i => $noteVal)
                                    <div class="notes-item d-flex gap-2">
                                        <textarea name="notes[]" rows="2"
                                            class="form-control @error('notes.'.$i) is-invalid @enderror"
                                            placeholder="Add a note...">{{ $noteVal }}</textarea>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm align-self-start notes-remove"
                                            {{ count($notesOld) <= 1 ? 'style="display:none"' : '' }}>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="add-note-btn">
                                    <i class="bi bi-plus-circle me-1"></i> Add Note
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-light border px-4">Reset Fields</button>
                        <button type="submit" class="btn btn-success px-5 shadow-sm">
                            <i class="bi bi-check2-circle me-1"></i> Register Patient
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('notes-container');

    document.getElementById('add-note-btn').addEventListener('click', function () {
        const item = document.createElement('div');
        item.className = 'notes-item d-flex gap-2';
        item.innerHTML = `
            <textarea name="notes[]" rows="2" class="form-control" placeholder="Add a note..."></textarea>
            <button type="button" class="btn btn-outline-danger btn-sm align-self-start notes-remove">
                <i class="bi bi-trash"></i>
            </button>`;
        container.appendChild(item);
        syncRemoveButtons();
    });

    container.addEventListener('click', function (e) {
        const btn = e.target.closest('.notes-remove');
        if (btn) {
            btn.closest('.notes-item').remove();
            syncRemoveButtons();
        }
    });

    function syncRemoveButtons() {
        const items = container.querySelectorAll('.notes-item');
        items.forEach(function (item) {
            item.querySelector('.notes-remove').style.display = items.length > 1 ? '' : 'none';
        });
    }
});
</script>
@endpush