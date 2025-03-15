<?php

namespace App\Admin\Controllers\Patente;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Recensement_licence;
use App\Models\Recensement_patente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PatenteController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_patente=Recensement_patente::where('annee_id',$anneeActive->id)->orderBy('id','desc')->get();
        return view('Admin::Patente.Liste',compact('recencement_patente'));
    }

    public function ajout ($id) {
        $bien_recence=Bien::findOrFail($id);
        $annee=Annee::where('active',1)->first();
        return view('Admin::Patente.Ajout',compact('bien_recence','annee'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement=Recensement_patente::where('bien_id',$request->bien_id)->where('annee_id',$request->annee_id)->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensment  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en patente pour cette année');
                return back();
            }else{
                $recencement_patente=new Recensement_patente();
                $recencement_patente->user_id=1;
                $recencement_patente->bien_id=$request->bien_id;
                $recencement_patente->annee_id=$request->annee_id;
                $recencement_patente->Date_rdv=$request->Date_rdv;
                $recencement_patente->Date_recensement=$request->Date_recensement;
                $recencement_patente->categorie=$request->categorie;
                $recencement_patente->save();
                toastr()->success("Recensement effectué avec succes");
                return to_route("patente.liste");
            }
        }
        
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement = Recensement_patente::where('bien_id', $request->bien_id)
        ->where('annee_id', $request->annee_id)
        ->where('id', '!=', $request->id) // Ignorer l'enregistrement en cours de modification
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
                toastr()->error('ce bien est déja recenser en patente pour cette année');
                return back();
            }else{
                $recensement_patente=Recensement_patente::findOrFail($id);
                $recensement_patente->user_id=1;
                $recensement_patente->bien_id=$request->bien_id;
                $recensement_patente->annee_id=$request->annee_id;
                $recensement_patente->Date_rdv=$request->Date_rdv;
                $recensement_patente->Date_recensement=$request->Date_recensement;
                $recensement_patente->categorie=$request->categorie;
                $recensement_patente->update();
                toastr()->success("Recensement Modifier avec succes");
                return to_route("patente.liste");
            }
        }
    }

    public function modif ($id) {
        // Trouver le recensement licence par ID
        $recensement_patente =Recensement_patente::findOrFail($id);
 
        // Récupérer les IDs des biens déjà recensés
        $biensRecenses =Recensement_patente::pluck('bien_id')->toArray();
    
        // Récupérer les biens non recensés
        $bien = Bien::whereNotIn('id', $biensRecenses)
                     ->where('delete', 0)
                     ->get();
    

     return view('Admin::Patente.Modif',compact('recensement_patente','bien'));
    }    
    public function voir ($id) {
        $recensement_patente=Recensement_patente::findOrFail($id);
        return view('Admin::Patente.Voir',compact('recensement_patente'));
    }
    public function recense(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required'
        ]);

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->first();
        if($verifBienExist)
        {
            return to_route('patente.ajout',$verifBienExist->id);
        }else{
            toastr()->error("Bien. '$request->numero_bien.' est introuvable dans la base de données");
             return back();
        }
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
    public function search(Request $request)
    {
    $query = $request->get('query');

        // Récupérer l'année active
        $anneeActive = Annee::where('active', 1)->first();
        if (!$anneeActive) {
            return response()->json(['message' => 'Aucune année active trouvée'], 404);
        }

        // Recherche filtrée par l'année active
        $recensements = Recensement_patente::where('annee_id', $anneeActive->id)
            ->whereHas('bien', function ($q) use ($query) {
                $q->where('libelle', 'like', "%$query%")
                ->orWhere('adresse', 'like', "%$query%")
                ->orWhere('numero_bien', 'like', "%$query%")
                ->orWhereHas('contribuable', function ($q) use ($query) {
                    $q->where('nom', 'like', "%$query%")
                        ->orWhere('prenom', 'like', "%$query%");
                })
                ->orWhereHas('typeBien', function ($q) use ($query) {
                    $q->where('libelle', 'like', "%$query%");
                });
            })
            ->orWhereHas('annee', function ($q) use ($query, $anneeActive) {
                $q->where('annee', 'like', "%$query%")
                ->where('id', $anneeActive->id); // Filtrage par année active
            })
            ->with(['bien.contribuable', 'bien.typeBien', 'annee']) // Charge les relations nécessaires
            ->orderBy('id', 'desc')
            ->get();
            return response()->json($recensements);
    }

    public function corbeille () {
        return view('Admin::Patente.Corbeille');
    }
}
