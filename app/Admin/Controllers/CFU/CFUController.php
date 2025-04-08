<?php

namespace App\Admin\Controllers\CFU;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Historique;
use App\Models\Occupant;
use App\Models\Recensement_cfu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CFUController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_cfu=Recensement_cfu::where('annee_id',$anneeActive->id)->orderBy('id','desc')->paginate(10);
        return view('Admin::CFU.Liste',compact('anneeActive','recencement_cfu'));
    }

    public function ajout ($uuid) {
        $bien_recence=Bien::where('uuid',$uuid)->firstOrFail();
        $annee=Annee::where('active',1)->firstOrFail();
        return view('Admin::CFU.Ajout',compact('bien_recence','annee'));
    }
    public function store (Request $request) {
        $request->validate([
            'nature_fondation'=>'required',
            'surface'=>'required',
            'nature_mur'=>'required',
            'nature_toit'=>'required',
            'nombre_unite'=>'required',
            'nombre_unite_occuper'=>'required',
            'date_recensement'=>'required',
            'date_rdv'=>'required',
            'statut'=>'required',
            'nbre_etage'=>'required',
            'type'=>'required',
        ]);
        $doublonRecencement=Recensement_cfu::where('bien_id',$request->bien_id)->where('annee_id',$request->annee_id)->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensment  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en CFU pour cette année');
                return back();
            }else{  

           
        $recensement_cfu= new Recensement_cfu();
        $recensement_cfu->user_id=1;
        $recensement_cfu->bien_id=$request->bien_id;
        $recensement_cfu->annee_id=$request->annee_id;
        $recensement_cfu->nature_fondation=$request->nature_fondation;
        $recensement_cfu->surface=$request->surface;
        $recensement_cfu->nature_mur=$request->nature_mur;
        $recensement_cfu->nature_toit=$request->nature_toit;
        $recensement_cfu->nombre_unite=$request->nombre_unite;
        $recensement_cfu->nombre_unite_occuper=$request->nombre_unite_occuper;
        $recensement_cfu->date_recensement=$request->date_recensement;
        $recensement_cfu->date_rdv=$request->date_rdv;
        $recensement_cfu->statut=$request->statut;
        $recensement_cfu->type=$request->type;
        $recensement_cfu->nbre_etage=$request->nbre_etage;
        $recensement_cfu->save();
        $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'CFU',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Recensement effectué avec succèss');
        return to_route('cfu.liste');
        }
    }
}


    public function modif ($uuid) {
         // Trouver le recensement cfu par ID
         $recencement_cfu = Recensement_cfu::where('uuid',$uuid)->firstOrFail();
    
         // Récupérer les IDs des biens déjà recensés
         $biensRecenses = Recensement_cfu::pluck('bien_id')->toArray();
     
         // Récupérer les biens non recensés
         $bien = Bien::whereNotIn('id', $biensRecenses)
                      ->where('delete', 0)
                      ->get();
        $type=['personne_physique','personne_morale'];            
        $statut=['prive','etat_collectivite'];            
        $n_fondation=['legere','maconnee'];            
        $n_mur=['banco','dur'];            
        $n_toit=['vegetale','tole','dalle'];            
                   
     
        return view('Admin::CFU.Modif',compact('recencement_cfu','bien','type','statut','n_fondation','n_mur','n_toit'));
    }

    public function getContribuable(Request $request)
    {
    $bien = Bien::with('contribuable')->find($request->id);

    if (!$bien || !$bien->contribuable) {
        return response()->json(['error' => 'Propriétaire non trouvé'], 404);
    }

    return response()->json([
        'success' => true,
            'contribuable' => [
                'nom' => $bien->contribuable->nom,
                'prenom' => $bien->contribuable->prenom
                ]
        ]);
    }

    public function update (Request $request, $uuid) {
        $request->validate([
            'nature_fondation'=>'required',
            'surface'=>'required',
            'nature_mur'=>'required',
            'nature_toit'=>'required',
            'nombre_unite'=>'required',
            'nombre_unite_occuper'=>'required',
            'date_recensement'=>'required',
            'date_rdv'=>'required',
            'statut'=>'required',
            'nbre_etage'=>'required',
            'type'=>'required',
        ]);
        $doublonRecencement = Recensement_cfu::where('bien_id', $request->bien_id)
        ->where('annee_id', $request->annee_id)
        ->where('uuid', '!=', $request->uuid) // Ignorer l'enregistrement en cours de modification
        ->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensment  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en CFU pour cette année');
                return back();
            }else{     
                $recensement_cfu=Recensement_cfu::where('uuid',$uuid)->firstOrFail();
                $recensement_cfu->user_id=Auth::user()->id;
                $recensement_cfu->bien_id=$request->bien_id;
                $recensement_cfu->annee_id=$request->annee_id;
                $recensement_cfu->nature_fondation=$request->nature_fondation;
                $recensement_cfu->surface=$request->surface;
                $recensement_cfu->nature_mur=$request->nature_mur;
                $recensement_cfu->nature_toit=$request->nature_toit;
                $recensement_cfu->nombre_unite=$request->nombre_unite;
                $recensement_cfu->nombre_unite_occuper=$request->nombre_unite_occuper;
                $recensement_cfu->date_recensement=$request->date_recensement;
                $recensement_cfu->date_rdv=$request->date_rdv;
                $recensement_cfu->statut=$request->statut;
                $recensement_cfu->type=$request->type;
                $recensement_cfu->nbre_etage=$request->nbre_etage;
                $recensement_cfu->update();
                $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Mofier',
                'activite'=>'CFU',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
                toastr()->success('Recensement modifié avec succèss');
                return to_route('cfu.liste');
    }
    }
        
    }
    public function recense(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required'
        ]);

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->where('delete',0)->first();
        if($verifBienExist)
        {
            return to_route('cfu.ajout',$verifBienExist->uuid);
        }else{
            toastr()->error("Bien. '$request->numero_bien.' est introuvable dans la base de données");
             return back();
        }
    }

    public function voir ($uuid) {
        $recensement_cfu=Recensement_cfu::where('uuid',$uuid)->with('occupant')->with('bien')->firstOrFail();
        $bien = Bien::where('id',$recensement_cfu->bien_id)->with('contribuable')->first();
        $ValeurLocative=Occupant::where('recensement_cfu_id',$recensement_cfu->id)->where('delete', 0)->sum('valeur_locative');
        return view('Admin::CFU.Voir',compact('recensement_cfu', 'bien','ValeurLocative'));
    }

    public function corbeille () {
        return view('Admin::CFU.Corbeille');
    }
    public function recherche(Request $request)
    {
        if ($request->has('search')) {
        $search = $request->input('search');

        // Récupérer l'année active
        $anneeActive = Annee::where('active', 1)->firstOrFail();
        $recencement_cfu = Recensement_cfu::where('annee_id', $anneeActive->id)
            ->whereHas('bien', function ($q) use ($search) {
                $q->where('libelle', 'like', "%$search%")
                ->orWhere('adresse', 'like', "%$search%")
                ->orWhere('numero_bien', 'like', "%$search%")
                ->orWhereHas('contribuable', function ($q) use ($search) {
                    $q->where('nom', 'like', "%$search%")
                        ->orWhere('prenom', 'like', "%$search%");
                })
                ->orWhereHas('typeBien', function ($q) use ($search) {
                    $q->where('libelle', 'like', "%$search%");
                });
            })
            ->orWhereHas('annee', function ($q) use ($search, $anneeActive) {
                $q->where('annee', 'like', "%$search%")
                ->where('id', $anneeActive->id); // Filtrage par année active
            })
            ->with(['bien.contribuable', 'bien.typeBien', 'annee']) // Charge les relations nécessaires
            ->orderBy('id', 'desc')
            ->paginate(10);
            return view('Admin::CFU.Liste',compact('recencement_cfu'));
        }
    }

    // public function statistique()  {
    //     return view('Admin::CFU.statistique');
    // }
}
