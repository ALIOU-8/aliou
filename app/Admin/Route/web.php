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
use App\Admin\Controllers\Paiement\PaiementController;
use App\Admin\Controllers\Invitation\InvitationController;
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
    Route::prefix('dashboard')->group(function () {
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
        Route::get('/cfu',[DashboardController::class, 'cfu'])->name('dashboard.cfu');
        Route::get('/tpu',[DashboardController::class, 'tpu'])->name('dashboard.tpu');
        Route::get('/patente',[DashboardController::class, 'patente'])->name('dashboard.patente');
    });

    //Les routes pour le profil
    Route::get('/profil',[ProfilController::class, 'index'])->name('profil');
    Route::put('/profil/{uuid}',[ProfilController::class, 'modif'])->name('profil.modif');
    Route::put('/mdpUpdate/{uuid}',[ProfilController::class, 'mdp_update'])->name('profil.modif.mdp');


    //Les routes pour les contribuales
    Route::prefix('contribuables')->group(function () {
        Route::get('/', [ContribuableController::class, 'index'])->name('contribuables.liste');
        Route::get('/ajout', [ContribuableController::class, 'ajout'])->name('contribuables.ajout');
        Route::get('/modif/{uuid}', [ContribuableController::class, 'modif'])->name('contribuables.modif');
        Route::post('/store', [ContribuableController::class, 'store'])->name('contribuables.store');
        Route::put('/update/{uuid}', [ContribuableController::class, 'update'])->name('contribuables.update');
        Route::get('/supprime/{uuid}', [ContribuableController::class, 'delete'])->name('contribuables.supprime');
        Route::get('/restaurer', [ContribuableController::class, 'restaurer'])->name('contribuables.restaurer');
        Route::put('/restaurer/{uuid}', [ContribuableController::class, 'restaure'])->name('contribuables.resto');
        Route::get('/recherche', [ContribuableController::class, 'recherche'])->name('contribuables.recherche');
        Route::get('/recherche-corbeille', [ContribuableController::class, 'recherche_corbeille'])->name('contribuables.recherche.corbeille');
        Route::get('/voir/{uuid}',[ContribuableController::class,'voir'])->name('contribuables.voir');
        Route::get('/imprimer',[ContribuableController::class,'imprimer'])->name('contribuable.imprimer');
    });

    //Les routes pour les personnels
    Route::prefix('personnels')->group(function () {
        Route::get('/', [PersonnelsController::class, 'index'])->name('personnels.liste');
        Route::get('/ajout', [PersonnelsController::class, 'ajout'])->name('personnels.ajout');
        Route::get('/modif/{uuid}', [PersonnelsController::class, 'modif'])->name('personnels.modif');
        Route::get('/voir', [PersonnelsController::class, 'voir'])->name('personnels.voir');
        Route::get('/imprimer', [PersonnelsController::class, 'imprimer'])->name('personnels.imprimer');
        Route::get('/corbeille', [PersonnelsController::class, 'corbeille'])->name('personnels.corbeille');
        Route::post('/store',[PersonnelsController::class,'store'])->name('personnels.store');
        Route::put('/update/{uuid}',[PersonnelsController::class,'update'])->name('personnels.update');
        Route::put('/supprime/{uuid}', [PersonnelsController::class,'delete'])->name('personnel.supprimer');
        Route::put('/restaurer/{uuid}', [PersonnelsController::class, 'restaure'])->name('personnel.restor');
        Route::get('/recherche', [PersonnelsController::class, 'recherche'])->name('personnel.recherche');
        Route::get('/recherche-corbeille', [PersonnelsController::class, 'recherche_corbeille'])->name('personnel.recherche.corbeille');
    });

    //Les routes pour les biens
    Route::prefix('biens')->group(function () {
        Route::get('/', [BiensController::class, 'index'])->name('biens.liste');
        Route::get('/ajout', [BiensController::class, 'ajout'])->name('biens.ajout');
        Route::get('/modif/{uuid}', [BiensController::class, 'modif'])->name('biens.modif');
        Route::get('/voir/{uuid}', [BiensController::class, 'voir'])->name('biens.voir');
        Route::get('/corbeille', [BiensController::class, 'corbeille'])->name('biens.corbeille');
        Route::post('/store', [BiensController::class, 'store'])->name('biens.store');
        Route::put('/update/{uuid}', [BiensController::class, 'update'])->name('biens.update');
        Route::get('/supprime/{uuid}', [BiensController::class,'delete'])->name('biens.supprimer');
        Route::put('/restaurer/{uuid}', [BiensController::class, 'restaure'])->name('biens.restor');
        Route::get('/recherche', [BiensController::class, 'recherche'])->name('bien.recherche');
        Route::get('/recherche-corbeille', [BiensController::class, 'recherche_corbeille'])->name('bien.recherche.corbeille');
        ///
        Route::get('/get-contribuable', [BiensController::class, 'getContribuable'])->name('get.contribuable');
        Route::get('/imprimer',[BiensController::class,'imprimer'])->name('bien.imprimer');
    });

    //Les routes pour la gestion CFU
    Route::prefix('cfu')->group(function () {
        Route::get('/', [CFUController::class, 'index'])->name('cfu.liste');
        Route::get('/ajout/{uuid}', [CFUController::class, 'ajout'])->name('cfu.ajout');
        Route::post('/store', [CFUController::class, 'store'])->name('cfu.store');
        Route::get('/modif/{uuid}', [CFUController::class, 'modif'])->name('cfu.modif');
        Route::put('/update/{uuid}',[CFUController::class,'update'])->name('cfu.update');
        Route::get('/contribuable-get', [CFUController::class, 'getContribuable'])->name('cfu.contribuable.details');
        Route::get('/voir/{uuid}', [CFUController::class, 'voir'])->name('cfu.voir');
        Route::get('/corbeille', [CFUController::class, 'corbeille'])->name('cfu.corbeille');
        Route::post('/recense',[CFUController::class,'recense'])->name('cfu.recense');
        Route::get('/recherche', [CFUController::class, 'recherche'])->name('cfu.recherche');
        // Route::get('/statistique', [CFUController::class, 'statistique'])->name('cfu.statistique');

    });

    //Les routes pour la gestion CFU/Occupant
    Route::prefix('cfu')->group(function () {
        Route::get('/occupant/{uuid}', [OccupantController::class, 'index'])->name('cfu.occupant.liste');
        Route::get('/occupant/ajout/{uuid}', [OccupantController::class, 'ajout'])->name('cfu.occupant.ajout');
        Route::get('/occupant/store/{uuid}', [OccupantController::class, 'store'])->name('cfu.occupant.store');
        Route::get('/occupant/delete/{uuid}', [OccupantController::class, 'delete'])->name('cfu.occupant.delete');
        Route::get('/occupant/modif/{uuid}', [OccupantController::class, 'modif'])->name('cfu.occupant.modif');
        Route::get('/occupant/update/{uuid}', [OccupantController::class, 'update'])->name('cfu.occupant.update');
        Route::get('/occupant/corbeille/{uuid}', [OccupantController::class, 'corbeille'])->name('cfu.occupant.corbeille');
        Route::put('/occupant/restaure{uuid}', [OccupantController::class, 'restaure'])->name('cfu.occupant.restaure');
    });

    //Les routes pour la gestion TPU
    Route::prefix('tpu')->group(function () {
        Route::get('/', [TPUController::class, 'index'])->name('tpu.liste');
        Route::get('/ajout/{uuid}', [TPUController::class, 'ajout'])->name('tpu.ajout');
        Route::get('/affiche/{uuid}', [TPUController::class, 'affiche'])->name('tpu.affiche');
        Route::get('/modif/{uuid}', [TPUController::class, 'modif'])->name('tpu.modif');
        Route::get('/voir/{uuid}', [TPUController::class, 'voir'])->name('tpu.voir');
        Route::post('/store', [TPUController::class, 'store'])->name('tpu.store');
        Route::get('/corbeille', [TPUController::class, 'corbeille'])->name('tpu.corbeille');
        Route::get('/verifier-numero-bien',[TPUController::class,'verifier'])->name('verifie.numero');
        Route::post('/recense',[TPUController::class,'recense'])->name('tpu.recense');
        Route::put('/update/{uuid}',[TPUcontroller::class,'update'])->name('tpu.update');
        Route::get('/contribuable-get', [TPUController::class, 'getContribuable'])->name('get.contribuable.details');
        Route::get('/recherche', [TPUController::class, 'recherche'])->name('tpu.recherche');


    });

    //Les routes pour la gestion Patente
    Route::prefix('patente')->group(function () {
        Route::get('/', [PatenteController::class, 'index'])->name('patente.liste');
        Route::get('/ajout/{uuid}', [PatenteController::class, 'ajout'])->name('patente.ajout');
        Route::get('/modif/{uuid}', [PatenteController::class, 'modif'])->name('patente.modif');
        Route::get('/voir/{uuid}', [PatenteController::class, 'voir'])->name('patente.voir');
        Route::put('/update/{uuid}',[PatenteController::class,'update'])->name('patente.update');
        Route::get('/corbeille', [PatenteController::class, 'corbeille'])->name('patente.corbeille');
        Route::post('/store', [PatenteController::class, 'store'])->name('patente.store');
        Route::get('/contribuable-get', [PatenteController::class, 'getContribuable'])->name('patente.contribuable.details');
        Route::get('/recherche', [PatenteController::class, 'recherche'])->name('patente.recherche');
        Route::post('/recense',[PatenteController::class,'recense'])->name('patente.recense');
        Route::get('/corbeille', [PatenteController::class, 'corbeille'])->name('patente.corbeille');
    });

    //Les routes pour la gestion Licence
    Route::prefix('licence')->group(function () {
        Route::get('/', [LicenceController::class, 'index'])->name('licence.liste');
        Route::get('/ajout/{uuid}', [LicenceController::class, 'ajout'])->name('licence.ajout');
        Route::get('/modif/{uuid}', [LicenceController::class, 'modif'])->name('licence.modif');
        Route::get('/voir/{uuid}', [LicenceController::class, 'voir'])->name('licence.voir');
        Route::put('/update/{uuid}',[LicenceController::class,'update'])->name('licence.update');
        Route::get('/corbeille', [LicenceController::class, 'corbeille'])->name('licence.corbeille');
        Route::post('/store', [LicenceController::class, 'store'])->name('licence.store');
        Route::get('/contribuable-get', [LicenceController::class, 'getContribuable'])->name('contribuable.details');
        Route::get('/recherche', [LicenceController::class, 'recherche'])->name('licence.recherche');
        Route::post('/recense',[LicenceController::class,'recense'])->name('licence.recense');
    });

    //Les routes pour la gestion impot
    Route::prefix('impot')->group(function () {
        Route::get('/', [ImpotsController::class, 'index'])->name('impot.liste');
        Route::get('/ajout', [ImpotsController::class, 'ajout'])->name('impot.ajout');
        Route::get('/modif/{uuid}', [ImpotsController::class, 'modif'])->name('impot.modif');
        Route::put('/update{uuid}', [ImpotsController::class, 'update'])->name('impot.update');
        Route::get('/voir/{type}/{uuid}', [ImpotsController::class, 'voir'])->name('impot.voir');
        Route::get('/payer/{uuid}', [ImpotsController::class, 'payer'])->name('impot.payer');
        Route::post('/payement/{uuid}', [ImpotsController::class, 'payement'])->name('impot.payement');
        Route::get('/recu/{uuid}', [ImpotsController::class, 'recu'])->name('impot.recu');
        Route::put('/modif_payement/{uuid}', [ImpotsController::class, 'modif_payement'])->name('impot.modif.payement');
        Route::get('/imposition/{type}/{uuid}', [ImpotsController::class, 'imposition'])->name('impot.imposition');
        Route::post('/imposer/{type}/{uuid}', [ImpotsController::class, 'imposer'])->name('impot.imposer');
        Route::get('/recherche', [ImpotsController::class, 'recherche'])->name('impots.recherche');
        Route::post('/recherche',[ImpotsController::class,'chercherBien'])->name('rechercher_bien');
        Route::get('/imprimer/{type}/{uuid}', [ImpotsController::class, 'imprimer'])->name('impot.imprimer');
    });


    //Les routes pour la gestion paiement
    Route::prefix('paiement')->group(function () {
        Route::get('/', [PaiementController::class, 'index'])->name('paiement.liste');
        Route::post('/recherche-numero',[PaiementController::class,'chercheNumero'])->name('impots.numero');
        Route::get('/recherche', [PaiementController::class, 'recherche'])->name('paiement.recherche');
    });

    //Les routes pour paramètre
    Route::prefix('parametre')->group(function () {
        Route::get('/', [ParametreController::class, 'index'])->name('parametre.index');
        
        // Utilisateur
        Route::get('/utilisateur', [AuthController::class, 'user'])->name('parametre.user');
        Route::get('/ajout_utilisateur', [AuthController::class, 'add_user'])->name('parametre.user.add');
        Route::post('/ajout_utilisateur', [AuthController::class, 'inscription'])->name('parametre.user.inscription');
        Route::get('/modification_utilisateur/{uuid}', [AuthController::class, 'modif_user'])->name('parametre.user.modif');
        Route::put('/modification_utilisateur/{uuid}', [AuthController::class, 'modification'])->name('parametre.user.modification');
        Route::get('/bloquer_utilisateur/{uuid}', [AuthController::class, 'bloquer'])->name('parametre.user.bloquer');
        Route::get('/corbeille_utilisateur', [AuthController::class, 'corbeille_user'])->name('parametre.user.corbeille');
        Route::get('/recherche-utilistateur', [AuthController::class, 'recherche'])->name('recherche.user');

        // Configuration 
        Route::get('/configuration', [ParametreController::class, 'configuration'])->name('parametre.configuration');
        
        
        // Type de bien
        Route::get('/configuration/type_biens', [ParametreController::class, 'type_bien'])->name('parametre.configuration.type.biens');
        Route::get('/configuration/type_biens/corbeille', [ParametreController::class, 'corbeille_bien'])->name('parametre.configuration.type.biens.corbeille');
        Route::post('/configuration/type_biens/store',[ParametreController::class,'type_bien_store'])->name('parametre.configuration.type.bien.store');
        Route::put('/configuration/type_biens/update/{uuid}',[ParametreController::class,'type_bien_update'])->name('parametre.configuration.type.bien.update');
        Route::get('/configuration/type_biens/edit/{uuid}',[ParametreController::class,'type_bien_edit'])->name('parametre.configuration.type.bien.edit');
        Route::put('/supprime-type-bien/{uuid}', [ParametreController::class,'delete_type_bien'])->name('type_bien.supprimer');
        Route::put('/restaurer-type-bien/{uuid}', [ParametreController::class, 'restaure_type_bien'])->name('type_bien.resto');
        Route::get('/recherche-type-bien', [ParametreController::class, 'recherche_type_bien'])->name('type_bien.recherche');
        Route::get('/recherche-type-bien-corbeille', [ParametreController::class, 'recherche_type_bien_corbeille'])->name('type_bien.recherche.corbeille');
        // Invitation
        Route::get('/configuration/invitation', [InvitationController::class, 'invitation'])->name('parametre.configuration.invitation');
        Route::get('/configuration/invitation/ajout', [InvitationController::class, 'ajout'])->name('parametre.configuration.invitation.ajout');
        Route::post('/configuration/invitation/ajout', [InvitationController::class, 'store'])->name('parametre.configuration.invitation.store');
        Route::get('/configuration/invitation/modif/{uuid}', [InvitationController::class, 'modif'])->name('parametre.configuration.invitation.modif');
        Route::put('/configuration/invitation/modif/{uuid}', [InvitationController::class, 'update'])->name('parametre.configuration.invitation.update');
        Route::get('/configuration/invitation/imprimer/{uuid}', [InvitationController::class, 'imprimer_invitation'])->name('parametre.configuration.imprimer');
        Route::get('/recherche', [InvitationController::class, 'recherche'])->name('invitation.recherche');
        
        
        // Fonction 
        Route::get('/configuration/fonction', [ParametreController::class, 'fonction'])->name('parametre.configuration.fonction');
        Route::get('/configuration/fonction/corbeille', [ParametreController::class, 'corbeille_fonction'])->name('parametre.configuration.fonction.corbeille');
        Route::post('/configuration/fonction/store',[ParametreController::class,'fonction_store'])->name('parametre.configuration.fonction.store');
        Route::put('/configuration/fonction/update/{uuid}',[ParametreController::class,'fonction_update'])->name('parametre.configuration.fonction.update');
        Route::get('/configuration/fonction/edit/{uuid}',[ParametreController::class,'fonction_edit'])->name('parametre.configuration.fonction.edit');
        Route::put('/supprime/{uuid}', [ParametreController::class, 'delete'])->name('fonction.supprime');
        Route::get('/restaurer', [ParametreController::class, 'restaurer'])->name('fonction.restaurer');
        Route::put('/restaurer/{uuid}', [ParametreController::class, 'restaure'])->name('fonction.resto');
        Route::get('/recherche-fonction', [ParametreController::class, 'recherche'])->name('fonction.recherche');
        Route::get('/recherche-fonction-corbeille', [ParametreController::class, 'recherche_corbeille'])->name('fonction.recherche.corbeille');
        // Annee 
        Route::get('/configuration/annee', [ParametreController::class, 'annee'])->name('parametre.configuration.annee');
        Route::post('/configuration/annee/store',[ParametreController::class,'annee_store'])->name('parametre.configuration.annee.store');
        Route::put('/configuration/annee/update/{uuid}',[ParametreController::class,'annee_update'])->name('parametre.configuration.annee.update');
        Route::get('/configuration/annee/edit/{uuid}',[ParametreController::class,'annee_edit'])->name('parametre.configuration.annee.edit');
        Route::post('/annees//activer/{uuid}', [ParametreController::class, 'activer'])->name('annees.activer');
        Route::get('/recherche-annee', [ParametreController::class, 'recherche_annee'])->name('annee.recherche');
    });