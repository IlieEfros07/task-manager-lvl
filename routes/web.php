<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\TaskController; 


Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('tasks.index');
    }
    return redirect()->route('login');
})->name('home');

Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister']);
Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin']);

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
    Route::middleware(['auth'])->group(function () {
      Route::resource('tasks', TaskController::class);
  });
