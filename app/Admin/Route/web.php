<?php

use App\Admin\Controllers\Biens\BiensController;
use App\Admin\Controllers\CFU\CFUController;
use App\Admin\Controllers\Contribuables\ContribuableController;
use App\Admin\Controllers\Dashboard\DashboardController;
use App\Admin\Controllers\Licence\LicenceController;
use App\Admin\Controllers\Patente\PatenteController;
use App\Admin\Controllers\Personnels\PersonnelsController;
use App\Admin\Controllers\Profil\ProfilController;
use App\Admin\Controllers\TPU\TPUController;
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
        Route::get('/modif/{id}', [ContribuableController::class, 'modif'])->name('contribuables.modif');
        Route::post('/store', [ContribuableController::class, 'store'])->name('contribuables.store');
        Route::put('/update/{id}', [ContribuableController::class, 'update'])->name('contribuables.update');
        Route::put('/supprime/{id}', [ContribuableController::class, 'delete'])->name('contribuables.supprime');
        Route::get('/restaurer', [ContribuableController::class, 'restaurer'])->name('contribuables.restaurer');
        Route::put('/restaurer/{id}', [ContribuableController::class, 'restaure'])->name('contribuables.resto');
    });

    //Les routes pour les personnels
    Route::prefix('personnels')->group(function () {
        Route::get('/', [PersonnelsController::class, 'index'])->name('personnels.liste');
        Route::get('/ajout', [PersonnelsController::class, 'ajout'])->name('personnels.ajout');
        Route::get('/modif', [PersonnelsController::class, 'modif'])->name('personnels.modif');
        Route::get('/voir', [PersonnelsController::class, 'voir'])->name('personnels.voir');
    });

    //Les routes pour les biens
    Route::prefix('biens')->group(function () {
        Route::get('/', [BiensController::class, 'index'])->name('biens.liste');
        Route::get('/ajout', [BiensController::class, 'ajout'])->name('biens.ajout');
        Route::get('/modif', [BiensController::class, 'modif'])->name('biens.modif');
        Route::get('/type', [BiensController::class, 'type'])->name('biens.type');
        Route::get('/voir', [BiensController::class, 'voir'])->name('biens.voir');
    });

    //Les routes pour la gestion CFU
    Route::prefix('cfu')->group(function () {
        Route::get('/', [CFUController::class, 'index'])->name('cfu.liste');
        Route::get('/ajout', [CFUController::class, 'ajout'])->name('cfu.ajout');
        Route::get('/modif', [CFUController::class, 'modif'])->name('cfu.modif');
        Route::get('/statistique', [CFUController::class, 'statistique'])->name('cfu.statistique');

    });

    //Les routes pour la gestion TPU
    Route::prefix('tpu')->group(function () {
        Route::get('/', [TPUController::class, 'index'])->name('tpu.liste');
        Route::get('/ajout', [TPUController::class, 'ajout'])->name('tpu.ajout');
        Route::get('/modif', [TPUController::class, 'modif'])->name('tpu.modif');
    });

    //Les routes pour la gestion Patente
    Route::prefix('patente')->group(function () {
        Route::get('/', [PatenteController::class, 'index'])->name('patente.liste');
        Route::get('/ajout', [PatenteController::class, 'ajout'])->name('patente.ajout');
        Route::get('/modif', [PatenteController::class, 'modif'])->name('patente.modif');
    });

    //Les routes pour la gestion Licence
    Route::prefix('licence')->group(function () {
        Route::get('/', [LicenceController::class, 'index'])->name('licence.liste');
        Route::get('/ajout', [LicenceController::class, 'ajout'])->name('licence.ajout');
        Route::get('/modif', [LicenceController::class, 'modif'])->name('licence.modif');
    });