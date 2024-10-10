<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index', array('title' => 'FinFinder | Home'));
})->name('beranda');

Route::get('/profil', function () {
    return view('profil', array('title' => 'FinFinder | Profil'));
})->name('profil');

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('login/submit', 'login')->name('login.submit');

    Route::get('/register', 'showRegisterForm')->name('register');
    Route::post('/register/submit', 'register')->name('register.submit');

    Route::get('/forgot-password', 'showForgotPassword')->name('forgotPassword');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('forgoPassword.send');
    Route::get('/change-password/{token}', 'showChangePassword')->name('password.reset');
    Route::post('/change-password', 'resetPassword')->name('password.update');

    Route::post('/logout', 'logout')->name('logout');
});

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('login/submit', [AuthController::class, 'login'])->name('login.submit');
// Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
// Route::post('/register/submit', [AuthController::class, 'register'])->name('register.submit');
// Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgotPassword');
// Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('changePassword');

Route::get('/dashboard', function () {
    return view('dashboard.index', array('title' => 'Dashboard | Home'));
})->name('dashboard')->middleware('auth');
