<?php

namespace App\Admin\Controllers\Paiement;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Impot;
use App\Models\Paiement;
use App\Models\Recensement_patente;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index () {
        $anneeActive = Annee::where('active', 1)->firstOrFail();
        // Récupérer les IDs des impôts liés à l'année active
        $impotsIds = Impot::where('annee_id', $anneeActive->id)->pluck('id');
        // Filtrer les paiements en fonction des impôts récupérés
        $paiement = Paiement::whereIn('impot_id', $impotsIds)->with('impot')->get();
        

        return view('Admin::Paiement.Liste',compact('paiement','anneeActive'));
    }

    public function chercheNumero(Request $request)
    {
        $request->validate([
            'numero'=>'required',
        ]);
        $impot=Impot::where('numero',$request->numero)->first();
        if(!$impot)
        {
            toastr()->error("numero de l'avis introuvable");
            return back();
        }else{
            return to_route('impot.payer',$impot->id);
        }
    }
}
