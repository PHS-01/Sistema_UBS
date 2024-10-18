<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Rotas de teste de Layout
Route::view('/layouts/app', 'layouts.app');

// Rotas
Route::view('/', 'welcome')->middleware('guest');
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
