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

});





Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
