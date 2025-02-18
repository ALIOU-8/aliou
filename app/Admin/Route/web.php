<?php

use App\Admin\Controllers\Biens\BiensController;
use App\Admin\Controllers\CFU\CFUController;
use App\Admin\Controllers\CFU\OccupantController;
use App\Admin\Controllers\Contribuables\ContribuableController;
use App\Admin\Controllers\Dashboard\DashboardController;
use App\Admin\Controllers\Impots\ImpotsController;
use App\Admin\Controllers\Licence\LicenceController;
use App\Admin\Controllers\Parametre\ParametreController;
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
        Route::get('/supprime/{id}', [ContribuableController::class, 'delete'])->name('contribuables.supprime');
        Route::get('/restaurer', [ContribuableController::class, 'restaurer'])->name('contribuables.restaurer');
        Route::put('/restaurer/{id}', [ContribuableController::class, 'restaure'])->name('contribuables.resto');
        Route::get('/recherche',[ContribuableController::class,'search'])->name('contribuables.search');
        Route::get('/voir/{id}',[ContribuableController::class,'voir'])->name('contribuables.voir');
    });

    //Les routes pour les personnels
    Route::prefix('personnels')->group(function () {
        Route::get('/', [PersonnelsController::class, 'index'])->name('personnels.liste');
        Route::get('/ajout', [PersonnelsController::class, 'ajout'])->name('personnels.ajout');
        Route::get('/modif/{id}', [PersonnelsController::class, 'modif'])->name('personnels.modif');
        Route::get('/voir', [PersonnelsController::class, 'voir'])->name('personnels.voir');
        Route::get('/corbeille', [PersonnelsController::class, 'corbeille'])->name('personnels.corbeille');
        Route::post('/store',[PersonnelsController::class,'store'])->name('personnels.store');
        Route::put('/update/{id}',[PersonnelsController::class,'update'])->name('personnels.update');
        Route::put('/supprime{id}', [PersonnelsController::class,'delete'])->name('personnel.supprimer');
        Route::put('/restaurer/{id}', [PersonnelsController::class, 'restaure'])->name('personnel.restor');
    });

    //Les routes pour les biens
    Route::prefix('biens')->group(function () {
        Route::get('/', [BiensController::class, 'index'])->name('biens.liste');
        Route::get('/ajout', [BiensController::class, 'ajout'])->name('biens.ajout');
        Route::get('/modif/{id}', [BiensController::class, 'modif'])->name('biens.modif');
        Route::get('/voir/{id}', [BiensController::class, 'voir'])->name('biens.voir');
        Route::get('/corbeille', [BiensController::class, 'corbeille'])->name('biens.corbeille');
        Route::post('/store', [BiensController::class, 'store'])->name('biens.store');
        Route::put('/update/{id}', [BiensController::class, 'update'])->name('biens.update');
        Route::get('/supprime/{id}', [BiensController::class,'delete'])->name('biens.supprimer');
        Route::put('/restaurer/{id}', [BiensController::class, 'restaure'])->name('biens.restor');
        Route::get('/recherche',[BiensController::class,'search'])->name('biens.search');
        ///
        Route::get('/get-contribuable', [BiensController::class, 'getContribuable'])->name('get.contribuable');
    });

    //Les routes pour la gestion CFU
    Route::prefix('cfu')->group(function () {
        Route::get('/', [CFUController::class, 'index'])->name('cfu.liste');
        Route::get('/ajout', [CFUController::class, 'ajout'])->name('cfu.ajout');
        Route::get('/modif', [CFUController::class, 'modif'])->name('cfu.modif');
        Route::get('/voir', [CFUController::class, 'voir'])->name('cfu.voir');
        Route::get('/corbeille', [CFUController::class, 'corbeille'])->name('cfu.corbeille');
        // Route::get('/statistique', [CFUController::class, 'statistique'])->name('cfu.statistique');

    });

    //Les routes pour la gestion CFU/Occupant
    Route::prefix('cfu')->group(function () {
        Route::get('/occupant', [OccupantController::class, 'index'])->name('cfu.occupant.liste');
        Route::get('/occupant/ajout', [OccupantController::class, 'ajout'])->name('cfu.occupant.ajout');
        Route::get('/occupant/modif', [OccupantController::class, 'modif'])->name('cfu.occupant.modif');
        Route::get('/occupant/voir', [OccupantController::class, 'voir'])->name('cfu.occupant.voir');
        Route::get('/occupant/corbeille', [OccupantController::class, 'corbeille'])->name('cfu.occupant.corbeille');
    });

    //Les routes pour la gestion TPU
    Route::prefix('tpu')->group(function () {
        Route::get('/', [TPUController::class, 'index'])->name('tpu.liste');
        Route::get('/ajout/{id}', [TPUController::class, 'ajout'])->name('tpu.ajout');
        Route::get('/affiche/{id}', [TPUController::class, 'affiche'])->name('tpu.affiche');
        Route::get('/modif/{id}', [TPUController::class, 'modif'])->name('tpu.modif');
        Route::get('/voir/{id}', [TPUController::class, 'voir'])->name('tpu.voir');
        Route::post('/store', [TPUController::class, 'store'])->name('tpu.store');
        Route::get('/corbeille', [TPUController::class, 'corbeille'])->name('tpu.corbeille');
        Route::get('/verifier-numero-bien',[TPUController::class,'verifier'])->name('verifie.numero');
        Route::post('/recense',[TPUController::class,'recense'])->name('tpu.recense');
        Route::put('/update/{id}',[TPUcontroller::class,'update'])->name('tpu.update');
        Route::get('/recensements/search', [TPUController::class, 'search'])->name('recensements.search');
        Route::get('/contribuable-get', [TPUController::class, 'getContribuable'])->name('get.contribuable.details');



    });

    //Les routes pour la gestion Patente
    Route::prefix('patente')->group(function () {
        Route::get('/', [PatenteController::class, 'index'])->name('patente.liste');
        Route::get('/ajout', [PatenteController::class, 'ajout'])->name('patente.ajout');
        Route::get('/modif', [PatenteController::class, 'modif'])->name('patente.modif');
        Route::get('/voir', [PatenteController::class, 'voir'])->name('patente.voir');
        Route::get('/corbeille', [PatenteController::class, 'corbeille'])->name('patente.corbeille');
    });

    //Les routes pour la gestion Licence
    Route::prefix('licence')->group(function () {
        Route::get('/', [LicenceController::class, 'index'])->name('licence.liste');
        Route::get('/ajout/{id}', [LicenceController::class, 'ajout'])->name('licence.ajout');
        Route::get('/modif/{id}', [LicenceController::class, 'modif'])->name('licence.modif');
        Route::get('/voir/{id}', [LicenceController::class, 'voir'])->name('licence.voir');
        Route::put('/update/{id}',[LicenceController::class,'update'])->name('licence.update');
        Route::get('/corbeille', [LicenceController::class, 'corbeille'])->name('licence.corbeille');
        Route::post('/store', [LicenceController::class, 'store'])->name('licence.store');
        Route::get('/contribuable-get', [LicenceController::class, 'getContribuable'])->name('contribuable.details');
        Route::get('/recensements/search', [LicenceController::class, 'search'])->name('recensements.licence.search');
        Route::post('/recense',[LicenceController::class,'recense'])->name('licence.recense');
    });

    //Les routes pour la gestion impot
    Route::prefix('impot')->group(function () {
        Route::get('/', [ImpotsController::class, 'index'])->name('impot.liste');
        Route::get('/ajout', [ImpotsController::class, 'ajout'])->name('impot.ajout');
        Route::get('/modif{id}', [ImpotsController::class, 'modif'])->name('impot.modif');
        Route::get('/voir{id}', [ImpotsController::class, 'voir'])->name('impot.voir');
        Route::get('/payer{id}', [ImpotsController::class, 'payer'])->name('impot.payer');
        Route::get('/imposition{id}', [ImpotsController::class, 'imposition'])->name('impot.imposition');

    });

    //Les routes pour paramètre
    Route::prefix('parametre')->group(function () {
        Route::get('/', [ParametreController::class, 'index'])->name('parametre.index');
        
        // Utilisateur
        Route::get('/utilisateur', [ParametreController::class, 'user'])->name('parametre.user');
        Route::get('/ajout_utilisateur', [ParametreController::class, 'add_user'])->name('parametre.user.add');
        Route::get('/modification_utilisateur{id}', [ParametreController::class, 'modif_user'])->name('parametre.user.modif');
        Route::get('/corbeille_utilisateur', [ParametreController::class, 'corbeille_user'])->name('parametre.user.corbeille');
        
        
        // Configuration 
        Route::get('/configuration', [ParametreController::class, 'configuration'])->name('parametre.configuration');
        
        
        // Type de bien
        Route::get('/configuration/type_biens', [ParametreController::class, 'type_bien'])->name('parametre.configuration.type.biens');
        Route::get('/configuration/type_biens/corbeille', [ParametreController::class, 'corbeille_bien'])->name('parametre.configuration.type.biens.corbeille');
        Route::post('/configuration/type_biens/store',[ParametreController::class,'type_bien_store'])->name('parametre.configuration.type.bien.store');
        Route::put('/configuration/type_biens/update/{id}',[ParametreController::class,'type_bien_update'])->name('parametre.configuration.type.bien.update');
        Route::get('/configuration/type_biens/edit/{id}',[ParametreController::class,'type_bien_edit'])->name('parametre.configuration.type.bien.edit');
        Route::put('/supprime-type-bien/{id}', [ParametreController::class,'delete_type_bien'])->name('type_bien.supprimer');
        Route::put('/restaurer-type-bien/{id}', [ParametreController::class, 'restaure_type_bien'])->name('type_bien.resto');
        
        
        
        // Type impot
        Route::get('/configuration/type_impot', [ParametreController::class, 'type_impot'])->name('parametre.configuration.type.impot');
        Route::get('/configuration/type_impot/corbeille', [ParametreController::class, 'corbeille_impot'])->name('parametre.configuration.type.impot.corbeille');

        Route::post('/configuration/type_impot/store',[ParametreController::class,'type_impot_store'])->name('parametre.configuration.type.impot.store');
        Route::put('/configuration/type_impot/update/{id}',[ParametreController::class,'type_impot_update'])->name('parametre.configuration.type.impot.update');
        Route::get('/configuration/type_impot/edit/{id}',[ParametreController::class,'type_impot_edit'])->name('parametre.configuration.type.impot.edit');
        Route::put('/supprime-type-impot/{id}', [ParametreController::class,'delete_type_impot'])->name('type_impot.supprimer');
        Route::put('/restaurer-type-impot/{id}', [ParametreController::class, 'restaure_type_impot'])->name('type.impot.resto');
        
        
        // Fonction 
        Route::get('/configuration/fonction', [ParametreController::class, 'fonction'])->name('parametre.configuration.fonction');
        Route::get('/configuration/fonction/corbeille', [ParametreController::class, 'corbeille_fonction'])->name('parametre.configuration.fonction.corbeille');
        Route::post('/configuration/fonction/store',[ParametreController::class,'fonction_store'])->name('parametre.configuration.fonction.store');
        Route::put('/configuration/fonction/update/{id}',[ParametreController::class,'fonction_update'])->name('parametre.configuration.fonction.update');
        Route::get('/configuration/fonction/edit/{id}',[ParametreController::class,'fonction_edit'])->name('parametre.configuration.fonction.edit');
        Route::put('/supprime/{id}', [ParametreController::class, 'delete'])->name('fonction.supprime');
        Route::get('/restaurer', [ParametreController::class, 'restaurer'])->name('fonction.restaurer');
        Route::put('/restaurer/{id}', [ParametreController::class, 'restaure'])->name('fonction.resto');
        
        // Annee 
        Route::get('/configuration/annee', [ParametreController::class, 'annee'])->name('parametre.configuration.annee');
        Route::post('/configuration/annee/store',[ParametreController::class,'annee_store'])->name('parametre.configuration.annee.store');
        Route::put('/configuration/annee/update/{id}',[ParametreController::class,'annee_update'])->name('parametre.configuration.annee.update');
        Route::get('/configuration/annee/edit/{id}',[ParametreController::class,'annee_edit'])->name('parametre.configuration.annee.edit');
        Route::post('/annees//activer/{id}', [ParametreController::class, 'activer'])->name('annees.activer');

    });