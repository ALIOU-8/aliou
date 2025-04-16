<?php

namespace App\Admin\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Contribuable;
use App\Models\Impot;
use App\Models\Personnel;
use App\Models\Recensement_cfu;
use App\Models\Recensement_licence;
use App\Models\Recensement_patente;
use App\Models\Recensement_tpu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        //Nombre de personnels
        $personnel = Personnel::where('delete', 0)->count();

        //Nombre de contribuables
        $contribuable = Contribuable::where('delete', 0)->count();

        //Nombre de biens
        $bien = Bien::where('delete', 0)->count();

        //Nombre d'utilisateurs
        $user = User::count(); 

        //Nombre de biens recencer pour une année active
        $annee = Annee::where('active', 1)->first();
        if ($annee) {
            $cfuIds = Recensement_cfu::where('annee_id', $annee->id)->pluck('bien_id');
            $tpuIds = Recensement_tpu::where('annee_id', $annee->id)->pluck('bien_id');
            $patenteIds = Recensement_patente::where('annee_id', $annee->id)->pluck('bien_id');
            $licenceIds = Recensement_licence::where('annee_id', $annee->id)->pluck('bien_id');

            // Fusionner tous les IDs et retirer les doublons
            $allBienIds = $cfuIds->merge($tpuIds)->merge($patenteIds)->merge($licenceIds)->unique();
            $bienrecencer = $allBienIds->count();
        } else {
            $bienrecencer = 0;
        }

        //Nombre de biens imposer pour cette annee
        if ($annee) {
            $cfuIIds = Impot::where('annee_id', $annee->id)->where('type_impot', 'cfu')->pluck('recensement_cfu_id');
            $tpuIIds = Impot::where('annee_id', $annee->id)->where('type_impot', 'tpu')->pluck('recensement_tpu_id');
            $patenteIIds = Impot::where('annee_id', $annee->id)->where('type_impot', 'patente')->pluck('recensement_patente_id');
            $licenceIIds = Impot::where('annee_id', $annee->id)->where('type_impot', 'licence')->pluck('recensement_licence_id');

            // Fusionner tous les IDs et retirer les doublons
            $allBienIIds = $cfuIIds->merge($tpuIIds)->merge($patenteIIds)->merge($licenceIIds)->unique();
            $bienImposer = $allBienIIds->count();

            
        } else {
            $bienImposer = 0;
        }

        // Nombre d'impôts payés
        $totalImpostsPayes = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->count();

        // Nombre d'impôts non payés
        $totalImpostsNonPayes = Impot::where('statut', 'nonPayé')->where('annee_id',$annee->id)->count();

        //Les données du graph en bar
        $cfuBR = Recensement_cfu::where('annee_id',$annee->id)->count();
        $tpuBR = Recensement_tpu::where('annee_id',$annee->id)->count();
        $patenteBR = Recensement_patente::where('annee_id',$annee->id)->count();
        $licenceBR = Recensement_licence::where('annee_id',$annee->id)->count();
        $data = array($cfuBR,$tpuBR,$patenteBR,$licenceBR);

        //Les données du graph en donught
        $cfuBI = Impot::where('annee_id',$annee->id)->where('type_impot','cfu')->count();
        $tpuBI = Impot::where('annee_id',$annee->id)->where('type_impot','tpu')->count();
        $patenteBI = Impot::where('annee_id',$annee->id)->where('type_impot','patente')->count();
        $licenceBI = Impot::where('annee_id',$annee->id)->where('type_impot','licence')->count();
        $dataDonught = array($cfuBI,$tpuBI,$patenteBI,$licenceBI);
        ///Les donnés du graph evolution des paiement sur Tpu,patente,licence
        $ImpostsPayescfu = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','cfu')->count();
        $ImpostsPayesctpu = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','tpu')->count();
        $ImpostsPayespatente = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','patente')->count();
        $ImpostsPayeslicence = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','licence')->count();
        $donneePayes=array($ImpostsPayescfu,$ImpostsPayesctpu,$ImpostsPayespatente,$ImpostsPayeslicence);
        if ( Auth::user()->droit != 'admin' ) {
            return redirect('/dashboard/'.Auth::user()->droit);
        }

        return view('Admin::Dashboard.dashboard',compact('personnel','contribuable','bien','annee','user','bienrecencer','bienImposer','totalImpostsPayes','totalImpostsNonPayes','data','dataDonught','donneePayes'));
    }

    public function cfu(){
        //Nombre de biens recencer pour une année active
        $annee = Annee::where('active', 1)->first();
        if($annee) {
            $bienrecencer = Recensement_cfu::where('annee_id',$annee->id)->count();
        } else {
            $bienrecencer = 0;
        }

        //Nombre de biens imposer pour cette annee
        if($annee) {
            $bienImposer = Impot::where('annee_id',$annee->id)->where('type_impot','cfu')->count();
        } else {
            $bienImposer = 0;
        }

        // Nombre d'impôts payés
        $totalImpostsPayes = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','cfu')->count();

        // Nombre d'impôts non payés
        $totalImpostsNonPayes = Impot::where('statut', 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','cfu')->count();
        
        return view('Admin::Dashboard.cfu',compact('annee','bienrecencer','bienImposer','totalImpostsPayes','totalImpostsNonPayes'));
    }

    public function tpu(){
        //Nombre de biens recencer pour une année active
        $annee = Annee::where('active', 1)->first();
        if($annee) {
            $bienrecencer = Recensement_tpu::where('annee_id',$annee->id)->count();
        } else {
            $bienrecencer = 0;
        }

        //Nombre de biens imposer pour cette annee
        if($annee) {
            $bienImposer = Impot::where('annee_id',$annee->id)->where('type_impot','tpu')->count();
        } else {
            $bienImposer = 0;
        }

        // Nombre d'impôts payés
        $totalImpostsPayes = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','tpu')->count();

        // Nombre d'impôts non payés
        $totalImpostsNonPayes = Impot::where('statut', 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','tpu')->count();
        
        return view('Admin::Dashboard.cfu',compact('annee','bienrecencer','bienImposer','totalImpostsPayes','totalImpostsNonPayes'));
    }

    public function patente(){
        //Nombre de biens recencer pour une année active
        $annee = Annee::where('active', 1)->first();
        if($annee) {
            $bienrecencer = Recensement_patente::where('annee_id',$annee->id)->count() +
                            Recensement_licence::where('annee_id',$annee->id)->count();
        } else {
            $bienrecencer = 0;
        }

        //Nombre de biens imposer pour cette annee
        if($annee) {
            $bienImposer = Impot::where('annee_id',$annee->id)->where('type_impot','licence')->count() +
                           Impot::where('annee_id',$annee->id)->where('type_impot','patente')->count();
        } else {
            $bienImposer = 0;
        }

        // Nombre d'impôts payés
        $totalImpostsPayes = Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','licence')->count()+
                             Impot::where('statut', '!=' , 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','patente')->count();

        // Nombre d'impôts non payés
        $totalImpostsNonPayes = Impot::where('statut', 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','licence')->count()+
                                Impot::where('statut', 'nonPayé')->where('annee_id',$annee->id)->where('type_impot','patente')->count();
        
        return view('Admin::Dashboard.cfu',compact('annee','bienrecencer','bienImposer','totalImpostsPayes','totalImpostsNonPayes'));
    }
}
