<?php

namespace App\Admin\Controllers\Personnels;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Fonction;
use App\Models\Personnel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Models\Historique;
use Carbon\Carbon;

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
            'matricule' => ['required', 'unique:personnels', 'regex:/^\d{6}[A-Za-z]$/'],
            'nom' => ['required', 'regex:/^[A-Za-z]+$/'],
            'prenom' => ['required', 'regex:/^[A-Za-z]+( [0-9])?$/'],
            'telephone' => ['required', 'unique:personnels', 'regex:/^\d+$/'],
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
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'personnel',
                'annee_id'=>$annee->id,
               'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
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
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'personnel',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
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
        $personnel = Personnel::where('delete', 0)->orderBy('id', 'desc')->get();
        if(count($personnel)!=0)
        {
            $annee = Annee::where('active', 1)->firstOrFail();
        $pdf = Pdf::loadView('Admin::Personnels.Imprimer', compact('personnel', 'annee'));
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'personnel',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        return $pdf->stream('personnels.pdf'); 
        }
        return back();
    }

    public function corbeille () {
        $personnel=Personnel::where('delete',1)->orderBy('id','desc')->paginate(10);
        return view ('Admin::Personnels.Corbeille',compact('personnel'));
    }

    public function delete($uuid)
    {
        $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
        $personnel->delete=1;
        $personnel->update();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Supprimer',
                'activite'=>'personnel',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        toastr()->success('personnel Supprimez avec Succes');
        return to_route('personnels.liste');
    }
    public function restaure($uuid)
    {
        $personnel=Personnel::where('uuid',$uuid)->firstOrFail();
        $personnel->delete=0;
        $personnel->update();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Restaurer',
                'activite'=>'personnel',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        toastr()->success('personnel restaurez avec Succes');
        return to_route('personnels.liste');
    }
}
