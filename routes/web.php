<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
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

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('login/submit', 'login')->name('login.submit');

        Route::get('/forgot-password', 'showForgotPassword')->name('forgotPassword');
        Route::post('/forgot-password', 'sendResetLinkEmail')->name('forgoPassword.send');
        Route::get('/change-password/{token}', 'showChangePassword')->name('password.reset');
        Route::post('/change-password', 'resetPassword')->name('password.update');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showStep1')->name('register');
        Route::post('/register/step1', 'processStep1')->name('register.step1');

        Route::get('/register/step2/{email}', 'showStep2')->name('register.step2');
        Route::post('/register/step2', 'processStep2')->name('register.step2.process');

        Route::get('/register/step3/{email}', 'showStep3')->name('register.step3');
        Route::post('/register/step3', 'processStep3')->name('register.step3.process');
    });
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        $users = User::all()->count();
        return view('dashboard.index', array('title' => 'FinFinder | Dashboard'), compact('users'));
    })->name('dashboard');

    Route::get('profile', function () {
        return view('dashboard.profile.index', array('title' => 'FinFinder | Profile'));
    })->name('dashboard.profile');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile/settings', 'settings')->name('profile.settings');
        Route::put('profile/update', 'updateProfile')->name('update.profile');
        Route::post('/send-verification-code', 'sendVerificationCode');
        Route::post('/verify-email-change', 'verifyEmailChange');
        Route::post('/change-password', 'changePassword')->name('changePassword');
        Route::post('/delete-account', 'deleteAccount');
    });
});
