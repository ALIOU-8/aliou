<?php

namespace App\Admin\Controllers\Parametre;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Fonction;
use App\Models\TypeBien;
use App\Models\TypeImpot;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
  
    // typeBiens 
    public function type_bien() {
        $liste_type_bien= TypeBien::where('status',0)->Orderby('id','Desc')->get();
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
            'libelle' => [
                'required',
                Rule::unique('type_biens')->ignore($id), // Exclure l'ID actuel
            ],
        ]);
        $type_bien=TypeBien::findOrfail($id);
        $type_bien->libelle=$request->libelle;
        $type_bien->update();
        toastr()->success("Type bien modifier avec success");
        return  to_route('parametre.configuration.type.biens');
    }
    public function type_bien_edit($id)
    {
        $type_bien=TypeBien::findOrfail($id);
        $liste_type_bien= TypeBien::where('status',0)->get();
       return view('Admin::Parametre.Configuration.TypeBien.Type',compact('type_bien','liste_type_bien'));
    }

    public function corbeille_bien() {
    $type_bien= TypeBien::where('status',1)->Orderby('id','Desc')->get();;
        return view('Admin::Parametre.Configuration.typebien.Corbeille',compact('type_bien'));
    }

    public function delete_type_bien($id)
    {
        $type_bien=TypeBien::findOrFail($id);
        $type_bien->status=1;
        $type_bien->update();
        toastr()->success('Type bien Supprimez avec Succes');
        return to_route('parametre.configuration.type.biens');
    }
    public function restaure_type_bien($id)
    {
        $type_bien=TypeBien::findOrFail($id);
        $type_bien->status=0;
        $type_bien->update();
        toastr()->success('Type bien restaurez avec Succes');
        return to_route('parametre.configuration.type.biens');
    }

  
    // Fonction 
    public function fonction () {
        $liste_fonction=Fonction::where('delete',0)->Orderby('id','Desc')->get();
        return view('Admin::Parametre.Configuration.Fonction.Index',compact('liste_fonction'));
    }

    public function fonction_store(Request $request)
    {
        $request->validate(
            [
                "libelle" =>"required|unique:fonctions"
            ]
        );
        $fonction=new Fonction();
        $fonction->libelle=$request->libelle;
        $fonction->save();
        toastr()->success("Fonction Ajoutée avec succes");
        return back();
    }
    public function fonction_update(Request $request,$id)
    {
        $request->validate(
            [
                'libelle' => [
                'required',
                Rule::unique('fonctions')->ignore($id), // Exclure l'ID actuel
            ],
            ]
        );
        $fonction=Fonction::findOrFail($id);
        $fonction->libelle=$request->libelle;
        $fonction->update();
        toastr()->success("Fonction modifiée avec succes");
        return to_route('parametre.configuration.fonction');
    }
    public function fonction_edit($id)
    {
        $fonction=Fonction::findOrfail($id);
        $liste_fonction= Fonction::where('delete',0)->get();
       return view('Admin::Parametre.Configuration.Fonction.Index',compact('fonction','liste_fonction'));
    }

    public function corbeille_fonction () {
        $fonction= Fonction::where('delete',1)->get();
        return view('Admin::Parametre.Configuration.Fonction.Corbeille',compact('fonction'));
    }

    public function delete(string $id)
    {
        $contribuable=Fonction::findOrFail($id);
        $contribuable->delete=1;
        $contribuable->update();
        toastr()->success('Fonction Supprimez avec Succes');
        return to_route('parametre.configuration.fonction');
    }
    public function restaure (string $id)
    {
        $contribuable=Fonction::findOrFail($id);
        $contribuable->delete=0;
        $contribuable->update();
        toastr()->success('Fonction restaurez avec Succes');
        return back();
    }

    public function restaurer () {
        $contribuables = Fonction::where('delete',1)->Orderby('id','Desc')->get();
        return view('Admin::Parametre.Configuration.Fonction.Corbeille',compact('contribuables'));
    }

    
    // Impot 
    public function type_impot () {
        $liste_type_impot= TypeImpot::where('delete',0)->Orderby('id','Desc')->get();
        return view('Admin::Parametre.Configuration.TypeImpot.Index', compact('liste_type_impot'));
    }


    public function type_impot_store(Request $request)
    {
        $request->validate(
            [
                "libelle" =>"required|unique:type_impots"
            ]
        );
        $type_impot=new TypeImpot();
        $type_impot->libelle=$request->libelle;
        $type_impot->save();
        toastr()->success("Type Impot enregistrer avec succes");
        return back();
    }

    public function type_impot_update(Request $request,$id)
    {
        $request->validate(
            [
                'libelle' => [
                'required',
                Rule::unique('type_impots')->ignore($id), // Exclure l'ID actuel
            ],
            ]
        );
        $type_impot=TypeImpot::findOrFail($id);
        $type_impot->libelle=$request->libelle;
        $type_impot->update();
        toastr()->success("Type impot modifié avec succes");
        return to_route('parametre.configuration.type.impot');
    }

    public function type_impot_edit($id)
    {
        $type_impot=TypeImpot::findOrfail($id);
        $liste_type_impot= TypeImpot::where('delete',0)->get();
       return view('Admin::Parametre.Configuration.TypeImpot.Index',compact('type_impot','liste_type_impot'));
    }

    public function delete_type_impot(string $id)
    {
        $type_impot=TypeImpot::findOrFail($id);
        $type_impot->delete=1;
        $type_impot->update();
        toastr()->success('Type Impot Supprimez avec Succes');
        return to_route('parametre.configuration.type.impot');
    }

    public function restaure_type_impot(string $id)
    {
        $type_impot=TypeImpot::findOrFail($id);
        $type_impot->delete=0;
        $type_impot->update();
        toastr()->success('Type impot restaurez avec Succes');
        return to_route('parametre.configuration.type.impot');
    }

    public function corbeille_impot() {
        $type_impot= TypeImpot::where('delete',1)->Orderby('id','Desc')->get();;
            return view('Admin::Parametre.Configuration.typeimpot.Corbeille',compact('type_impot'));
        }


  
    // Annee 
    
    public function annee () {
        $annees = Annee::orderBy('libelle', 'desc')->get();
        return view('Admin::Parametre.Configuration.Annee.Index',compact('annees'));
    }

    public function annee_store(Request $request)
    {

        $request->validate(
            [
                "annee" =>"required|unique:annees|max:4",
                'date_debut'=>'required',
                'date_fin'=>'required',
            ]
        );
         // Désactiver toutes les autres années
        Annee::query()->update(['active' => 0]);
        if($request->date_debut > $request->date_fin )
        {
            toastr()->error('La date debut doit être inférieur a la date de fin');
            return back();
        }else{
            $annee=new Annee();
            $annee->annee=$request->annee;
            $annee->Date_debut=$request->date_debut;
            $annee->Date_fin=$request->date_fin;
            $annee->active=1;
            $annee->save();
            toastr()->success("L'année $request->annee enregistrer avec succes");
            return back();
        }
        
    }


    public function annee_update(Request $request,$id)
    {
        $request->validate(
            [
                'annee' => ['max:4',
                'required',
                Rule::unique('annees')->ignore($id),
                 // Exclure l'ID actuel
                 'date_debut'=>'required',
                'date_fin'=>'required',
                 
            ],
            ]
        );
        if($request->date_debut > $request->date_fin )
        {
            toastr()->error('La date debut doit être inférieur a la date de fin');
            return back();
        }else{
            $annee=Annee::findOrFail($id);
            $annee->annee=$request->annee;
            $annee->Date_debut=$request->date_debut;
            $annee->Date_fin=$request->date_fin;
            $annee->update();
            toastr()->success("L'année Modifer avec succes");
            return to_route('parametre.configuration.annee');
        }
        
    }

    public function annee_edit($id)
    {
        $annee=Annee::findOrfail($id);
        $annees = Annee::orderBy('libelle', 'desc')->get();
       return view('Admin::Parametre.Configuration.Annee.Index',compact('annee','annees'));
    }

    public function activer($id)
    {
        // Désactiver toutes les autres années
        Annee::query()->update(['active' => 0]);
        // Activer l'année sélectionnée
        Annee::where('id', $id)->update(['active' => 1]);
        $annee=Annee::findOrFail($id);
        toastr()->success("Année $annee->annee activée avec succes");
        return back();
    }

    
}
