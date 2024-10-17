<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RegisterController;
use App\Models\User;

Route::get('/', function () {
    return view('index', array('title' => 'FinFinder | Home'));
})->name('beranda');

Route::get('/profil', function () {
    return view('profil', array('title' => 'FinFinder | Profil'));
})->name('profil');

Route::get('/contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('/contact-us', [ContactController::class, 'send'])->name('contact.send');

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('login/submit', 'login')->name('login.submit');

    Route::get('/forgot-password', 'showForgotPassword')->name('forgotPassword');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('forgoPassword.send');
    Route::get('/change-password/{token}', 'showChangePassword')->name('password.reset');
    Route::post('/change-password', 'resetPassword')->name('password.update');

    Route::post('/logout', 'logout')->name('logout');
});

Route::controller(RegisterController::class)->group(function() {
    Route::get('/register', 'showStep1')->name('register');
    Route::post('/register/step1', 'processStep1')->name('register.step1');

    Route::get('/register/step2/{email}', 'showStep2')->name('register.step2');
    Route::post('/register/step2', 'processStep2')->name('register.step2.process');

    Route::get('/register/step3/{email}', 'showStep3')->name('register.step3');
    Route::post('/register/step3', 'processStep3')->name('register.step3.process');
});

Route::get('/email', function() {
    return view('emails.contact-message');
});

Route::get('/dashboard', function () {
    $users = User::latest()->count();
    return view('dashboard.index', array('title' => 'Dashboard | Home'), compact('users'));
})->name('dashboard')->middleware('auth');
Route::get('/dashboard/create', function () {
    return view('dashboard.index', array('title' => 'Dashboard | Home'));
})->name('dashboard.create')->middleware('auth');
