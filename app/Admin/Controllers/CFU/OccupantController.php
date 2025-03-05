<?php

namespace App\Admin\Controllers\CFU;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Occupant;
use App\Models\Recensement_cfu;
use Illuminate\Http\Request;

class OccupantController extends Controller
{
    
    public function index ($id) {
        $occupant = Occupant::where('recensement_cfu_id',$id)->orderBy('id', 'desc')->where('delete',0)->get();
        $batiment = Recensement_cfu::where('id',$id)->first();
        $nombatiment = Bien::where('id',$batiment->bien_id)->first();
        return view('Admin::CFU.Occupant.Liste',compact('occupant','nombatiment', 'batiment'));
    }

    public function ajout ($id) {
        $cfu = Recensement_cfu::where('id',$id)->first();
        $nombatiment = Bien::where('id',$cfu->bien_id)->first();
        return view('Admin::CFU.Occupant.Ajout',compact('cfu','nombatiment'));
    }

    public function store (Request $request, $id) {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'niveau'=>'required',
            'unite'=>'required',
            'activite'=>'required',
            'valeur_locative'=>'required',
            'observation'=>'required',
            'type_occupant'=>'required',
        ]);
        $occupant = new Occupant();
        $occupant->recensement_cfu_id = $id;
        $occupant->nom = $request->nom;
        $occupant->prenom = $request->prenom;
        $occupant->niveau = $request->niveau;
        $occupant->unite = $request->unite;
        $occupant->activite = $request->activite;
        $occupant->valeur_locative = $request->valeur_locative;
        $occupant->observation = $request->observation;
        $occupant->type_occupant = $request->type_occupant;
        $occupant->save();
        toastr()->success('Occupant ajouté avec succèss');
        return to_route('cfu.occupant.liste',$id);
    } 

    public function delete($id) {
        $occupant=Occupant::findOrFAil($id);
        $occupant->delete=1;
        $occupant->update();
        toastr()->success('Occupant supprimé avec Succès');
        return back();
    }

    public function modif ($id) {
        $occupant = Occupant::where('id',$id)->first();
        $cfu = Recensement_cfu::where('id',$occupant->recensement_cfu_id)->first();
        return view('Admin::CFU.Occupant.Modif',compact('occupant', 'cfu'));
    }

    public function update (Request $request, $id) {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'niveau'=>'required',
            'unite'=>'required',
            'activite'=>'required',
            'valeur_locative'=>'required',
            'observation'=>'required',
            'type_occupant'=>'required',
        ]);
        $occupant = Occupant::where('id', $id)->first();
        $id2 = Recensement_cfu::where('id', $occupant->recensement_cfu_id)->first();
        $occupant->nom = $request->nom;
        $occupant->prenom = $request->prenom;
        $occupant->niveau = $request->niveau;
        $occupant->unite = $request->unite;
        $occupant->activite = $request->activite;
        $occupant->valeur_locative = $request->valeur_locative;
        $occupant->observation = $request->observation;
        $occupant->type_occupant = $request->type_occupant;
        $occupant->update();
        toastr()->success('Occupant modifié avec succèss');
        return to_route('cfu.occupant.liste',$id2);
    }

    public function corbeille ($id) {
        $occupant = Occupant::where('recensement_cfu_id',$id)->orderBy('id', 'desc')->where('delete',1)->get();
        $batiment = Recensement_cfu::where('id',$id)->first();
        $nombatiment = Bien::where('id',$batiment->bien_id)->first();
        return view('Admin::CFU.Occupant.Corbeille',compact('occupant','nombatiment', 'batiment'));
    }

    public function restaure ($id) {
        $occupant=Occupant::findOrFAil($id);
        $occupant->delete=0;
        $occupant->update();
        toastr()->success('Occupant restauré avec Succès');
        return back();
    }
}
