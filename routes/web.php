<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FishSpotController;
use App\Http\Controllers\ListIkanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile', 'index')->name('dashboard.profile');
        Route::get('profile/settings', 'settings')->name('profile.settings');
        Route::put('profile/update', 'updateProfile')->name('update.profile');
        Route::post('/send-verification-code', 'sendVerificationCode');
        Route::post('/verify-email-change', 'verifyEmailChange');
        Route::post('/change-password', 'changePassword')->name('changePassword');
        Route::post('/delete-account', 'deleteAccount');
    });


    Route::controller(FishSpotController::class)->group(function () {
        Route::get('/data-ikan/create', 'showCreate')->name('fish.showCreate');
        Route::post('/data-ikan/submit', 'create')->name('fish.create');
        Route::get('/data-ikan', 'showAll')->name('data-ikan');
        Route::get('/data-anda', 'index')->name('data.index');

        Route::get('/data-ikan/view/{id}', 'viewData')->name('preview.data');
    });


    Route::controller(ListIkanController::class)->group(function () {
        Route::get('/fish-types/search', 'search')->name('fish-types.search');
        Route::middleware(AdminMiddleware::class)->group(function () {
            Route::get('/list-ikan', 'index')->name('list-ikan');
            Route::get('/list-ikan/delete/{id}', 'delete')->name('list-ikan.delete');
            Route::post('/list-ikan/create', 'store')->name('list-ikan.create');
            Route::put('/list-ikan/update/{id}', 'update')->name('list-ikan.update');
            Route::get('/list-ikan/{id}', 'show')->name('list-ikan.sort');
        });
    });
});
