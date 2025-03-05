<?php

namespace App\Admin\Controllers\Impots;

use App\Http\Controllers\Controller;
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
        $impot = Impot::get();
        return view('Admin::Impots.Liste',compact('impot'));
    }

    public function ajout () {
        return view('Admin::Impots.Imposition');
    }

    public function modif (string $id) {
        $impot = Impot::where('id', $id)->first();
        if ($impot->type_impot == "cfu") {
            $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "tpu") {
            $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "patente") {
            $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "licence") {
            $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->with('bien')->first();
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
        $impot  = Impot::where('id',$id)->first();
        if ($type == "cfu") {
            $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "tpu") {
            $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "patente") {
            $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "licence") {
            $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        return view('Admin::Impots.Voir',compact('impot','recensement','bien'));
    }

    public function payer (string $id) {
        $impot = Impot::where('id',$id)->first();
        $paiement = Paiement::where('impot_id',$id)->get();
        if ($impot->type_impot == "cfu") {
            $recensement=Recensement_cfu::where('id',$impot->recensement_cfu_id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "tpu") {
            $recensement=Recensement_tpu::where('id',$impot->recensement_tpu_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "patente") {
            $recensement=Recensement_patente::where('id',$impot->recensement_patente_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($impot->type_impot == "licence") {
            $recensement=Recensement_licence::where('id',$impot->recensement_licence_id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if (empty($paiement)) {
            $montantRestant = $impot->montant_a_payer;
        } else {
            $montantRestant = $impot->montant_a_payer - collect($paiement)->sum('montant_payer');
        }
        return view('Admin::Impots.Payer',compact('impot','recensement','bien','montantRestant','paiement'));
    }

    public function payement(Request $request, string $id) {

        $request->validate([
            'montant' => 'required|numeric|min:4',
        ]);

        // Vérifier si l'impôt existe
        $impot = Impot::find($id);
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


    public function imposition (string $type, string $id,) {
        if ($type == "cfu") {
            $recensement=Recensement_cfu::where('id',$id)->with('occupant')->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "tpu") {
            $recensement=Recensement_tpu::where('id',$id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "patente") {
            $recensement=Recensement_patente::where('id',$id)->with('bien')->first();
            $bien = Bien::where('id',$recensement->bien_id)->with('contribuable')->with('typeBien')->first();
        }
        if ($type == "licence") {
            $recensement=Recensement_licence::where('id',$id)->with('bien')->first();
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
        $impot = new Impot();
        $impot->type_impot = $type;
        $impot->statut = "nonPayé";
        $impot->montant_brute = $request->montant_brute;
        $impot->montant_a_payer = $request->montant_a_payer;
        $impot->date_limite = $request->date_limite;
        $impot->base_imposition = $request->base_imposition;
        $impot->imposition_anterieur = $request->imposition_anterieur;
        $impot->penalite = $request->penalite;
        $impot->droit_fixe = $request->droit_fixe;
        $impot->droit_proportionnel = $request->droit_proportionnel;
        $impot->article = 1;
        $impot->role = 1;
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
