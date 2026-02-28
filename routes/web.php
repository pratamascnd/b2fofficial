<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

// B2F LANDING PAGE ROUTE
Route::get('/', [LandingPageController::class, 'index'])->name('landing-page.index');
Route::get('/news', [LandingPageController::class, 'news'])->name('landing-page.news');
Route::get('/news-detail/{id}', [LandingPageController::class, 'news_detail'])->name('landing-page.news-detail');
Route::get('/streamer', [LandingPageController::class, 'streamer'])->name('landing-page.streamer');
Route::get('/streamer-schedule', [LandingPageController::class, 'streamer_schedule'])->name('landing-page.streamer-schedule');

// B2F AUTH ROUTE
Route::get('/b2f-login-page', [AuthController::class, 'showLogin'])->name('login');
Route::post('/b2f-login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/b2f-logout', [AuthController::class, 'logout'])->name('auth.logout');

// B2F ADMIN ROUTE
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // --- AREA BISA DIAKSES SEMUA (Super Admin & Admin) ---
    Route::middleware(['role:Super Admin,Admin'])->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::resource("/about", App\Http\Controllers\AboutController::class);
        Route::resource("/service", App\Http\Controllers\ServiceController::class);
        Route::resource("/brand-partner", App\Http\Controllers\BrandPartnerController::class);
        Route::resource("/gallery", App\Http\Controllers\GalleryController::class);
        Route::delete('/gallery/image-destroy/{id}', [GalleryController::class, 'destroyImage'])->name('gallery.image.destroy');
        Route::resource("/news", App\Http\Controllers\NewsController::class);
        Route::resource("/streamer-profile", App\Http\Controllers\StreamerController::class);
        Route::resource("/streamer-schedule", App\Http\Controllers\StreamerScheduleController::class);
        Route::resource("/contact", App\Http\Controllers\ContactController::class);
    });

    // --- AREA KHUSUS SUPER ADMIN SAJA ---
    Route::middleware(['role:Super Admin'])->group(function() {
        Route::resource("/admin-account", App\Http\Controllers\UserController::class);
    });

});
