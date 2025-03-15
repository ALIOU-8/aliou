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
        $anneeActive=Annee::where('active',1)->first();
        $impot = Impot::orderBy('id','desc')->where('annee_id',$anneeActive->id)->get();
        $paiement = Paiement::get();
        return view('Admin::Paiement.Liste',compact('impot','paiement'));
    }
}
