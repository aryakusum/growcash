<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\FinanceGoalController;

// Public routes
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
    Route::get('/verify-otp', [LoginController::class, 'showVerifyOtpForm'])->name('verify-otp');
    Route::post('/verify-otp', [LoginController::class, 'verifyOtp']);
    Route::post('/resend-otp', [LoginController::class, 'resendOtp'])->name('resend-otp');
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Budgeting routes
    Route::resource('budgeting', BudgetingController::class);
    
    // Transaksi routes - laporan harus sebelum resource
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::resource('transaksi', TransaksiController::class)->except(['create', 'edit']);
    
    // Finance Goals routes
    Route::resource('finance-goals', FinanceGoalController::class);
});
