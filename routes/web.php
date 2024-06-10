<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DiskController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\RankingController;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Str;

// Auth routes
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'show'])->name('login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [RankingController::class, 'index'])->name('index');


// Email verification 
Route::get('/email/verify', function () {
    return Inertia::render('Auth/NoticePage', []);
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return Inertia::render('Auth/VerifiedPage', []);
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'sendVerificationEmail'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Password reset routes
Route::get('/forgot-password', function () {
    return Inertia::render('Auth/ForgotPasswordPage', []);
})->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? Inertia::render('Auth/LinkSentPage', [])
        : Inertia::render('Auth/ForgotPasswordPage', []);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return Inertia::render('Auth/ResetPasswordPage', ['token' => $token]);
    // view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');


Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');



// Protected routes
Route::group(['middleware' => ["auth:sanctum", 'verified']], function () {
    Route::resource('/matches', MatchController::class);
    Route::get('/matches', [MatchController::class, 'index']);
    Route::inertia('/dashboard', 'DashboardPage');
});


// Profile iamge routes
Route::post('upload-profile-image', [DiskController::class, 'uploadImageToS3']);

// Route for php debugging
Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');
