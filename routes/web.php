<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceSheetController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// Rotas de teste de Layout
Route::view('/layouts/app', 'layouts.app');
Route::view('/layouts/form', 'layouts.form');

// Rotas
Route::view('/', 'welcome')->middleware('guest');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified']);

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::get('/create/{type}', [AdminController::class, 'create']);
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/show/{user}', [AdminController::class, 'show']);
    Route::get('/edit/{user}', [AdminController::class, 'edit']);
});

Route::prefix('/sheet')->group(function () {
    Route::get('/', [ServiceSheetController::class, 'create'])->middleware('guest');
    Route::post('/', [ServiceSheetController::class, 'store'])->middleware('guest');
    Route::get('/{service_sheet}', [ServiceSheetController::class, 'show']);
    Route::delete('/{service_sheet}', [ServiceSheetController::class, 'destroy'])->middleware(['auth']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
