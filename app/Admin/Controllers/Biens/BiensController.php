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
    
    public function update(Request $request, $id)
    {
    // Récupérer le bien à modifier
    $bien = Bien::findOrFail($id);

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

    toastr()->success("Bien mis à jour avec succès !");
    return redirect()->route('biens.liste');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $biens = Bien::where('delete', 0)
        ->where(function ($q) use ($query) {
        $q->where('libelle', 'like', "%$query%")
          ->orWhere('adresse', 'like', "%$query%")
          ->orWhere('numero_bien', 'like', "%$query%")
          ->orWhereHas('contribuable', function ($q) use ($query) {
              $q->where('nom', 'like', "%$query%")
                ->orWhere('prenom', 'like', "%$query%");
          })
          ->orWhereHas('typeBien', function ($q) use ($query) {
              $q->where('libelle', 'like', "%$query%");
          });
    })
    ->with(['contribuable','typeBien']) // Charge les relations
    ->get();
    return response()->json($biens);
    }
    



    public function modif ($id) {
        $contribuable=Contribuable::where('delete',0)->get();
        $typeBien=TypeBien::where('status',0)->get();
        $bien=Bien::findOrFail($id);
        return view('Admin::Biens.Modif',compact('bien','contribuable','typeBien'));
    }

    public function voir () {
        return view('Admin::Biens.Voir');
    }

    public function corbeille() {
        $bien=Bien::where('delete',1)->orderBy('id','desc')->get();
        return view('Admin::Biens.Corbeille',compact('bien'));
    }
    public function delete($id) {
        $bien=Bien::findOrFAil($id);
        $bien->delete=1;
        $bien->update();
        toastr()->success('Bien Supprimez avec Succes');
        return to_route('biens.liste');

    }
    public function restaure($id) {
        $bien=Bien::findOrFAil($id);
        $bien->delete=0;
        $bien->update();
        toastr()->success('Bien Supprimez avec Succes');
        return to_route('biens.liste');

    }


    public function getContribuable(Request $request)
    {
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

}
