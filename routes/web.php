<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Protected routes exclusively for Admins
Route::middleware(['auth', 'admin']) // Applying both authentication and admin middleware
    ->prefix('admin') // URL prefix for admin routes
    ->name('admin.') // Route name prefix for admin routes
    ->group(function () { // Grouping admin routes together
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// Protected routes for authenticated users (both Admins and regular users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes for authenticated users by breeze default
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
