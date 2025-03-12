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
use App\Auth\Controllers\AuthController;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Contribuable;
use App\Models\Personnel;
use Illuminate\Support\Facades\Route;

    Route::get('/', function () {
        $personnel = Personnel::where('delete', 0)->count();
        $contribuable = Contribuable::where('delete', 0)->count();
        $bien = Bien::where('delete', 0)->count();
        $annees = Annee::get();
        return view('Admin::Dashboard.dashboard',compact('personnel','contribuable','bien','annees'));
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
        Route::get('/imprimer', [PersonnelsController::class, 'imprimer'])->name('personnels.imprimer');
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
        Route::get('/ajout/{id}', [CFUController::class, 'ajout'])->name('cfu.ajout');
        Route::post('/store', [CFUController::class, 'store'])->name('cfu.store');
        Route::get('/modif/{id}', [CFUController::class, 'modif'])->name('cfu.modif');
        Route::put('/update/{id}',[CFUController::class,'update'])->name('cfu.update');
        Route::get('/contribuable-get', [CFUController::class, 'getContribuable'])->name('cfu.contribuable.details');
        Route::get('/voir/{id}', [CFUController::class, 'voir'])->name('cfu.voir');
        Route::get('/corbeille', [CFUController::class, 'corbeille'])->name('cfu.corbeille');
        Route::post('/recense',[CFUController::class,'recense'])->name('cfu.recense');
        Route::get('/search', [CFUController::class, 'search'])->name('cfu.search');
        // Route::get('/statistique', [CFUController::class, 'statistique'])->name('cfu.statistique');

    });

    //Les routes pour la gestion CFU/Occupant
    Route::prefix('cfu')->group(function () {
        Route::get('/occupant/{id}', [OccupantController::class, 'index'])->name('cfu.occupant.liste');
        Route::get('/occupant/ajout/{id}', [OccupantController::class, 'ajout'])->name('cfu.occupant.ajout');
        Route::get('/occupant/store/{id}', [OccupantController::class, 'store'])->name('cfu.occupant.store');
        Route::get('/occupant/delete/{id}', [OccupantController::class, 'delete'])->name('cfu.occupant.delete');
        Route::get('/occupant/modif/{id}', [OccupantController::class, 'modif'])->name('cfu.occupant.modif');
        Route::get('/occupant/update/{id}', [OccupantController::class, 'update'])->name('cfu.occupant.update');
        Route::get('/occupant/corbeille/{id}', [OccupantController::class, 'corbeille'])->name('cfu.occupant.corbeille');
        Route::put('/occupant/restaure{id}', [OccupantController::class, 'restaure'])->name('cfu.occupant.restaure');
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
        Route::get('/ajout/{id}', [PatenteController::class, 'ajout'])->name('patente.ajout');
        Route::get('/modif/{id}', [PatenteController::class, 'modif'])->name('patente.modif');
        Route::get('/voir/{id}', [PatenteController::class, 'voir'])->name('patente.voir');
        Route::put('/update/{id}',[PatenteController::class,'update'])->name('patente.update');
        Route::get('/corbeille', [PatenteController::class, 'corbeille'])->name('patente.corbeille');
        Route::post('/store', [PatenteController::class, 'store'])->name('patente.store');
        Route::get('/contribuable-get', [PatenteController::class, 'getContribuable'])->name('patente.contribuable.details');
        Route::get('/recensements/search', [PatenteController::class, 'search'])->name('recensements.patente.search');
        Route::post('/recense',[PatenteController::class,'recense'])->name('patente.recense');
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
        Route::get('/modif/{id}', [ImpotsController::class, 'modif'])->name('impot.modif');
        Route::put('/update{id}', [ImpotsController::class, 'update'])->name('impot.update');
        Route::get('/voir/{type}/{id}', [ImpotsController::class, 'voir'])->name('impot.voir');
        Route::get('/payer/{id}', [ImpotsController::class, 'payer'])->name('impot.payer');
        Route::post('/payement/{id}', [ImpotsController::class, 'payement'])->name('impot.payement');
        Route::get('/recu/{id}', [ImpotsController::class, 'recu'])->name('impot.recu');
        Route::put('/modif_payement/{id}', [ImpotsController::class, 'modif_payement'])->name('impot.modif.payement');
        Route::get('/imposition/{type}/{id}', [ImpotsController::class, 'imposition'])->name('impot.imposition');
        Route::post('/imposer/{type}/{id}', [ImpotsController::class, 'imposer'])->name('impot.imposer');
        Route::get('/impots/search', [ImpotsController::class, 'search'])->name('impots.search');


    });

    //Les routes pour paramètre
    Route::prefix('parametre')->group(function () {
        Route::get('/', [ParametreController::class, 'index'])->name('parametre.index');
        
        // Utilisateur
        Route::get('/utilisateur', [AuthController::class, 'user'])->name('parametre.user');
        Route::get('/ajout_utilisateur', [AuthController::class, 'add_user'])->name('parametre.user.add');
        Route::post('/ajout_utilisateur', [AuthController::class, 'inscription'])->name('parametre.user.inscription');
        Route::get('/modification_utilisateur/{id}', [AuthController::class, 'modif_user'])->name('parametre.user.modif');
        Route::put('/modification_utilisateur/{id}', [AuthController::class, 'modification'])->name('parametre.user.modification');
        Route::get('/bloquer_utilisateur/{id}', [AuthController::class, 'bloquer'])->name('parametre.user.bloquer');
        Route::get('/corbeille_utilisateur', [AuthController::class, 'corbeille_user'])->name('parametre.user.corbeille');
        
        
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
        
        
        
        // Invitation
        Route::get('/configuration/invitation', [ParametreController::class, 'invitation'])->name('parametre.configuration.invitation');
        Route::get('/configuration/invitation/imprimer/{id}', [ParametreController::class, 'imprimer_invitation'])->name('parametre.configuration.imprimer');
        
        
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