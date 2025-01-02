<?php

use App\Admin\Controllers\Biens\BiensController;
use App\Admin\Controllers\CFU\CFUController;
use App\Admin\Controllers\Contribuables\ContribuableController;
use App\Admin\Controllers\Dashboard\DashboardController;
use App\Admin\Controllers\Personnels\PersonnelsController;
use App\Admin\Controllers\Profil\ProfilController;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        return view('Admin::Dashboard.dashboard');
    });

    //Les routes pour le dashboard
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

    //Les routes pour le profil
    Route::get('/profil',[ProfilController::class, 'index'])->name('profil');


    //Les routes pour les contribuales
    Route::prefix('contribuables')->group(function () {
        Route::get('/', [ContribuableController::class, 'index'])->name('contribuables.liste');
        Route::get('/ajout', [ContribuableController::class, 'ajout'])->name('contribuables.ajout');
        Route::get('/modif', [ContribuableController::class, 'modif'])->name('contribuables.modif');
    });

    //Les routes pour les personnels
    Route::prefix('personnels')->group(function () {
        Route::get('/', [PersonnelsController::class, 'index'])->name('personnels.liste');
        Route::get('/ajout', [PersonnelsController::class, 'ajout'])->name('personnels.ajout');
        Route::get('/modif', [PersonnelsController::class, 'modif'])->name('personnels.modif');
    });

    //Les routes pour les biens
    Route::prefix('biens')->group(function () {
        Route::get('/', [BiensController::class, 'index'])->name('biens.liste');
        Route::get('/ajout', [BiensController::class, 'ajout'])->name('biens.ajout');
        Route::get('/modif', [BiensController::class, 'modif'])->name('biens.modif');
        Route::get('/type', [BiensController::class, 'type'])->name('biens.type');
    });

    //Les routes pour la gestion CFU
    Route::prefix('cfu')->group(function () {
        Route::get('/', [CFUController::class, 'index'])->name('cfu.liste');
        Route::get('/ajout', [CFUController::class, 'ajout'])->name('cfu.ajout');
        Route::get('/modif', [CFUController::class, 'modif'])->name('cfu.modif');
    });