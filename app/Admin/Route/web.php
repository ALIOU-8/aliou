<?php

use App\Admin\Controllers\Contribuables\ContribuableController;
use App\Admin\Controllers\Dashboard\DashboardController;
use App\Auth\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('Admin::Dashboard.dashboard');
    });

    //Les routes pour le dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');


    //Les routes pour les contribuales
    Route::prefix('contribuables')->group(function () {
        Route::get('/', [ContribuableController::class, 'index'])->name('contribuables.liste');
        Route::get('/ajout', [ContribuableController::class, 'ajout'])->name('contribuables.ajout');
        Route::get('/modif', [ContribuableController::class, 'modif'])->name('contribuables.modif');
    });