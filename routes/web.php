<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

// Fallback routes for compatibility
Route::get('/password/reset', function () {
    return redirect()->route('login')->with('info', 'পাসওয়ার্ড রিসেট ফিচার শীঘ্রই আসছে।');
})->name('password.request');

Route::get('/register', function () {
    return redirect()->route('login')->with('info', 'নিবন্ধন ফিচার শীঘ্রই আসছে।');
})->name('register');
