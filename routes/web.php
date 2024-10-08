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
