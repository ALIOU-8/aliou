<?php

namespace App\Admin\Controllers\CFU;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Historique;
use App\Models\Occupant;
use App\Models\Recensement_cfu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OccupantController extends Controller
{
    
    public function index ($uuid) {
        $batiment = Recensement_cfu::where('uuid',$uuid)->firstOrFail();
        $occupant = Occupant::where('recensement_cfu_id',$batiment->id)->orderBy('id', 'desc')->where('delete',0)->get();
        $nombatiment = Bien::where('id',$batiment->bien_id)->first();
        return view('Admin::CFU.Occupant.Liste',compact('occupant','nombatiment', 'batiment'));
    }

    public function ajout ($uuid) {
        $cfu = Recensement_cfu::where('uuid',$uuid)->firstOrFail();
        $nombatiment = Bien::where('id',$cfu->bien_id)->firstOrFail();
        return view('Admin::CFU.Occupant.Ajout',compact('cfu','nombatiment'));
    }

    public function store (Request $request, $uuid) {
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
        $cfu = Recensement_cfu::where('uuid',$uuid)->firstOrFail();
        $occupant->recensement_cfu_id = $cfu->id;
        $occupant->nom = $request->nom;
        $occupant->prenom = $request->prenom;
        $occupant->niveau = $request->niveau;
        $occupant->unite = $request->unite;
        $occupant->activite = $request->activite;
        $occupant->valeur_locative = $request->valeur_locative;
        $occupant->observation = $request->observation;
        $occupant->type_occupant = $request->type_occupant;
        $occupant->save();
        $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'occupant',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Occupant ajouté avec succèss');
        return to_route('cfu.occupant.liste',$uuid);
    } 

    public function delete($uuid) {
        $occupant=Occupant::where('uuid',$uuid)->firstOrFail();
        $occupant->delete=1;
        $occupant->update();
        $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Supprimer',
                'activite'=>'occupant',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Occupant supprimé avec Succès');
        return back();
    }

    public function modif ($uuid) {
        $occupant = Occupant::where('uuid',$uuid)->firstOrFail();
        $cfu = Recensement_cfu::where('id',$occupant->recensement_cfu_id)->first();
        return view('Admin::CFU.Occupant.Modif',compact('occupant', 'cfu'));
    }

    public function update (Request $request, $uuid) {
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
        $occupant = Occupant::where('uuid',$uuid)->firstOrFail();
        $id2 = Recensement_cfu::where('id', $occupant->recensement_cfu_id)->firstOrFail();
        $occupant->nom = $request->nom;
        $occupant->prenom = $request->prenom;
        $occupant->niveau = $request->niveau;
        $occupant->unite = $request->unite;
        $occupant->activite = $request->activite;
        $occupant->valeur_locative = $request->valeur_locative;
        $occupant->observation = $request->observation;
        $occupant->type_occupant = $request->type_occupant;
        $occupant->update();
        $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'occupant',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Occupant modifié avec succèss');
        return to_route('cfu.occupant.liste',$id2->uuid);
    }

    public function corbeille ($uuid) {
        $batiment = Recensement_cfu::where('uuid',$uuid)->firstOrFail();
        $occupant = Occupant::where('recensement_cfu_id',$batiment->id)->orderBy('id', 'desc')->where('delete',1)->get();
        $nombatiment = Bien::where('id',$batiment->bien_id)->first();
        return view('Admin::CFU.Occupant.Corbeille',compact('occupant','nombatiment', 'batiment'));
    }

    public function restaure ($uuid) {
        $occupant=Occupant::where('uuid',$uuid)->firstOrFail();
        $occupant->delete=0;
        $occupant->update();
        $annee=Annee::where('active',1)->first();
            Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Restorer',
                'activite'=>'occupant',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Occupant restauré avec Succès');
        return back();
    }
}
