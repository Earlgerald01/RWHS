<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');
Route::get('/waterlevel', [FirebaseController::class, 'index'])->name('waterlevel');
Route::get('/dashboard', [FirebaseController::class, 'dashboard'])->name('dashboard');
Route::get('/history', [FirebaseController::class, 'history'])->name('history');
Route::get('/api/waterlevel', [FirebaseController::class, 'getWaterLevelData']);

