<?php

namespace App\Admin\Controllers\TPU;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Recensement_tpu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TPUController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_tpu=Recensement_tpu::where('annee_id',$anneeActive->id)->orderBy('id','desc')->get();
        return view('Admin::TPU.Liste',compact('recencement_tpu'));
    }


    public function modif($id) {
        // Trouver le recensement TPU par ID
        $recencement_tpu = Recensement_tpu::findOrFail($id);
    
        // Récupérer les IDs des biens déjà recensés
        $biensRecenses = Recensement_tpu::pluck('bien_id')->toArray();
    
        // Récupérer les biens non recensés
        $bien = Bien::whereNotIn('id', $biensRecenses)
                     ->where('delete', 0)
                     ->get();
    
        return view('Admin::TPU.Modif', compact('recencement_tpu', 'bien'));
    }
    

    public function voir($id) {
        $recensement_tpu=Recensement_tpu::findOrFail($id);
        return view('Admin::TPU.Voir',compact('recensement_tpu'));
    }

    public function corbeille () {
        return view('Admin::TPU.Corbeille');
    }

    public function ajout($id)
    {
        $bien_recence=Bien::findOrFail($id);
        $annee=Annee::where('active',1)->first();
        return view('Admin::TPU.Ajout',compact('bien_recence','annee'));
    }
    public function verifier(Request $request)
    {
        $bien=Bien::where('numero_bien',$request->numero_bien)->where('delete',0)->exists();
        return response()->json(['exists'=>$bien]);
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
        $recensements = Recensement_tpu::where('annee_id', $anneeActive->id)
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

    


    public function recense(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required'
        ]);

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->first();
        if($verifBienExist)
        {
            return to_route('tpu.ajout',$verifBienExist->id);
        }else{
            toastr()->error("Bien. '$request->numero_bien.' est introuvable dans la base de données");
             return back();
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement=Recensement_tpu::where('bien_id',$request->bien_id)->where('annee_id',$request->annee_id)->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensment  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en TPU pour cette année');
                return back();
            }else{
                $recencement_tpu=new Recensement_tpu();
                $recencement_tpu->user_id=1;
                $recencement_tpu->bien_id=$request->bien_id;
                $recencement_tpu->annee_id=$request->annee_id;
                $recencement_tpu->Date_rdv=$request->Date_rdv;
                $recencement_tpu->Date_recensement=$request->Date_recensement;
                $recencement_tpu->categorie=$request->categorie;
                $recencement_tpu->save();
                toastr()->success("Recensement effectué avec succes");
                return to_route("tpu.liste");
            }
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

    


    public function update(Request $request,$id)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement = Recensement_tpu::where('bien_id', $request->bien_id)
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
                toastr()->error('ce bien est déja recenser en TPU pour cette année');
                return back();
            }else{
                $recencement_tpu=Recensement_tpu::findOrFail($id);
                $recencement_tpu->user_id=1;
                $recencement_tpu->bien_id=$request->bien_id;
                $recencement_tpu->annee_id=$request->annee_id;
                $recencement_tpu->Date_rdv=$request->Date_rdv;
                $recencement_tpu->Date_recensement=$request->Date_recensement;
                $recencement_tpu->categorie=$request->categorie;
                $recencement_tpu->update();
                toastr()->success("Recensement Modifier avec succes");
                return to_route("tpu.liste");
            }
        }
    }
}

