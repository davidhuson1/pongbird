<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'show'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [RankingController::class, 'index'])->name('index');

// protected
Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::resource('/matches', MatchController::class);
    // Route::get('/dashboard', []);
    Route::get('/matches', [MatchController::class, 'index']);
    Route::inertia('/dashboard', 'DashboardPage');
});
