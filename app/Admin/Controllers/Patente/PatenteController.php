<?php

namespace App\Admin\Controllers\Patente;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Historique;
use App\Models\Recensement_patente;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatenteController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_patente=Recensement_patente::where('annee_id',$anneeActive->id)->orderBy('id','desc')->paginate(10);
        return view('Admin::Patente.Liste',compact('recencement_patente'));
    }

    public function ajout ($uuid) {
        $bien_recence=Bien::where('uuid',$uuid)->firstOrFail();
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
                $recencement_patente->user_id=Auth::user()->id;
                $recencement_patente->bien_id=$request->bien_id;
                $recencement_patente->annee_id=$request->annee_id;
                $recencement_patente->Date_rdv=$request->Date_rdv;
                $recencement_patente->Date_recensement=$request->Date_recensement;
                $recencement_patente->categorie=$request->categorie;
                $recencement_patente->save();
                $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'patente',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
                toastr()->success("Recensement effectué avec succes");
                return to_route("patente.liste");
            }
        }
        
    }

    public function update(Request $request,$uuid)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement = Recensement_patente::where('bien_id', $request->bien_id)
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
                toastr()->error('ce bien est déja recenser en patente pour cette année');
                return back();
            }else{
                $recensement_patente=Recensement_patente::where('uuid',$uuid)->firstOrFail();
                $recensement_patente->user_id=1;
                $recensement_patente->bien_id=$request->bien_id;
                $recensement_patente->annee_id=$request->annee_id;
                $recensement_patente->Date_rdv=$request->Date_rdv;
                $recensement_patente->Date_recensement=$request->Date_recensement;
                $recensement_patente->categorie=$request->categorie;
                $recensement_patente->update();
                $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'Patente',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
                toastr()->success("Recensement Modifier avec succes");
                return to_route("patente.liste");
            }
        }
    }

    public function modif ($uuid) {
        // Trouver le recensement licence par uuid
        $recensement_patente =Recensement_patente::where('uuid',$uuid)->firstOrFail();
 
        // Récupérer les IDs des biens déjà recensés
        $biensRecenses =Recensement_patente::pluck('bien_id')->toArray();
    
        // Récupérer les biens non recensés
        $bien = Bien::whereNotIn('id', $biensRecenses)
                     ->where('delete', 0)
                     ->get();
    

     return view('Admin::Patente.Modif',compact('recensement_patente','bien'));
    }    
    public function voir ($uuid) {
        $recensement_patente=Recensement_patente::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Patente.Voir',compact('recensement_patente'));
    }
    public function recense(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required'
        ]);

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->where('delete',0)->first();
        if($verifBienExist)
        {
            return to_route('patente.ajout',$verifBienExist->uuid);
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

    public function recherche(Request $request)
    {
        if ($request->has('search')) {
        $search = $request->input('search');

        // Récupérer l'année active
        $anneeActive = Annee::where('active', 1)->firstOrFail();
        $recencement_patente = Recensement_patente::where('annee_id', $anneeActive->id)
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
            return view('Admin::Patente.Liste',compact('recencement_patente'));
        }
    }
    public function corbeille () {
        return view('Admin::Patente.Corbeille');
    }

    public function imprimer()
    {
        $annee = Annee::where('active', 1)->firstOrFail();
        $patente= Recensement_patente::where('annee_id',$annee->id)->with('bien')->orderBy('id','desc')->get();
        $pdf = Pdf::loadView('Admin::Patente.imprimer', compact('patente', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Patente',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        return $pdf->stream('patente.pdf'); 
    }
}
