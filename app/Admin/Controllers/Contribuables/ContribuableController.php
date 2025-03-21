<?php

namespace App\Admin\Controllers\Contribuables;

use App\Http\Controllers\Controller;
use App\Models\Contribuable;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContribuableController extends Controller
{
    public function index () {
        $contribuables = Contribuable::where('delete', 0)
        ->with('bien')// Charge les biens associés
        ->orderBy('id', 'desc')
        ->paginate(10);    
        return view('Admin::Contribuables.Liste',compact('contribuables'));
    }
    public function recherche(Request $request)
    {
        $query = Contribuable::where('delete', 0); // Filtre les contribuables non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('telephone', 'LIKE', "%{$search}%")
                  ->orWhere('profession', 'LIKE', "%{$search}%");
            });
        }
            $contribuables = $query->paginate(10);
         return view('Admin::Contribuables.Liste', compact('contribuables'));
    }
    public function recherche_corbeille(Request $request)
    {
        $query = Contribuable::where('delete', 1); // Filtre les contribuables non supprimés

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('telephone', 'LIKE', "%{$search}%")
                  ->orWhere('profession', 'LIKE', "%{$search}%");
            });
        }
            $contribuables = $query->paginate(10);
         return view('Admin::Contribuables.Corbeille', compact('contribuables'));
    }
    public function ajout () {
        return view('Admin::Contribuables.Ajout');
    }

    public function modif (string $uuid) {
        $contribuables = Contribuable::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Contribuables.Modif',compact('contribuables'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'telephone'=>'required|numeric|unique:contribuables',
            'profession'=>'required'
        ]);

        $contribuable=new Contribuable();
        $contribuable->nom=$request->nom;
        $contribuable->prenom=$request->prenom;
        $contribuable->telephone=$request->telephone;
        $contribuable->profession=$request->profession;
        $contribuable->save();
        toastr()->success('Contribuable Ajoutez avec Succes');
        return to_route('contribuables.liste');
    }
    public function update(Request $request, string $uuid)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => [
                'required',
                'numeric',
                Rule::unique('contribuables', 'telephone')->ignore($uuid, 'uuid'),
            ],
            'profession' => 'required',
        ]);

            $contribuable = Contribuable::where('uuid',$uuid)->firstOrFail();
            $contribuable->nom = $request->nom;
            $contribuable->prenom = $request->prenom;
            $contribuable->telephone = $request->telephone;
            $contribuable->profession = $request->profession;
            $contribuable->update();

            toastr()->success('Contribuable modifié avec succès');
            return to_route('contribuables.liste');
     }

    public function delete(string $uuid)
    {
        $contribuable=Contribuable::where('uuid',$uuid)->firstOrFail();
        $contribuable->delete=1;
        $contribuable->update();
        toastr()->success('Contribuable Supprimez avec Succes');
        return to_route('contribuables.liste');
    }
    public function restaure (string $uuid)
    {
        $contribuable=Contribuable::where('uuid',$uuid)->firstOrFail();
        $contribuable->delete=0;
        $contribuable->update();
        toastr()->success('Contribuable restaurez avec Succes');
        return back();
    }

    public function restaurer () {
        $contribuables = Contribuable::where('delete',1)->Orderby('id','Desc')->get();
        return view('Admin::Contribuables.Corbeille',compact('contribuables'));
    }
}
