<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\RankingController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'show'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [RankingController::class, 'index'])->name('index');


// email verification 
Route::get('/email/verify', function () {
    return Inertia::render('Auth/NoticePage', []);
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return Inertia::render('Auth/VerifiedPage', []);
})->middleware(['auth', 'signed'])->name('verification.verify');


//resend email verification
Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::group(['middleware' => ["auth:sanctum", 'verified']], function () {
    Route::resource('/matches', MatchController::class);
    // Route::get('/dashboard', []);
    Route::get('/matches', [MatchController::class, 'index']);
    Route::inertia('/dashboard', 'DashboardPage');
});
