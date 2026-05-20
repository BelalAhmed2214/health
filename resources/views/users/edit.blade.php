@extends('layouts.app')

@section('title', 'Edit User - Healthcare System')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="mb-3">
            <a href="{{ route('users.index') }}" class="text-decoration-none text-muted">
                <i class="bi bi-arrow-left"></i> Back to Users List
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-person-gear me-2"></i>Edit User — {{ $user->name }}
                </h5>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">New Password <span class="text-muted fw-normal">(leave blank to keep current)</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-lock"></i></span>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="••••••••">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4 pt-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is_admin" name="is_admin" value="1"
                                {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold ms-2" for="is_admin">
                                Grant Administrator Privileges
                            </label>
                        </div>
                        <div class="form-text ms-4 text-muted">
                            Admins can manage system settings, users, and delete clinic data records.
                        </div>
                    </div>

                    {{-- Section (only relevant when is_admin is off) --}}
                    <div class="mb-4" id="section-field">
                        <label for="section" class="form-label fw-semibold">Section</label>
                        <select id="section" name="section" class="form-select @error('section') is-invalid @enderror">
                            <option value="">— None (Super Admin) —</option>
                            <option value="agamy"   {{ old('section', $user->section?->value) === 'agamy'   ? 'selected' : '' }}>العجمي</option>
                            <option value="dekhila" {{ old('section', $user->section?->value) === 'dekhila' ? 'selected' : '' }}>الدخيلة</option>
                        </select>
                        <div class="form-text text-muted">Leave empty if this user is a Super Admin.</div>
                        @error('section')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="text-muted opacity-25">

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="{{ route('users.index') }}" class="btn btn-light me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save me-1"></i> Update User
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
