@extends('layouts.app')

@section('title', 'Users List - Healthcare System')

@section('content')
<div class="row mb-3">
    <div class="col-md-6">
        <h2 class="text-secondary fw-bold">Users Management</h2>
    </div>
    <div class="col-md-6 text-end">
        <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus-fill me-1"></i> Create New User
        </a>
    </div>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-primary text-white">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                            <span class="badge bg-danger rounded-pill px-2">Admin</span>
                            @else
                            <span class="badge bg-secondary rounded-pill px-2">Staff</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">
                            <i class="bi bi-people fs-2 d-block mb-2"></i> No users found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection