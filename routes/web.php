<?php

use App\Http\Controllers\ProfileController;
//Admin
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TagController;

//Public
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
|Protected Routes (auth:admin)
|--------------------------------------------------------------------------
*/
// Protected routes exclusively for Admins
Route::middleware(['auth', 'admin']) // Applying both authentication and admin middleware
    ->prefix('admin') // URL prefix for admin routes
    ->name('admin.') // Route name prefix for admin routes
    ->group(function () { // Grouping admin routes together

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('blogs', BlogController::class);

    Route::resource('categories', CategoryController::class);

    Route::resource('services', ServiceController::class);

    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings.edit');

    Route::put('settings', [SiteSettingController::class, 'update'])->name('settings.update');

    Route::resource('projects', ProjectController::class);

    Route::resource('contact-messages', ContactMessageController::class)
        ->only(['index', 'show', 'update', 'destroy']);

    Route::resource('team-members', TeamMemberController::class);

    Route::resource('testimonials', TestimonialController::class);

    Route::resource('tags', TagController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});






/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])
    ->name('home');


Route::get('/about', [AboutController::class, 'about'])
    ->name('about');

Route::get('/contact', [ContactController::class, 'index'])
    ->name('contact');

Route::post('/contact', [ContactController::class, 'store'])
    ->name('contact.store');



/*

|--------------------------------------------------------------------------
| Standard Breeze Customer Routes
|--------------------------------------------------------------------------

*/
// Protected routes for authenticated users (both Admins and regular users)
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Profile management routes for authenticated users by breeze default
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
