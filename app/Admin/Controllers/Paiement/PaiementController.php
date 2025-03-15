<?php

namespace App\Admin\Controllers\Paiement;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Impot;
use App\Models\Paiement;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index () {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $impot = Impot::orderBy('id','desc')->where('annee_id',$anneeActive->id)->get();
        $paiement = Paiement::get();
        return view('Admin::Paiement.Liste',compact('impot','paiement'));
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
