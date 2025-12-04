<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BudgetingController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\FinanceGoalController;

// Public routes
Route::get('/', function () {
    return view('welcome');
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
    
    // Onboarding Routes
    Route::get('/onboarding', [\App\Http\Controllers\OnboardingController::class, 'index'])->name('onboarding.index');
    Route::post('/onboarding', [\App\Http\Controllers\OnboardingController::class, 'store'])->name('onboarding.store');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Budgeting routes
    Route::resource('budgeting', BudgetingController::class);
    
    // Transaksi routes - laporan harus sebelum resource
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::resource('transaksi', TransaksiController::class)->except(['create', 'edit']);
    
    
    // Profile routes
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
    
    
    // Notification routes
    Route::post('/notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    
    // Finance Goals routes
    Route::resource('finance-goals', FinanceGoalController::class);
});
