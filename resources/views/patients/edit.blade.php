@extends('layouts.app')

@section('title', 'Edit Patient - HealthCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <a href="{{ route('patients.index') }}" class="btn btn-link text-decoration-none mb-3 p-0">
            <i class="bi bi-arrow-left"></i> {{ __('Cancel and Return to Directory') }}
        </a>

        <div class="card shadow border-0 mb-5">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pencil-square me-2"></i>{{ __('Modify Patient File: :name', ['name' => $patient->name]) }}
                </h5>
            </div>
            
            <div class="card-body p-4 bg-white">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-person-vcard me-2"></i>{{ __('1. Personal Identification') }}
                        </h6>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label fw-semibold">{{ __('Patient Name') }} <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="name" 
                                       id="name" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       value="{{ old('name', $patient->name) }}" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="national_id" class="form-label fw-semibold">{{ __('National ID') }} <span class="text-danger">*</span></label>
                                <input type="text" 
                                       name="national_id" 
                                       id="national_id" 
                                       maxlength="14"
                                       class="form-control @error('national_id') is-invalid @enderror" 
                                       value="{{ old('national_id', $patient->national_id) }}" 
                                       required>
                                @error('national_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-telephone-inbound me-2"></i>{{ __('2. Demographics & Contact Info') }}
                        </h6>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="mobile" class="form-label fw-semibold">{{ __('Mobile Phone') }}</label>
                                <input type="text" 
                                       name="mobile" 
                                       id="mobile" 
                                       class="form-control @error('mobile') is-invalid @enderror" 
                                       value="{{ old('mobile', $patient->mobile) }}">
                                @error('mobile')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="date_of_birth" class="form-label fw-semibold">{{ __('Date of Birth') }}</label>
                                <input type="date" 
                                       name="date_of_birth" 
                                       id="date_of_birth" 
                                       class="form-control @error('date_of_birth') is-invalid @enderror" 
                                       value="{{ old('date_of_birth', $patient->date_of_birth) }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="marital_status" class="form-label fw-semibold">{{ __('Marital Status') }}</label>
                                <select name="marital_status" id="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                    <option value="">{{ __('-- Select --') }}</option>
                                    @foreach(['single' => __('Single'), 'married' => __('Married'), 'divorced' => __('Divorced'), 'widowed' => __('Widowed')] as $value => $label)
                                        <option value="{{ $value }}" {{ old('marital_status', $patient->marital_status) == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('marital_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="children_count" class="form-label fw-semibold">{{ __('Number of Children') }}</label>
                                <input type="number" 
                                       name="children_count" 
                                       id="children_count" 
                                       min="0"
                                       class="form-control @error('children_count') is-invalid @enderror" 
                                       value="{{ old('children_count', $patient->children_count) }}">
                                @error('children_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <label for="governorate" class="form-label fw-semibold">{{ __('Governorate') }}</label>
                                <select name="governorate" 
                                        id="governorate" 
                                        class="form-select @error('governorate') is-invalid @enderror" 
                                        dir="rtl">
                                    
                                    <option value="" dir="ltr">-- اختر المحافظة --</option>
                                    @foreach($governorates as $englishKey => $arabicName)
                                        <option value="{{ $englishKey }}" {{ old('governorate', $patient->governorate) == $englishKey ? 'selected' : '' }}>
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
                            <i class="bi bi-geo-alt me-2"></i>{{ __('3. Full Residential Address') }}
                        </h6>
                        <div class="mb-3">
                            <label for="address" class="form-label d-none">Address Details</label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="3" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      placeholder="{{ __('Street name, building number, apartment, landmarks...') }}">{{ old('address', $patient->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="text-primary border-bottom pb-2 fw-bold">
                            <i class="bi bi-clipboard2-pulse me-2"></i>{{ __('4. Consultation / Visit Data') }}
                        </h6>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="problem" class="form-label fw-semibold text-danger">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>{{ __('Presented Symptoms / Problem') }}
                                </label>
                                <textarea name="problem" id="problem" rows="3"
                                    class="form-control @error('problem') is-invalid @enderror"
                                    placeholder="{{ __('Describe the clinical symptoms or complaints...') }}">{{ old('problem', $patient->problem) }}</textarea>
                                @error('problem')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="solution" class="form-label fw-semibold text-success">
                                    <i class="bi bi-prescription me-1"></i>{{ __('Diagnosis & Treatment Plan') }}
                                </label>
                                <textarea name="solution" id="solution" rows="3"
                                    class="form-control @error('solution') is-invalid @enderror"
                                    placeholder="{{ __('Medical prescriptions, lab workups, treatment plan...') }}">{{ old('solution', $patient->solution) }}</textarea>
                                @error('solution')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-5">
                                <label for="visit_date" class="form-label fw-semibold">
                                    <i class="bi bi-calendar-check-fill text-primary me-1"></i>{{ __('Visit Date & Time') }}
                                </label>
                                <input type="datetime-local" name="visit_date" id="visit_date"
                                    class="form-control @error('visit_date') is-invalid @enderror"
                                    value="{{ old('visit_date', $patient->visit_date ? \Carbon\Carbon::parse($patient->visit_date)->format('Y-m-d\TH:i') : '') }}">
                                @error('visit_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="price" class="form-label fw-semibold">
                                    <i class="bi bi-currency-dollar text-success me-1"></i>{{ __('Price (EGP)') }}
                                </label>
                                <input type="number"
                                    name="price"
                                    id="price"
                                    min="0"
                                    step="0.01"
                                    class="form-control @error('price') is-invalid @enderror"
                                    value="{{ old('price', $patient->price) }}"
                                    placeholder="0.00">
                                @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="follower" class="form-label fw-semibold">
                                    <i class="bi bi-person-check-fill text-info me-1"></i>{{ __('Follower') }}
                                </label>
                                <select name="follower" id="follower"
                                    class="form-select @error('follower') is-invalid @enderror"
                                    dir="rtl">
                                    <option value="">-- اختر المتابع --</option>
                                    @foreach(\App\Models\Patient::followers() as $key => $arabic)
                                    <option value="{{ $key }}" {{ old('follower', $patient->follower) == $key ? 'selected' : '' }}>
                                        {{ $arabic }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('follower')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="section" class="form-label fw-semibold">
                                    <i class="bi bi-building me-1"></i>{{ __('Section') }}
                                </label>
                                @if(auth()->user()->isSectionUser())
                                    {{-- Section users cannot change the section --}}
                                    <input type="hidden" name="section" value="{{ auth()->user()->section->value }}">
                                    <input type="text" class="form-control bg-light" value="{{ auth()->user()->section->label() }}" dir="rtl" disabled>
                                @else
                                    <select name="section" id="section"
                                        class="form-select @error('section') is-invalid @enderror"
                                        dir="rtl">
                                        <option value="">-- اختر المنطقة --</option>
                                        @foreach(\App\Enums\SectionEnum::cases() as $case)
                                        <option value="{{ $case->value }}" {{ old('section', $patient->section?->value) == $case->value ? 'selected' : '' }}>
                                            {{ $case->label() }}
                                        </option>
                                        @endforeach
                                    </select>
                                @endif
                                @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="source_of_money" class="form-label fw-semibold">
                                    <i class="bi bi-cash-coin me-1"></i>{{ __('Source of Money') }}
                                </label>
                                <select name="source_of_money" id="source_of_money"
                                    class="form-select @error('source_of_money') is-invalid @enderror"
                                    dir="rtl">
                                    <option value="">-- اختر المصدر --</option>
                                    @foreach(\App\Enums\SourceOfMoneyEnum::cases() as $case)
                                    <option value="{{ $case->value }}" {{ old('source_of_money', $patient->source_of_money?->value) == $case->value ? 'selected' : '' }}>
                                        {{ $case->label() }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('source_of_money')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-semibold text-secondary">
                                    <i class="bi bi-sticky-fill me-1"></i>{{ __('Internal Clinic Notes') }}
                                </label>
                                @php $notesOld = old('notes', $patient->notes ?? ['']); if (empty($notesOld)) $notesOld = ['']; @endphp
                                <div id="notes-container" class="vstack gap-2 mb-2">
                                    @foreach($notesOld as $i => $noteVal)
                                    <div class="notes-item d-flex gap-2">
                                        <textarea name="notes[]" rows="2"
                                            class="form-control @error('notes.'.$i) is-invalid @enderror"
                                            placeholder="{{ __('Add a note...') }}">{{ $noteVal }}</textarea>
                                        <button type="button"
                                            class="btn btn-outline-danger btn-sm align-self-start notes-remove"
                                            {{ count($notesOld) <= 1 ? 'style="display:none"' : '' }}>
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="add-note-btn">
                                    <i class="bi bi-plus-circle me-1"></i> {{ __('Add Note') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('patients.index') }}" class="btn btn-light border px-4">{{ __('Discard Changes') }}</a>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                            <i class="bi bi-save me-1"></i> {{ __('Update Patient File') }}
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
    const notePlaceholder = '{{ __('Add a note...') }}';

    document.getElementById('add-note-btn').addEventListener('click', function () {
        const item = document.createElement('div');
        item.className = 'notes-item d-flex gap-2';
        item.innerHTML = `
            <textarea name="notes[]" rows="2" class="form-control" placeholder="${notePlaceholder}"></textarea>
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