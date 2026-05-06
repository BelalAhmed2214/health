@extends('layouts.app')

@section('title', 'Edit Patient - HealthCare')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        
        <a href="{{ route('patients.index') }}" class="btn btn-link text-decoration-none mb-3 p-0">
            <i class="bi bi-arrow-left"></i> Cancel and Return to Directory
        </a>

        <div class="card shadow border-0 mb-5">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Modify Patient File: {{ $patient->name }}
                </h5>
            </div>
            
            <div class="card-body p-4 bg-white">
                <form action="{{ route('patients.update', $patient->id) }}" method="POST">
                    @csrf
                    @method('PUT')

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
                                       value="{{ old('name', $patient->name) }}" 
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
                            <i class="bi bi-telephone-inbound me-2"></i>2. Demographics & Contact Info
                        </h6>
                        
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="mobile" class="form-label fw-semibold">Mobile Phone</label>
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
                                <label for="date_of_birth" class="form-label fw-semibold">Date of Birth</label>
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
                                <label for="marital_status" class="form-label fw-semibold">Marital Status</label>
                                <select name="marital_status" id="marital_status" class="form-select @error('marital_status') is-invalid @enderror">
                                    <option value="">-- Select --</option>
                                    @foreach(['single' => 'Single', 'married' => 'Married', 'divorced' => 'Divorced', 'widowed' => 'Widowed'] as $value => $label)
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
                                <label for="children_count" class="form-label fw-semibold">Number of Children</label>
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
                                <label for="governorate" class="form-label fw-semibold">Governorate / المحافظة</label>
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
                            <i class="bi bi-geo-alt me-2"></i>3. Full Residential Address
                        </h6>
                        <div class="mb-3">
                            <label for="address" class="form-label d-none">Address Details</label>
                            <textarea name="address" 
                                      id="address" 
                                      rows="3" 
                                      class="form-control @error('address') is-invalid @enderror" 
                                      placeholder="Street name, building number... proxies">{{ old('address', $patient->address) }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('patients.index') }}" class="btn btn-light border px-4">Discard Changes</a>
                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                            <i class="bi bi-save me-1"></i> Update Patient File
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection