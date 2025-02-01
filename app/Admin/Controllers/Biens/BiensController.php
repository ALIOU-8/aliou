<?php

namespace App\Admin\Controllers\Biens;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Contribuable;
use App\Models\TypeBien;
use Illuminate\Http\Request;

class BiensController extends Controller
{
    public function index () {
        $bien=Bien::where('delete',0)->orderBy('id','desc')->get();
        return view('Admin::Biens.Liste',compact('bien'));
    }

    public function ajout () {
        $contribuable=Contribuable::where('delete',0)->get();
        $typeBien=TypeBien::where('status',0)->get();
        return view('Admin::Biens.Ajout',compact('contribuable','typeBien'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contribuable_id'=>'required',
            'type_bien_id'=>'required',
            'libelle'=>'required',
            'adresse'=>'required',
        ]);
       // Récupérer le libellé du type de bien à partir de l'ID
        $typeBien = TypeBien::findOrFail($request->type_bien_id)->libelle;
    
        // Extraire les 4 premières lettres en majuscules
         $prefix = strtoupper(substr($typeBien, 0, 4));
         // Trouver le dernier bien enregistré avec ce type
        $lastBien = Bien::where('type_bien_id', $request->type_bien_id)
        ->latest('id')
        ->lockForUpdate()
        ->first();
        // Générer le prochain numéro
        $nextNumber = $lastBien ? intval(substr($lastBien->numero_bien, 4)) + 1 : 1;
        $numero_bien = $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
         // Vérification d'unicité
    if (Bien::where('numero_bien', $numero_bien)->exists()) {
        toastr()->error("Le NIF $numero_bien existe déjà.");
        return back();
    }
        // Création du bien avec le NIF généré
        $bien=new Bien();
        $bien->contribuable_id=$request->contribuable_id;
        $bien->type_bien_id=$request->type_bien_id;
        $bien->libelle=$request->libelle;
        $bien->adresse=$request->adresse;
        $bien->numero_bien=$numero_bien;
        $bien->save();
        toastr()->success("Le bien $numero_bien a été ajouter avec succes.");
        return to_route("biens.liste");
    }

    public function modif () {
        return view('Admin::Biens.Modif');
    }

    public function voir () {
        return view('Admin::Biens.Voir');
    }

    public function corbeille() {
        return view('Admin::Biens.Corbeille');
    }
}
