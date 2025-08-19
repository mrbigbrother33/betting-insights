<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminInsightController;
use App\Http\Controllers\ClickController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('insights', InsightController::class);
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('insights', AdminInsightController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::get('users', [UserController::class, 'index'])->name('users.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/mine-favoritter', [LikeController::class, 'index'])
    ->middleware('auth')
    ->name('favorites');

Route::post('/insights/{insight}/like', [LikeController::class, 'toggle'])
    ->middleware('auth')
    ->name('insights.like');

Route::delete('/admin/insights/{insight}/remove-image', [AdminInsightController::class, 'removeImage'])
    ->name('admin.insights.removeImage')
    ->middleware(['auth', 'admin']);

Route::post('/clicks', [ClickController::class, 'store'])
    ->name('clicks.store')
    ->middleware('throttle:120,1'); // rate-limit pr. IP