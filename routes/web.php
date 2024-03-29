<?php

use Illuminate\Support\Facades\Route;
//Controladores do sistema
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Rotas de teste de layout
Route::view('/layout','layouts.app');
Route::view('/form','layouts.form');

//Rotas principal
Route::view('/','welcome');
Route::get('/dashboard', function(){
    $users = App\Models\User::all();

    return view('dashboard', [
        'users' => $users
    ]);
});

//Rotas de usuario
Route::controller(UserController::class)->group(function () {
    //Register
    Route::get('/register', 'create_register');
    Route::post('/register', 'store');

    //Login
    Route::get('/login', 'create_login');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout');

    Route::get('/users', 'index');
    Route::get('/users/{user}/show', 'show');
    // Route::put('/users/{user}', 'update');
    // Route::patch($uri, $callback);
    Route::delete('/users/{user}', 'destroy');
});

