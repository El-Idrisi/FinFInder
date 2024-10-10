<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('index', array('title' => 'FinFinder | Home'));
})->name('beranda');

Route::get('/profil', function () {
    return view('profil', array('title' => 'FinFinder | Profil'));
})->name('profil');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login/submit', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/submit', [AuthController::class, 'register'])->name('register.submit');

Route::get('/dashboard', function () {
    return view('dashboard.index', array('title' => 'Dashboard | Home'));
})->name('dashboard')->middleware('auth');
