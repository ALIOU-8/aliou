<?php

namespace App\Admin\Controllers\Biens;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Contribuable;
use App\Models\Historique;
use App\Models\Impot;
use App\Models\TypeBien;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiensController extends Controller
{
    public function index () {
        $bien=Bien::where('delete',0)->orderBy('id','desc')->paginate(10);
        return view('Admin::Biens.Liste',compact('bien'));
    }

    public function ajout () {
        $contribuable=Contribuable::where('delete',0)->get();
        $typeBien=TypeBien::where('status',0)->get();
        return view('Admin::Biens.Ajout',compact('contribuable','typeBien'));
    }

    public function store(Request $request) {
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
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success("Le bien $numero_bien a été ajouter avec succes.");
        return to_route("biens.liste");
    }
    
    public function update(Request $request, $uuid)
    {
    // Récupérer le bien à modifier
    $bien = Bien::where('uuid',$uuid)->firstOrFail();

    // Validation des données
    $request->validate([
        'contribuable_id' => 'required',
        'type_bien_id' => 'required',
        'libelle' => 'required',
        'adresse' => 'required',
    ]);

    // Vérifier si le type de bien a changé
    if ($request->type_bien_id != $bien->type_bien_id) {
        // Générer un nouveau numéro de bien
        $typeBien = TypeBien::findOrFail($request->type_bien_id)->libelle;
        $prefix = strtoupper(substr($typeBien, 0, 4));

        $lastBien = Bien::where('type_bien_id', $request->type_bien_id)
            ->latest('id')
            ->lockForUpdate()
            ->first();

        $nextNumber = $lastBien ? intval(substr($lastBien->numero_bien, 4)) + 1 : 1;
        $numero_bien = $prefix . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);

        // Vérification d'unicité
        if (Bien::where('numero_bien', $numero_bien)->exists()) {
            toastr()->error("Le numéro $numero_bien existe déjà.");
            return back();
        }

        // Mise à jour du bien avec un nouveau numéro
        $bien->contribuable_id=$request->contribuable_id;
        $bien->type_bien_id=$request->type_bien_id;
        $bien->libelle=$request->libelle;
        $bien->adresse=$request->adresse;
        $bien->numero_bien=$numero_bien;
        $bien->update();
        } else {
        // Mise à jour sans changer le numéro de bien
            $bien->contribuable_id=$request->contribuable_id;
            $bien->type_bien_id=$request->type_bien_id;
            $bien->libelle=$request->libelle;
            $bien->adresse=$request->adresse;
            $bien->update();
    }
    $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
               'date'=>date('d:M:Y:H:i:s')
            ]
            );
    toastr()->success("Bien mis à jour avec succès !");
    return redirect()->route('biens.liste');
    }


    public function recherche(Request $request)
    {
    $query = Bien::where('delete', 0); // Filtre les biens non supprimés

    // Vérifier s'il y a une requête de recherche
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            // Recherche dans les colonnes des biens
            $q->where('libelle', 'LIKE', "%{$search}%")
              ->orWhere('adresse', 'LIKE', "%{$search}%")
              ->orWhere('numero_bien', 'LIKE', "%{$search}%")
              // Recherche dans les relations
              ->orWhereHas('contribuable', function ($q) use ($search) {
                  $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('typeBien', function ($q) use ($search) {
                  $q->where('libelle', 'LIKE', "%{$search}%");
              });
        });
    }

    // Exécution de la recherche et pagination
    $bien = $query->with(['contribuable', 'typeBien']) // Charger les relations
                   ->paginate(10); // Pagination avec 10 résultats par page

    return view('Admin::Biens.Liste', compact('bien'));
    }


    public function recherche_corbeille(Request $request)
    {
    $query = Bien::where('delete', 1); // Filtre les biens non supprimés

    // Vérifier s'il y a une requête de recherche
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            // Recherche dans les colonnes des biens
            $q->where('libelle', 'LIKE', "%{$search}%")
              ->orWhere('adresse', 'LIKE', "%{$search}%")
              ->orWhere('numero_bien', 'LIKE', "%{$search}%")
              // Recherche dans les relations
              ->orWhereHas('contribuable', function ($q) use ($search) {
                  $q->where('nom', 'LIKE', "%{$search}%")
                    ->orWhere('prenom', 'LIKE', "%{$search}%")
                    ->orWhere('telephone', 'LIKE', "%{$search}%");
              })
              ->orWhereHas('typeBien', function ($q) use ($search) {
                  $q->where('libelle', 'LIKE', "%{$search}%");
              });
        });
    }

    // Exécution de la recherche et pagination
    $bien = $query->with(['contribuable', 'typeBien']) // Charger les relations
                   ->paginate(10); // Pagination avec 10 résultats par page

    return view('Admin::Biens.Corbeille', compact('bien'));
    }

    public function modif ($uuid) {
        $contribuable=Contribuable::where('delete',0)->get();
        $typeBien=TypeBien::where('status',0)->get();
        $bien=Bien::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Biens.Modif',compact('bien','contribuable','typeBien'));
    }

    public function imprimer()
    {
        $bien=Bien::where('delete',0)->orderBy('id','desc')->get();
        $annee = Annee::where('active', 1)->firstOrFail();
        $pdf = Pdf::loadView('Admin::Biens.imprimer', compact('bien', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        return $pdf->stream('bien.pdf'); 
    }

    public function voir ($uuid) {
        $biens=Bien::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Biens.Voir',compact('biens'));
    }

    public function corbeille() {
        $bien=Bien::where('delete',1)->orderBy('id','desc')->paginate(10);
        return view('Admin::Biens.Corbeille',compact('bien'));
    }
    public function delete($uuid) {
        $bien=Bien::where('uuid',$uuid)->firstOrFail();
        $bien->delete=1;
        $bien->update();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'supprimer',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Bien Supprimez avec Succes');
        return to_route('biens.liste');

    }
    public function restaure($uuid) {
        $bien=Bien::where('uuid',$uuid)->firstOrFail();
        $bien->delete=0;
        $bien->update();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'restorer',
                'activite'=>'Bien',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        toastr()->success('Bien Supprimez avec Succes');
        return to_route('biens.liste');

    }


    public function getContribuable(Request $request) {
        $contribuable = Contribuable::find($request->id);

        if ($contribuable) {
            return response()->json([
                'success' => true,
                'contribuable' => [
                    'nom' => $contribuable->nom,
                    'prenom' => $contribuable->prenom
                ]
            ]);
        }

        return response()->json(['success' => false]);
    }

    // Imprimer la liste des biens recencés
    public function imprimerBR()
    {
        $annee = Annee::where('active', 1)->firstOrFail();
        $bien=Bien::where('delete',0)->where('annee_id', $annee->id)->orderBy('id','desc')
                    ->with(['recensementCfu','recensementTpu','recensementLicence','recensementPatente'])
                    ->whereHas('recensementCfu')
                    ->orwhereHas('recensementTpu')
                    ->orwhereHas('recensementLicence')
                    ->orwhereHas('recensementPatente')
                    ->get();
        $pdf = Pdf::loadView('Admin::Biens.imprimerBR', compact('bien', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Biens Recensés',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        return $pdf->stream('bien.pdf'); 
    }

     // Imprimer la liste des biens non recencés
     public function imprimerBNR()
     {
         $annee = Annee::where('active', 1)->firstOrFail();
         $bien=Bien::where('delete',0)->where('annee_id', $annee->id)->orderBy('id','desc')
                     ->whereDoesntHave('recensementCfu')
                     ->whereDoesntHave('recensementTpu')
                     ->whereDoesntHave('recensementLicence')
                     ->whereDoesntHave('recensementPatente')
                     ->get();
         $pdf = Pdf::loadView('Admin::Biens.imprimerBR', compact('bien', 'annee'));
         $annee=Annee::where('active',1)->first();
         Historique::create(
             [
                 'user_id'=>Auth::user()->id,
                 'action'=>'Imprimer',
                 'activite'=>'Biens Recensés',
                 'annee_id'=>$annee->id,
                 'date'=>date('d:M:Y:H:i:s')
             ]
             );
         return $pdf->stream('bien.pdf'); 
     }

    // Imprimer la liste des biens imposés
    public function imprimerBI()
    {
        $annee = Annee::where('active', 1)->firstOrFail();
        $bienIm=Impot::where('annee_id', $annee->id)->orderBy('id','desc')
                    ->with(['recensement_cfu','recensement_tpu','recensement_licence','recensement_patente','bien'])
                    ->get();
        $pdf = Pdf::loadView('Admin::Biens.imprimerBI', compact('bienIm', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Biens Recensés',
                'annee_id'=>$annee->id,
                'date'=>date('d:M:Y:H:i:s')
            ]
            );
        return $pdf->stream('bien.pdf'); 
    }

}
