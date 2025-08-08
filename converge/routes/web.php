<?php
// ROUTES FILE - Defines URL paths and which controllers handle them

// Import ProfileController for user profile management
use App\Http\Controllers\ProfileController;
// Import Route facade for defining web routes
use Illuminate\Support\Facades\Route;
// Import HomeController for main page functionality
use App\Http\Controllers\HomeController;

// HOME PAGE ROUTE - Handle GET requests to "/" (root URL)
Route::get('/', [HomeController::class, 'index']);

// DASHBOARD REDIRECT - Redirect "/dashboard" to home page "/"
Route::get('/dashboard', function () {
    // REDIRECT TO HOME - Send authenticated users to main page
    return redirect('/');
// MIDDLEWARE - Only allow authenticated and email-verified users
})->middleware(['auth', 'verified'])->name('dashboard');

// PROTECTED ROUTES GROUP - All routes require authentication
Route::middleware('auth')->group(function () {
    // PROFILE EDIT ROUTE - Show profile edit form (GET /profile)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // PROFILE UPDATE ROUTE - Process profile form submission (PATCH /profile)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // PROFILE DELETE ROUTE - Delete user account (DELETE /profile)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// AUTHENTICATION ROUTES - Include login, register, logout routes
require __DIR__.'/auth.php';
