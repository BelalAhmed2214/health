<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Super admin only: user management
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('users', UserController::class);
});

// Super admin + section users: patient management
Route::middleware(['auth', 'can_access_patients'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::patch('/patients/{patient}/toggle-completed', [PatientController::class, 'toggleCompleted'])
        ->name('patients.toggle-completed');
});


require __DIR__ . '/auth.php';
