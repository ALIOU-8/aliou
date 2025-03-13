<?php

namespace App\Admin\Controllers\Impots;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Impot;
use App\Models\Paiement;
use App\Models\Recensement_cfu;
use App\Models\Recensement_licence;
use App\Models\Recensement_patente;
use App\Models\Recensement_tpu;
use Illuminate\Http\Request;

class ImpotsController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->first();
        $impot = Impot::orderBy('id','desc')->where('annee_id',$anneeActive->id)->paginate(10);


        
        return view('Admin::Impots.Liste',compact('impot'));
    }

    public function ajout () {
        return view('Admin::Impots.Imposition');
    }

    public function modif (string $id) {
        $impot = Impot::where('id', $id)->first();
        if ($impot->type_impot == "cfu") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->where('annee_id',$anneeActive->id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "tpu") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "patente") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "licence") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        return view('Admin::Impots.Modif',compact('recensement','bien','impot'));
    }

    public function update (Request $request, string $id) {
        $request->validate([
            'montant_brute'=>'required',
            'montant_a_payer'=>'required',
            'date_limite'=>'required',
            'base_imposition'=>'required',
            'imposition_anterieur'=>'required',
            'penalite'=>'required',
            'droit_fixe'=>'required',
            'droit_proportionnel'=>'required',
        ]);
        $impot = Impot::where('id',$id)->first();
        $impot->montant_brute = $request->montant_brute;
        $impot->montant_a_payer = $request->montant_a_payer;
        $impot->date_limite = $request->date_limite;
        $impot->base_imposition = $request->base_imposition;
        $impot->imposition_anterieur = $request->imposition_anterieur;
        $impot->penalite = $request->penalite;
        $impot->droit_fixe = $request->droit_fixe;
        $impot->droit_proportionnel = $request->droit_proportionnel;
        $impot->update();
        toastr()->success('Imposition modifié avec succèss');
        return to_route('impot.liste');
    }

    public function voir (string $type, string $id) {
        $anneeActive=Annee::where('active',1)->first();
        $impot  = Impot::where('id',$id)->where('annee_id',$anneeActive->id)->first();
        if (!$impot) {
            toastr()->error('Impôt introuvable');
            return back();
        }
        if ($type == "cfu") {
            $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->where('annee_id',$anneeActive->id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "tpu") {
            $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "patente") {
            $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "licence") {
            $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if($recensement)
        return view('Admin::Impots.Voir',compact('impot','recensement','bien'));
    }

    public function payer (string $id) {
        $anneeActive=Annee::where('active',1)->first();
        $impot = Impot::where('id',$id)->where('annee_id',$anneeActive->id)->first();
        $paiement = Paiement::where('impot_id',$id)->get();
        if($impot)
        {
            if ($impot->type_impot == "cfu") {
                $anneeActive=Annee::where('active',1)->first();
                $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->where('annee_id',$anneeActive->id)->with('occupant')->with('bien')->first();
                $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
            }
            if ($impot->type_impot == "tpu") {
                $anneeActive=Annee::where('active',1)->first();
                $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
                $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
            }
            if ($impot->type_impot == "patente") {
                $anneeActive=Annee::where('active',1)->first();
                $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
                $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
            }
            if ($impot->type_impot == "licence") {
                $anneeActive=Annee::where('active',1)->first();
                $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->where('annee_id',$anneeActive->id)->with('bien')->first();
                $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
            }
            if (empty($paiement)) {
                $montantRestant = $impot->montant_a_payer;
            } else {
                $montantRestant = $impot->montant_a_payer - collect($paiement)->sum('montant_payer');
            }
        }else{
            toastr()->error('Impôt introuvable');
            return  back();
        }
       
        return view('Admin::Impots.Payer',compact('impot','recensement','bien','montantRestant','paiement'));
    }

    public function payement(Request $request, string $id) {

        $request->validate([
            'montant' => 'required|numeric|min:4',
        ]);

        // Vérifier si l'impôt existe
        $anneeActive=Annee::where('active',1)->first();
        $impot = Impot::where('id',$id)->where('annee_id',$anneeActive->id)->first();

        if (!$impot) {
            toastr()->error('Impôt introuvable');
            return back();
        }

        // Calcul du total des paiements déjà effectués
        $totalPaye = Paiement::where('impot_id', $id)->sum('montant_payer');

        // Vérifier que le montant payé ne dépasse pas le montant dû
        if ($request->montant > $impot->montant_a_payer - $totalPaye) {
            toastr()->error('Le montant payé dépasse le montant dû.');
            return back();
        }

        // Création du paiement
        $payement = new Paiement();
        $payement->user_id = 1;
        $payement->impot_id = $id;
        $payement->montant_payer = $request->montant;
        $payement->montant_restant = $impot->montant_a_payer - ($totalPaye + $request->montant);
        $payement->save();

        // Mise à jour du statut de l'impôt
        if ($payement->montant_restant <= 0) {
            $impot->statut = "Payé";
        } else {
            $impot->statut = "Encours";
        }
        $impot->update();

        toastr()->success('Paiement effectué avec succès');
        return back();
    }

    public function chercherBien(Request $request)
    {
        $request->validate([
            'numero_bien' =>'required',
            'type'=>'required'
        ]);
    // Récupérer le numéro du bien
    $bienNumero = $request->numero_bien;
    $anneeActive=Annee::where('active',1)->first();
    $bien=Bien::where('numero_bien',$bienNumero)->with('contribuable')->with('typeBien')->first();
    if(!$bien)
    {
        toastr()->error("le Bien est introuvable dans la base de donnée");
        return back();
    }
    // Chercher dans les différentes tables
    if($request->type=='cfu')
    {
        $recensement = Recensement_cfu::where('bien_id', $bien->id)->where('annee_id',$anneeActive->id)->first();
       // $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
    }
    if($request->type=='tpu')
    {
        $recensement = Recensement_tpu::where('bien_id', $bien->id)->where('annee_id',$anneeActive->id)->first();
       // $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
    }
    if($request->type=='patente')
    {
        $recensement = Recensement_patente::where('bien_id', $bien->id)->where('annee_id',$anneeActive->id)->first();
       // $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
    }
    if($request->type=='licence')
    {
        $recensement = Recensement_licence::where('bien_id', $bien->id)->where('annee_id',$anneeActive->id)->first();
       // $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
    }
    $type=$request->type;
    if($recensement)
        {
            return redirect()->route('impot.imposition', [
                'type' => $type,
                'id' => $recensement->id // On passe uniquement l'ID
            ]);        
        }else{
            toastr()->error("ce bien n'est pas recensé en $type");
            return back(); 
        }
    }
    public function imposition (string $type, string $id) {
        if ($type == "cfu") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_cfu::where('id',$id)->with('occupant')->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "tpu") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_tpu::where('id',$id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "patente") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_patente::where('id',$id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "licence") {
            $anneeActive=Annee::where('active',1)->first();
            $recensement=Recensement_licence::where('id',$id)->where('annee_id',$anneeActive->id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
            return view('Admin::Impots.Imposition',compact('recensement','bien','type')); 
    }

    public function imposer (string $type, string $id, Request $request) {
        $request->validate([
            'montant_brute'=>'required',
            'montant_a_payer'=>'required',
            'date_limite'=>'required',
            'base_imposition'=>'required',
            'imposition_anterieur'=>'required',
            'penalite'=>'required',
            'droit_fixe'=>'required',
            'droit_proportionnel'=>'required',
        ]);
        $anneeActive = Annee::where('active', 1)->first();

        if ($anneeActive) {
            // Chercher le dernier impôt enregistré pour cette année
            $dernierImpot = Impot::where('annee_id', $anneeActive->id)
                ->orderByDesc('role')
                ->orderByDesc('article')
                ->first();

            if ($dernierImpot) {
                // Si un impôt existe, on récupère le dernier rôle et article
                $dernierRole = $dernierImpot->role;
                $dernierArticle = $dernierImpot->article;

                if ($dernierArticle < 10) {
                    // Incrémenter l'article dans le même rôle
                    $article = $dernierArticle + 1;
                    $role = $dernierRole;
                } else {
                    // Si article atteint 10, on passe au rôle suivant et on remet article à 1
                    $article = 1;
                    $role = $dernierRole + 1;
                }
            } else {
                // Si aucun impôt n'existe pour cette année, on commence avec rôle 1 et article 1
                $role = 1;
                $article = 1;
            }

            // Création de l'impôt avec le bon rôle et article
            $doublons=Impot::where('annee_id',$anneeActive->id)->where('type_impot',$type)->first();
            if($doublons)
            {
                toastr()->error("ce bien est déja imposé pour cette année $anneeActive->annee ");
                return back();
            }
            $impot = new Impot();
            $impot->type_impot = $type;
            $impot->annee_id = $anneeActive->id;
            $impot->statut = "nonPayé";
            $impot->montant_brute = $request->montant_brute;
            $impot->montant_a_payer = $request->montant_a_payer;
            $impot->date_limite = $request->date_limite;
            $impot->base_imposition = $request->base_imposition;
            $impot->imposition_anterieur = $request->imposition_anterieur;
            $impot->penalite = $request->penalite;
            $impot->droit_fixe = $request->droit_fixe;
            $impot->droit_proportionnel = $request->droit_proportionnel;
            $impot->article = $article;
            $impot->role = $role;
            if ($type == 'cfu'){
                $impot->recensement_cfu_id = $id;
            }
            if ($type == 'tpu'){
                $impot->recensement_tpu_id = $id;
            }
            if ($type == 'patente'){
                $impot->recensement_patente_id = $id;
            }
            if ($type == 'licence'){
                $impot->recensement_licence_id = $id;
            }

            $impot->save();
            toastr()->success('Imposition effectué avec succèss');
            return to_route('impot.liste');
        }
    }

    public function search(Request $request)
    {
    $query = $request->input('query');
    $anneeActive = Annee::where('active', 1)->first();

    if (!$anneeActive) {
        return response()->json([]);
    }

    $impots = Impot::where('annee_id', $anneeActive->id)
        ->where(function ($q) use ($query) {
            $q->where('type_impot', 'like', "%$query%")
              ->orWhere('role', 'like', "%$query%")
              ->orWhere('article', 'like', "%$query%")
              ->orWhere('statut', 'like', "%$query%")
              ->orWhere('montant_a_payer', 'like', "%$query%")
              ->orWhereHas('recensement_cfu.bien.contribuable', function ($q) use ($query) {
                  $q->where('nom', 'like', "%$query%")
                    ->orWhere('prenom', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%");
              })
              ->orWhereHas('recensement_tpu.bien.contribuable', function ($q) use ($query) {
                  $q->where('nom', 'like', "%$query%")
                    ->orWhere('prenom', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%");
              })
              ->orWhereHas('recensement_patente.bien.contribuable', function ($q) use ($query) {
                  $q->where('nom', 'like', "%$query%")
                    ->orWhere('prenom', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%");
              })
              ->orWhereHas('recensement_licence.bien.contribuable', function ($q) use ($query) {
                  $q->where('nom', 'like', "%$query%")
                    ->orWhere('prenom', 'like', "%$query%")
                    ->orWhere('telephone', 'like', "%$query%");
              });
        })
        ->with([
            'recensement_cfu.bien.contribuable',
            'recensement_tpu.bien.contribuable',
            'recensement_patente.bien.contribuable',
            'recensement_licence.bien.contribuable',
            'annee'
        ])
        ->orderBy('id', 'desc')
        ->get();

    return response()->json($impots);
    }
}
