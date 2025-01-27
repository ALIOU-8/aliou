<?php

namespace App\Admin\Controllers\Parametre;

use App\Http\Controllers\Controller;
use App\Models\TypeBien;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    // Paramètre 
    public function index() {
        return view('Admin::Parametre.Index');
    }

    // Utilisateur 
    public function user(){
        return view('Admin::Parametre.Utilisateur.Liste');
    }

    public function add_user(){
        return view('Admin::Parametre.Utilisateur.Ajout');
    }

    public function modif_user(string $id){
        return view('Admin::Parametre.Utilisateur.Modif');
    }

    public function corbeille_user(){
        return view('Admin::Parametre.Utilisateur.Corbeille');
    }

    // Configuration 
    public function configuration(){
        return view('Admin::Parametre.Configuration.Index');
    }
  
    // Biens 
    public function type_bien () {
        $liste_type_bien= TypeBien::where('status',0)->get();
        return view('Admin::Parametre.Configuration.TypeBien.Type',compact('liste_type_bien'));
    }
    public function type_bien_store(Request $request)
    {
        $request->validate([
            'libelle'=>'required|unique:type_biens'
        ]);
        $type_bien=new TypeBien();
        $type_bien->libelle=$request->libelle;
        $type_bien->save();
        toastr()->success("Type bien enregistrer avec success");
        return back();
    }

    public function type_bien_update(Request $request,$id)
    {
        $request->validate([
            'libelle'=>'required'
        ]);
        $type_bien=TypeBien::findOrfail($id);
        $type_bien->libelle=$request->libelle;
        $type_bien->update();
        toastr()->success("Type bien modifier avec success");
        return  back();
    }
    public function type_bien_edit($id)
    {
        $type_bien=TypeBien::findOrfail($id);
        $liste_type_bien= TypeBien::where('status',0)->get();
       return view('Admin::Parametre.Configuration.TypeBien.Type',compact('type_bien','liste_type_bien'));
    }

    public function corbeille_bien () {
        return view('Admin::Parametre.Configuration.TypeBien.Corbeille');
    }
  
    // Fonction 
    public function fonction () {
        return view('Admin::Parametre.Configuration.Fonction.Index');
    }

    public function corbeille_fonction () {
        return view('Admin::Parametre.Configuration.Fonction.Corbeille');
    }
    
    // Impot 
    public function type_impot () {
        return view('Admin::Parametre.Configuration.TypeImpot.Index');
    }

    public function corbeille_impot () {
        return view('Admin::Parametre.Configuration.TypeImpot.Corbeille');
    }
  
    // Recensement 
    public function recensement () {
        return view('Admin::Parametre.Configuration.Recensement.Index');
    }

    public function corbeille_recensement () {
        return view('Admin::Parametre.Configuration.Recensement.Corbeille');
    }
    
}
