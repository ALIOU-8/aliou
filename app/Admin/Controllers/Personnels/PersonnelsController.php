<?php

namespace App\Admin\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Fonction;
use App\Models\Personnel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PersonnelsController extends Controller
{
    public function index () {
        $personnel=Personnel::where('delete',0)->orderBy('id','desc')->get();
        return view('Admin::Personnels.Liste',compact('personnel'));
    }

    public function ajout () {
        $fonction=Fonction::where('delete',0)->get();
        $hierachie=['A1','A2','B1','B2'];
        return view('Admin::Personnels.Ajout',compact('fonction','hierachie'));
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
    public function update(Request $request,$id)
    {
        $request->validate([
            'matricule'=>[
                'required',
                Rule::unique('personnels')->ignore($id)
            ],
            'nom'=>'required',
            'prenom'=>'required',
            'telephone'=>'required|unique:personnels',
            'fonction'=>'required',
            'hierachie'=>'required'

        ]);

        $personnel=Personnel::findOrFail($id);
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


    public function modif ($id) {
    $fonction=Fonction::where('delete',0)->get();
    $personnel=Personnel::findOrFail($id);
    $hierachie=['A1','A2','B1','B2'];
        return view('Admin::Personnels.Modif',compact("personnel","fonction","hierachie"));
    }

    public function voir () {
        return view('Admin::Personnels.Voir');
    }

    public function corbeille () {
        $personnel=Personnel::where('delete',1)->orderBy('id','desc')->get();
        return view ('Admin::Personnels.Corbeille',compact('personnel'));
    }

    public function delete($id)
    {
        $personnel=Personnel::findOrFail($id);
        $personnel->delete=1;
        $personnel->update();
        toastr()->success('personnel Supprimez avec Succes');
        return to_route('personnels.liste');
    }
    public function restaure($id)
    {
        $personnel=Personnel::findOrFail($id);
        $personnel->delete=0;
        $personnel->update();
        toastr()->success('personnel restaurez avec Succes');
        return to_route('personnels.liste');
    }
}
