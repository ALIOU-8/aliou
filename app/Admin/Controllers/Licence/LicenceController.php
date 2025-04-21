<?php

namespace App\Admin\Controllers\Licence;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Historique;
use App\Models\Recensement_licence;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LicenceController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $recencement_licence=Recensement_licence::where('annee_id',$anneeActive->id)->orderBy('id','desc')->paginate(10);
        return view('Admin::Licence.Liste',compact('recencement_licence'));
    }

    public function ajout ($uuid) {
        $bien_recence=Bien::where('uuid',$uuid)->firstOrFail();
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
                $recensement_licence->user_id=Auth::user()->id;
                $recensement_licence->bien_id=$request->bien_id;
                $recensement_licence->annee_id=$request->annee_id;
                $recensement_licence->Date_rdv=$request->Date_rdv;
                $recensement_licence->Date_recensement=$request->Date_recensement;
                $recensement_licence->categorie=$request->categorie;
                $recensement_licence->save();
                $annee=Annee::where('active',1)->first();
                 Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'Licence',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
                toastr()->success("Recensement effectué avec succes");
                return to_route("licence.liste");
            }
        }
        
    }

    public function modif ($uuid) {
           // Trouver le recensement licence par ID
           $recensement_licence = Recensement_licence::where('uuid',$uuid)->firstOrFail();
    
           // Récupérer les IDs des biens déjà recensés
           $biensRecenses = Recensement_licence::pluck('bien_id')->toArray();
       
           // Récupérer les biens non recensés
           $bien = Bien::whereNotIn('id', $biensRecenses)
                        ->where('delete', 0)
                        ->get();
       

        return view('Admin::Licence.Modif',compact('recensement_licence','bien'));
    }

    public function update(Request $request,$uuid)
    {
        $request->validate([
            'categorie' =>'required',
            'Date_rdv' =>'required',
            'Date_recensement' =>'required'
        ]);
        $doublonRecencement = Recensement_licence::where('bien_id', $request->bien_id)
        ->where('annee_id', $request->annee_id)
        ->where('uuid', '!=', $request->uuid) // Ignorer l'enregistrement en cours de modification
        ->first();
        $verifDateRecensement=Annee::findOrFail($request->annee_id);
        $dateLocal=Carbon::now('UTC');
        if($dateLocal->greaterThan($verifDateRecensement->Date_fin))
        {
            toastr()->error('La date limite du recensement  est passé');
            return back();
        }else{
            if($doublonRecencement)
            {
                toastr()->error('ce bien est déja recenser en licence pour cette année');
                return back();
            }else{
                $recencement_licence=Recensement_licence::where('uuid',$uuid)->firstOrFail();
                $recencement_licence->user_id=1;
                $recencement_licence->bien_id=$request->bien_id;
                $recencement_licence->annee_id=$request->annee_id;
                $recencement_licence->Date_rdv=$request->Date_rdv;
                $recencement_licence->Date_recensement=$request->Date_recensement;
                $recencement_licence->categorie=$request->categorie;
                $recencement_licence->update();
                $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'Licence',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
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

        $verifBienExist=Bien::where('numero_bien',$request->numero_bien)->where('delete',0)->first();
        if($verifBienExist)
        {
            return to_route('licence.ajout',$verifBienExist->uuid);
        }else{
            toastr()->error("Bien. '$request->numero_bien.' est introuvable dans la base de données");
             return back();
        }
    }

    public function voir ($uuid) {
        $recencement_licence=Recensement_licence::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Licence.Voir',compact('recencement_licence'));
    }

    public function corbeille () {
        return view('Admin::Licence.Corbeille');
    }

    public function recherche(Request $request)
    {
        if ($request->has('search')) {
        $search = $request->input('search');

        // Récupérer l'année active
        $anneeActive = Annee::where('active', 1)->firstOrFail();
        $recencement_licence = Recensement_licence::where('annee_id', $anneeActive->id)
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
            return view('Admin::Licence.Liste',compact('recencement_licence'));
        }
    }

    public function imprimer()
    {
        $annee = Annee::where('active', 1)->firstOrFail();
        $licence= Recensement_licence::where('annee_id',$annee->id)->with('bien')->orderBy('id','desc')->get();
        $pdf = Pdf::loadView('Admin::Licence.imprimer', compact('licence', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Licence',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        return $pdf->stream('licence.pdf'); 
    }
    
}
