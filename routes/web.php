<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\MomentController;

Route::view('/', 'pages.home')->name('home');
Route::view('/menu', 'pages.menu')->name('menu');
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');

// Admin Routes (protected)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    
    // Products CRUD
    Route::resource('products', ProductController::class)->names([
        'index' => 'products.index',
        'create' => 'products.create',
        'store' => 'products.store',
        'edit' => 'products.edit',
        'update' => 'products.update',
        'destroy' => 'products.destroy',
    ]);

    // Moments Gallery CRUD
    Route::resource('moments', MomentController::class);

    // Site Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('home-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'homeHero'])->name('home.hero');
        Route::put('home-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateHomeHero']);
        Route::get('home-gallery', [\App\Http\Controllers\Admin\SiteSettingController::class, 'homeGallery'])->name('home.gallery');
        Route::put('home-gallery', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateHomeGallery']);
        
        Route::get('about-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'aboutHero'])->name('about.hero');
        Route::put('about-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateAboutHero']);
        
        Route::get('menu-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'menuHero'])->name('menu.hero');
        Route::put('menu-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateMenuHero']);
        
        Route::get('contact-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'contactHero'])->name('contact.hero');
        Route::put('contact-hero', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateContactHero']);
        Route::get('contact-info', [\App\Http\Controllers\Admin\SiteSettingController::class, 'contactInfo'])->name('contact.info');
        Route::put('contact-info', [\App\Http\Controllers\Admin\SiteSettingController::class, 'updateContactInfo']);
    });
});





Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
