<?php

use App\Auth\Controllers\AuthController;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

    // Les routes pour l'authentification
    Route::get('/login',[AuthController::class, 'login'])->name('login')->middleware('guest');
    Route::get('/login_store',[AuthController::class, 'login_store'])->name('login.store')->middleware('guest');
    Route::get('/logout',[AuthController::class, 'logout'])->name('logout')->middleware('auth');

    // Les routes pour mot de passe oublié
    Route::group(['middleware' => ['guest']], function() {
    Route::get('/forget',[AuthController::class,'forget'])->name('auth.forget');
    Route::post('/forget',[AuthController::class,'verification'])->name('auth.verification');

    Route::get('/otp',[AuthController::class,'otp'])->name('auth.otp');
    Route::post('/otp',[AuthController::class,'confirm_otp'])->name('auth.otp.verification');

    Route::get('/mdp',[AuthController::class,'mdp'])->name('auth.mdp');
    Route::post('/mdp',[AuthController::class,'mdp_update'])->name('auth.mdp-update');
    });
    // La route pour envoyer un mail


