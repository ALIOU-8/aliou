<?php

namespace App\Admin\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Fonction;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonnelsController extends Controller
{
    public function index () {
        $personnel=Personnel::where('delete',0)->orderBy('id','desc')->paginate(10);
        return view('Admin::Personnels.Liste',compact('personnel'));
    }

    public function ajout () {
        $fonction=Fonction::where('delete',0)->get();
        $hierachie=['A1','A2','B1','B2'];
        return view('Admin::Personnels.Ajout',compact('fonction','hierachie'));
    }

    public function recherche(Request $request)
    {
        $query = Personnel::where('delete', '0')->with('fonction');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('matricule', 'LIKE', "%{$search}%")
                ->orWhere('nom', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%")
                ->orWhere('telephone', 'LIKE', "%{$search}%")
                ->orWhere('hierachie', 'LIKE', "%{$search}%")
                ->orWhereHas('fonction', function ($q) use ($search) {
                    $q->where('libelle', 'LIKE', "%{$search}%");
                });
             });
         }

        $personnel = $query->paginate(10);

        return view('Admin::Personnels.Liste',compact('personnel'));
    }

    public function recherche_corbeille(Request $request)
    {
        $query = Personnel::where('delete', '1')->with('fonction');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('matricule', 'LIKE', "%{$search}%")
                ->orWhere('nom', 'LIKE', "%{$search}%")
                ->orWhere('prenom', 'LIKE', "%{$search}%")
                ->orWhere('telephone', 'LIKE', "%{$search}%")
                ->orWhere('hierachie', 'LIKE', "%{$search}%")
                ->orWhereHas('fonction', function ($q) use ($search) {
                    $q->where('libelle', 'LIKE', "%{$search}%");
                });
             });
         }

        $personnel = $query->paginate(10);

        return view('Admin::Personnels.Corbeille',compact('personnel'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricule'=>'required|unique:personnels',
            'nom'=>'required',
            'prenom'=>'required',
            'telephone'=>'required|unique:personnels',
            'fonction'=>'required',
            'hierachie'=>'required'

        ]);

        $personnel=new Personnel();
        $personnel->matricule=$request->matricule;
        $personnel->nom=$request->nom;
        $personnel->prenom=$request->prenom;
        $personnel->telephone=$request->telephone;
        $personnel->fonction_id=$request->fonction;
        $personnel->hierachie=$request->hierachie;
        $personnel->save();
        toastr()->success('Personnel enregistré avec succes');
        return to_route('personnels.liste');

    }
    public function update(Request $request,$uuid)
    {
        $request->validate([
            'matricule'=>[
                'required',
                Rule::unique('personnels','matricule')->ignore($uuid,'uuid')
            ],
            'nom'=>'required',
            'prenom'=>'required',
            'telephone' => [
                'required',
                'numeric',
                Rule::unique('personnels', 'telephone')->ignore($uuid, 'uuid'),
            ],
            'fonction'=>'required',
            'hierachie'=>'required'

        ]);

        $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
        $personnel->matricule=$request->matricule;
        $personnel->nom=$request->nom;
        $personnel->prenom=$request->prenom;
        $personnel->telephone=$request->telephone;
        $personnel->fonction_id=$request->fonction;
        $personnel->hierachie=$request->hierachie;
        $personnel->update();
        toastr()->success('Personnel modifié avec succes');
        return to_route('personnels.liste');

    }


    public function modif ($uuid) {
    $fonction=Fonction::where('delete',0)->get();
    $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
    $hierachie=['A1','A2','B1','B2'];
        return view('Admin::Personnels.Modif',compact("personnel","fonction","hierachie"));
    }

    public function voir () {
        return view('Admin::Personnels.Voir');
    }

    public function imprimer () {
        $personnel=Personnel::where('delete',0)->orderBy('id','desc')->get();
        $annee=Annee::where('active',1)->firstOrFail();
        return view('Admin::Personnels.Imprimer',compact('personnel','annee'));
    }

    public function corbeille () {
        $personnel=Personnel::where('delete',1)->orderBy('id','desc')->get();
        return view ('Admin::Personnels.Corbeille',compact('personnel'));
    }

    public function delete($uuid)
    {
        $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
        $personnel->delete=1;
        $personnel->update();
        toastr()->success('personnel Supprimez avec Succes');
        return to_route('personnels.liste');
    }
    public function restaure($uuid)
    {
        $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
        $personnel->delete=0;
        $personnel->update();
        toastr()->success('personnel restaurez avec Succes');
        return to_route('personnels.liste');
    }
}
