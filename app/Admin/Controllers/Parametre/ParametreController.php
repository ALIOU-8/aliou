<?php

namespace App\Admin\Controllers\Parametre;

use Carbon\Carbon;
use App\Models\Bien;
use App\Models\Annee;
use App\Models\Impot;
use App\Models\Fonction;
use App\Models\TypeBien;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\Personnel;

class ParametreController extends Controller
{
    // Paramètre 
    public function index() {
        return view('Admin::Parametre.Index');
    }
    //compatabilite

    public function comptabilite()
    {
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $sommeTotalRecouvrer=Impot::orderBy('id','desc')->where('annee_id',$anneeActive->id)->where('statut','Payé')->sum('montant_a_payer');
        $sommeTotalRecenser=Impot::orderBy('id','desc')->where('annee_id',$anneeActive->id)->sum('montant_a_payer');
        $impot = Impot::orderBy('id','asc')->where('annee_id',$anneeActive->id)->with('paiement')->paginate(10);
        return view('Admin::Parametre.comptabilite.index',compact('sommeTotalRecenser','sommeTotalRecouvrer','impot'));
    }
    // Configuration 
    public function configuration(){
        $anneeActive=Annee::where('active',1)->firstOrFail();
        $historique=Historique::where('annee_id',$anneeActive->id)->orderBy('id','desc')->paginate(10);
        return view('Admin::Parametre.Configuration.Index',compact('historique'));
    }
  
    // typeBiens 
    public function type_bien() {
        $liste_type_bien= TypeBien::where('status',0)->Orderby('id','Desc')->paginate(10);
        return view('Admin::Parametre.Configuration.TypeBien.Type',compact('liste_type_bien'));
    }

    public function recherche_type_bien(Request $request)
    {
        $query = TypeBien::where('status', 0); // Filtre les fonctions non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('libelle', 'LIKE', "%{$search}%");
            });
        }
            $liste_type_bien = $query->paginate(10);
            return view('Admin::Parametre.Configuration.TypeBien.Type',compact('liste_type_bien'));
    }

    public function recherche_type_bien_corbeille(Request $request)
    {
        $query = TypeBien::where('status', 1); // Filtre les fonctions non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('libelle', 'LIKE', "%{$search}%");
            });
        }
            $type_bien = $query->paginate(10);
            return view('Admin::Parametre.Configuration.TypeBien.Corbeille',compact('type_bien'));
    }
    public function type_bien_store(Request $request)
    {
        $request->validate([
            'libelle'=>'required|unique:type_biens'
        ]);
        $type_bien=new TypeBien();
        $type_bien->libelle=strtoupper($request->libelle);
        $type_bien->save();
        toastr()->success("Type bien enregistrer avec success");
        return back();
    }

    public function type_bien_update(Request $request,$uuid)
    {
        $request->validate([
            'libelle' => [
                'required',
                Rule::unique('type_biens','libelle')->ignore($uuid,'uuid'), // Exclure l'ID actuel
            ],
        ]);
        $type_bien=TypeBien::where('uuid',$uuid)->firstOrFail();
        $type_bien->libelle=strtoupper($request->libelle);
        $type_bien->update();
        toastr()->success("Type bien modifier avec success");
        return  to_route('parametre.configuration.type.biens');
    }
    public function type_bien_edit($uuid)
    {
        $type_bien=TypeBien::where('uuid',$uuid)->firstOrFail();
        $liste_type_bien= TypeBien::where('status',0)->paginate(10);
       return view('Admin::Parametre.Configuration.TypeBien.Type',compact('type_bien','liste_type_bien'));
    }

    public function corbeille_bien() {
    $type_bien= TypeBien::where('status',1)->Orderby('id','Desc')->paginate(10);;
        return view('Admin::Parametre.Configuration.typebien.Corbeille',compact('type_bien'));
    }

    public function delete_type_bien($uuid)
    {
        $type_bien=TypeBien::where('uuid',$uuid)->firstOrFail();
        ///verifier si le type bien est utilisé
        $verifType=Bien::where('type_bien_id',$type_bien->id)->first();
        if($verifType)
        {
            toastr()->warning('Impossible de supprimer un type de bien utilsé');
            return back();
        }
        $type_bien->status=1;
        $type_bien->update();
        toastr()->success('Type bien Supprimez avec Succes');
        return to_route('parametre.configuration.type.biens');
    }
    public function restaure_type_bien($uuid)
    {
        $type_bien=TypeBien::where('uuid',$uuid)->firstOrFail();
        $type_bien->status=0;
        $type_bien->update();
        toastr()->success('Type bien restaurez avec Succes');
        return to_route('parametre.configuration.type.biens');
    }

  
    // Fonction 
    public function fonction () {
        $liste_fonction=Fonction::where('delete',0)->Orderby('id','Desc')->paginate(10);
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
        $fonction->libelle=strtoupper($request->libelle);
        $fonction->save();
        toastr()->success("Fonction Ajoutée avec succes");
        return back();
    }
    public function fonction_update(Request $request,$uuid)
    {
        $request->validate(
            [
                'libelle' => [
                'required',
                Rule::unique('fonctions','libelle')->ignore($uuid,'uuid'), // Exclure l'ID actuel
            ],
            ]
        );
        $fonction=Fonction::where('uuid',$uuid)->firstOrFail();
        $fonction->libelle=strtoupper($request->libelle);
        $fonction->update();
        toastr()->success("Fonction modifiée avec succes");
        return to_route('parametre.configuration.fonction');
    }
    public function fonction_edit($uuid)
    {
        $fonction=Fonction::where('uuid',$uuid)->firstOrFail();
        $liste_fonction= Fonction::where('delete',0)->paginate(10);
       return view('Admin::Parametre.Configuration.Fonction.Index',compact('fonction','liste_fonction'));
    }

    public function corbeille_fonction () {
        $fonction= Fonction::where('delete',1)->paginate(10);
        return view('Admin::Parametre.Configuration.Fonction.Corbeille',compact('fonction'));
    }

    public function delete(string $uuid)
    {
        $fonction=Fonction::where('uuid',$uuid)->firstOrFail();
        ///verifier si le type bien est utilisé
        $fonctionVerif=Personnel::where('fonction_id',$fonction->id)->first();
        if($fonctionVerif)
        {
            toastr()->warning('Impossible de supprimer une foncton  utilsée');
            return back();
        }
        $fonction->delete=1;
        $fonction->update();
        toastr()->success('Fonction Supprimez avec Succes');
        return to_route('parametre.configuration.fonction');
    }
    public function restaure (string $uuid)
    {
        $fonction=Fonction::where('uuid',$uuid)->firstOrFail();
        $fonction->delete=0;
        $fonction->update();
        toastr()->success('Fonction restaurez avec Succes');
        return back();
    }

    public function restaurer () {
        $fonctions = Fonction::where('delete',1)->Orderby('id','Desc')->get();
        return view('Admin::Parametre.Configuration.Fonction.Corbeille',compact('fonctions'));
    }

    public function recherche(Request $request)
    {
        $query = Fonction::where('delete', 0); // Filtre les fonctions non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('libelle', 'LIKE', "%{$search}%");
            });
        }
            $liste_fonction = $query->paginate(10);
         return view('Admin::Parametre.Configuration.Fonction.Index',compact('liste_fonction'));
    }

    public function recherche_corbeille(Request $request)
    {
        $query = Fonction::where('delete', 1); // Filtre les fonctions non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('libelle', 'LIKE', "%{$search}%");
            });
        }
            $fonction = $query->paginate(10);
         return view('Admin::Parametre.Configuration.Fonction.corbeille',compact('fonction'));
    }

    // Annee 
    
    public function annee () {
        $annees = Annee::orderBy('libelle', 'desc')->paginate(10);
        return view('Admin::Parametre.Configuration.Annee.Index',compact('annees'));
    }
    public function recherche_annee(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $annees=Annee::where(function ($q) use ($search) {
                $q->where('annee', 'LIKE', "%{$search}%")
                ->orwhere('Date_debut')
                ->orwhere('Date_fin');
            })->paginate(10);
        }
        return view('Admin::Parametre.Configuration.Annee.Index',compact('annees'));
    }
    public function annee_store(Request $request)
    {
        $anneeActuelle = Carbon::now()->year; // Récupère l'année actuelle (ex : 2025) 
        ////'annee' => "required|integer|min:2025|max:$anneeActuelle",
        $request->validate([
            'annee' => "required|integer|min:2025",
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);
        $annee = $request->annee;

        // Tes dates sont bien au format Y-m-d, donc on parse correctement :
        $debut = Carbon::createFromFormat('Y-m-d', $request->date_debut);
        $fin = Carbon::createFromFormat('Y-m-d', $request->date_fin);

        // Début et fin d'année à comparer
        $debutAnnee = Carbon::createFromDate($annee, 1, 1)->startOfDay();
        $finAnnee = Carbon::createFromDate($annee, 12, 31)->endOfDay();

        if ($debut->lt($debutAnnee) || $debut->gt($finAnnee)) {
            toastr()->error("La date de début doit être comprise dans l'année $annee.");
            return back();
        }

        if ($fin->lt($debutAnnee) || $fin->gt($finAnnee)) {
            toastr()->error("La date de fin doit être comprise dans l'année $annee.");
            return back();
        }


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


    public function annee_update(Request $request,$uuid)
    {
        $request->validate(
            [
                'annee' => [
                'required',
                'integer',
                'min:2025',
                Rule::unique('annees','annee')->ignore($uuid,'uuid'), // Exclure l'ID actuel
            ],
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            ]
        );
        $annee = $request->annee;

        // Tes dates sont bien au format Y-m-d, donc on parse correctement :
        $debut = Carbon::createFromFormat('Y-m-d', $request->date_debut);
        $fin = Carbon::createFromFormat('Y-m-d', $request->date_fin);

        // Début et fin d'année à comparer
        $debutAnnee = Carbon::createFromDate($annee, 1, 1)->startOfDay();
        $finAnnee = Carbon::createFromDate($annee, 12, 31)->endOfDay();

        if ($debut->lt($debutAnnee) || $debut->gt($finAnnee)) {
            toastr()->error("La date de début doit être comprise dans l'année $annee.");
            return back();
        }

        if ($fin->lt($debutAnnee) || $fin->gt($finAnnee)) {
            toastr()->error("La date de fin doit être comprise dans l'année $annee.");
            return back();
        }

        if($request->date_debut > $request->date_fin )
        {
            toastr()->error('La date debut doit être inférieur a la date de fin');
            return back();
        }else{
            $annee=Annee::where('uuid',$uuid)->firstOrFail();
            $annee->annee=$request->annee;
            $annee->Date_debut=$request->date_debut;
            $annee->Date_fin=$request->date_fin;
            $annee->update();
            toastr()->success("L'année Modifer avec succes");
            return to_route('parametre.configuration.annee');
        }
        
    }

    public function annee_edit($uuid)
    {
        $annee=Annee::where('uuid',$uuid)->firstOrFail();
        $annees = Annee::orderBy('libelle', 'desc')->paginate(10);
       return view('Admin::Parametre.Configuration.Annee.Index',compact('annee','annees'));
    }

    public function activer($uuid)
    {
        // Désactiver toutes les autres années
        Annee::query()->update(['active' => 0]);
        // Activer l'année sélectionnée
        Annee::where('uuid', $uuid)->update(['active' => 1]);
        $annee=Annee::where('uuid',$uuid)->firstOrFail();
        toastr()->success("Année $annee->annee activée avec succes");
        return back();
    }

    
}
