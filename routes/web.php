<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAndaController;
use App\Http\Controllers\FishSpotController;
use App\Http\Controllers\ListIkanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifikasiController;
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

    Route::controller(RegisterController::class)->prefix('register')->name('register.')->group(function () {
        Route::get('/', 'showStep1')->name('index');
        Route::post('/step1', 'processStep1')->name('step1');

        Route::get('/step2/{email}', 'showStep2')->name('step2');
        Route::post('/step2', 'processStep2')->name('step2.process');

        Route::get('/step3/{email}', 'showStep3')->name('step3');
        Route::post('/step3', 'processStep3')->name('step3.process');
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


    Route::controller(FishSpotController::class)->prefix('data-ikan')->name('data-ikan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{spotIkan}', 'show')->name('show');
    });

    Route::controller(DataAndaController::class)->prefix('data-anda')->name('data-anda.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{spotIkan}', 'show')->name('show');
        Route::get('/create', 'showCreate')->name('showCreate');
        Route::post('/submit', 'create')->name('create');
        Route::get('/edit/{spotIkan}', 'showEdit')->name('showEdit');
        Route::put('/edit/{spotIkan}', 'update')->name('edit');
        Route::delete('/delete/{spotIkan}', 'delete')->name('delete');
    });

    Route::get('/fish-types/search', [ListIkanController::class, 'search'])->name('fish-types.search');

    Route::middleware(AdminMiddleware::class)->group(function () {

        Route::controller(ListIkanController::class)->prefix('list-ikan')->name('list-ikan.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::post('/create', 'store')->name('create');
            Route::put('/update/{id}', 'update')->name('update');
            Route::get('/{id}', 'show')->name('sort');
        });

        Route::controller(VerifikasiController::class)->prefix('verifikasi')->name('verifikasi.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{spotIkan}', 'show')->name('show');
            Route::patch('/update/{spotIkan}', 'updateStatus')->name('update-status');
        });
    });
});
