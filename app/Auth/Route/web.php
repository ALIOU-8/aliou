<?php

use App\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

    // Les routes pour l'authentification
    Route::get('/connexion',[AuthController::class, 'login'])->name('login');
    Route::get('/login',[AuthController::class, 'login_store'])->name('login.store');

    // Route::get('/login',[AuthController::class, 'login'])->name('login');

