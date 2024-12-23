<?php
use App\Http\Middleware\IsAdmin;
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
Route::get('/', function () {
    $schedulings = App\Models\Scheduling::whereDate('scheduled_at', now())->get();
    $users =  App\Models\User::all();
    return view('welcome', compact('schedulings', 'users'));
})->middleware(['guest']);

// Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified']);
Route::get('/dashboard', function () {
    if (Auth::user()->type != 'doctor') {
        # code...
        $schedulings = App\Models\Scheduling::whereDate('scheduled_at', now())->get();
    }else{
        $schedulings = App\Models\Scheduling::whereDate('scheduled_at', now())->where('doctor_id', Auth::user()->profile->id)->get();
    }
    return view('dashboard', compact('schedulings'));
})->middleware(['auth', 'verified']);

Route::post('/receptionist/create', [PatientController::class, 'store']);

Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('', [AdminController::class, 'index'])->middleware([IsAdmin::class]);
    Route::get('/create/{type}', [AdminController::class, 'create']);
    Route::post('/create', [AdminController::class, 'store']);
    Route::get('/show/{user}', [AdminController::class, 'show']);
    Route::get('/edit/{user}', [AdminController::class, 'edit']);
    Route::put('/update/{user}', [AdminController::class, 'update']);
});

Route::prefix('/scheduling')->middleware('auth')->group(function () {
    Route::get('', [SchedulingController::class, 'index']);
    Route::get('/create', [SchedulingController::class, 'create']);
    Route::post('/create', [SchedulingController::class, 'store']);
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
