<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SchedulingController;
use App\Http\Controllers\AnamnesesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

// Rotas de teste de Layout
Route::view('/layouts/app', 'layouts.app');
Route::view('/layouts/form', 'layouts.form');

// Rotas
Route::view('/', 'welcome')->middleware('guest');
// Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified']);
Route::get('/dashboard', function () {
    $schedulings = App\Models\Scheduling::all();  
    return view('dashboard', compact('schedulings'));
})->middleware(['auth', 'verified']);

Route::post('/receptionist/create', [PatientController::class, 'store']);

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::get('/create/{type}', [AdminController::class, 'create']);
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/show/{user}', [AdminController::class, 'show']);
    Route::get('/edit/{user}', [AdminController::class, 'edit']);
    Route::put('/update/{user}', [AdminController::class, 'update']);
});

Route::prefix('/scheduling')->middleware('auth')->group(function () {
    Route::get('/', [SchedulingController::class, 'create']);
    Route::post('/', [SchedulingController::class, 'store']);
    Route::get('/show/{scheduling}', [SchedulingController::class, 'show']);
    // Route::delete('/{scheduling}', [SchedulingController::class, 'destroy']);
});

Route::prefix('/anamnese')->middleware('auth')->group(function () {
    Route::get('/create/{id}', [AnamnesesController::class, 'create']);
    Route::post('/create', [AnamnesesController::class, 'store']);
    Route::get('/show/{scheduling}', [AnamnesesController::class, 'show']);
    // Route::delete('/{scheduling}', [SchedulingController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
