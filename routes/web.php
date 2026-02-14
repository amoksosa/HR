<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthSimpleController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [AuthSimpleController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthSimpleController::class, 'register']);

Route::get('/login', [AuthSimpleController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthSimpleController::class, 'login']);

Route::post('/logout', [AuthSimpleController::class, 'logout'])->name('logout');

/**
 * ✅ Employee dashboard (self-only)
 */
Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/**
 * ✅ Admin dashboard (admin only)
 * Keep your admin middleware here.
 */
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
