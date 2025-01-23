<?php

namespace App\Admin\Controllers\Parametre;

use App\Http\Controllers\Controller;
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
        return view('Admin::Parametre.Configuration.TypeBien.Type');
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
