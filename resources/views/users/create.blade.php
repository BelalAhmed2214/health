@extends('layouts.app')

@section('title', 'Create New User - Healthcare System')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        
        <div class="mb-3">
            <a href="{{ route('users.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> {{ __('Back to Users List') }}
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-person-plus-fill me-2"></i>{{ __('Register New Staff/Admin') }}
                </h5>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">{{ __('Full Name') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" 
                                   placeholder="e.g. Dr. John Doe" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" 
                                   placeholder="name@clinic.com" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   placeholder="••••••••" 
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 pt-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_admin" name="is_admin" value="1">
                            <label class="form-check-label fw-semibold ms-2" for="is_admin">
                                {{ __('Grant Administrator Privileges') }}
                            </label>
                        </div>
                        <div class="form-text ms-4 text-muted">
                            {{ __('Admins can manage system settings, users, and delete clinic data records.') }}
                        </div>
                    </div>

                    {{-- Section (only relevant when is_admin is off) --}}
                    <div class="mb-4" id="section-field">
                        <label for="section" class="form-label fw-semibold">{{ __('Section') }}</label>
                        <select id="section" name="section" class="form-select @error('section') is-invalid @enderror">
                            <option value="">{{ __('— None (Super Admin) —') }}</option>
                            <option value="agamy"   {{ old('section') === 'agamy'   ? 'selected' : '' }}>العجمي</option>
                            <option value="dekhila" {{ old('section') === 'dekhila' ? 'selected' : '' }}>الدخيلة</option>
                        </select>
                        <div class="form-text text-muted">{{ __('Leave empty if this user is a Super Admin.') }}</div>
                        @error('section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="text-muted opacity-25">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light me-md-2">{{ __('Cancel') }}</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> {{ __('Save User') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection