<?php

namespace App\Admin\Controllers\Licence;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Recensement_licence;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_licence=Recensement_licence::where('annee_id',$anneeActive->id)->orderBy('id','desc')->get();
        return view('Admin::Licence.Liste',compact('recencement_licence'));
    }

    public function ajout ($id) {
        $bien_recence=Bien::findOrFail($id);
        $annee=Annee::where('active',1)->first();
        return view('Admin::Licence.Ajout',compact('bien_recence','annee'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement=Recensement_licence::where('bien_id',$request->bien_id)->where('annee_id',$request->annee_id)->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensment  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en Licence pour cette année');
                return back();
            }else{
                $recensement_licence=new Recensement_licence();
                $recensement_licence->user_id=1;
                $recensement_licence->bien_id=$request->bien_id;
                $recensement_licence->annee_id=$request->annee_id;
                $recensement_licence->Date_rdv=$request->Date_rdv;
                $recensement_licence->Date_recensement=$request->Date_recensement;
                $recensement_licence->categorie=$request->categorie;
                $recensement_licence->save();
                toastr()->success("Recensement effectué avec succes");
                return to_route("licence.liste");
            }
        }
        
    }

    public function modif ($id) {
           // Trouver le recensement licence par ID
           $recensement_licence = Recensement_licence::findOrFail($id);
    
           // Récupérer les IDs des biens déjà recensés
           $biensRecenses = Recensement_licence::pluck('bien_id')->toArray();
       
           // Récupérer les biens non recensés
           $bien = Bien::whereNotIn('id', $biensRecenses)
                        ->where('delete', 0)
                        ->get();
       

        return view('Admin::Licence.Modif',compact('recensement_licence','bien'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement = Recensement_licence::where('bien_id', $request->bien_id)
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
                toastr()->error('ce bien est déja recenser en licence pour cette année');
                return back();
            }else{
                $recencement_licence=Recensement_licence::findOrFail($id);
                $recencement_licence->user_id=1;
                $recencement_licence->bien_id=$request->bien_id;
                $recencement_licence->annee_id=$request->annee_id;
                $recencement_licence->Date_rdv=$request->Date_rdv;
                $recencement_licence->Date_recensement=$request->Date_recensement;
                $recencement_licence->categorie=$request->categorie;
                $recencement_licence->update();
                toastr()->success("Recensement Modifier avec succes");
                return to_route("licence.liste");
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

    public function recense(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required'
        ]);

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->first();
        if($verifBienExist)
        {
            return to_route('licence.ajout',$verifBienExist->id);
        }else{
            toastr()->error("Bien. '$request->numero_bien.' est introuvable dans la base de données");
             return back();
        }
    }

    public function voir ($id) {
        $recencement_licence=Recensement_licence::findOrFail($id);
        return view('Admin::Licence.Voir',compact('recencement_licence'));
    }

    public function corbeille () {
        return view('Admin::Licence.Corbeille');
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
        $recensements = Recensement_licence::where('annee_id', $anneeActive->id)
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
}
