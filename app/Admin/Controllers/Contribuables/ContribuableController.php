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
        ->with('bien') // Charge les biens associés
        ->orderBy('id', 'desc')
        ->get();    
        return view('Admin::Contribuables.Liste',compact('contribuables'));
    }
    public function search(Request $request)
    {
        $query=$request->get('query');
        $contribuables=Contribuable::where('delete',0)->where(
            function($q) use ($query)
            {
                $q->where('nom','like',"%$query%")
                ->orWhere('prenom','like',"%$query%")
                ->orWhere('telephone','like',"%$query%")
                ->orWhere('profession','like',"%$query%");
                
            }
        )->get();
        return response()->json($contribuables);
    }
    public function ajout () {
        return view('Admin::Contribuables.Ajout');
    }

    public function modif (string $id) {
        $contribuables = Contribuable::FindOrFail($id);
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'telephone' => [
                'required',
                'numeric',
                Rule::unique('contribuables')->ignore($id), // Exclure l'ID actuel
            ],
            'profession' => 'required',
        ]);

            $contribuable = Contribuable::findOrFail($id);
            $contribuable->nom = $request->nom;
            $contribuable->prenom = $request->prenom;
            $contribuable->telephone = $request->telephone;
            $contribuable->profession = $request->profession;
            $contribuable->update();

            toastr()->success('Contribuable modifié avec succès');
            return to_route('contribuables.liste');
     }

    public function delete(string $id)
    {
        $contribuable=Contribuable::findOrFail($id);
        $contribuable->delete=1;
        $contribuable->update();
        toastr()->success('Contribuable Supprimez avec Succes');
        return to_route('contribuables.liste');
    }
    public function restaure (string $id)
    {
        $contribuable=Contribuable::findOrFail($id);
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
