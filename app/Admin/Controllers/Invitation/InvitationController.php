<?php

namespace App\Admin\Controllers\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Invitation;
use App\Models\Historique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class InvitationController extends Controller
{
    public function invitation () {
        $invitation=Invitation::paginate(10);
        return view('Admin::Parametre.Configuration.Invitation.Index',compact('invitation'));
    }

    public function recherche(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $invitation=Invitation::where(function ($q) use ($search) {
                $q->where('nom', 'LIKE', "%{$search}%")
                  ->orWhere('prenom', 'LIKE', "%{$search}%")
                  ->orWhere('date_rdv', 'LIKE', "%{$search}%")
                  ->orWhere('motif', 'LIKE', "%{$search}%")
                  ->orWhere('se_munir', 'LIKE', "%{$search}%");
            })->paginate(10);
        }
         return view('Admin::Parametre.Configuration.Invitation.Index',compact('invitation'));
    }

    public function ajout () {
        return view('Admin::Parametre.Configuration.Invitation.Ajout');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'date_rdv'=>'required',
            'motif'=>'required',
            'se_munir'=>'required'
        ]);

        $invitation=new Invitation();
        $invitation->nom=$request->nom;
        $invitation->prenom=$request->prenom;
        $invitation->date_rdv=$request->date_rdv;
        $invitation->motif=$request->motif;
        $invitation->se_munir=$request->se_munir;
        $invitation->save();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Ajout',
                'activite'=>'Invitation',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        toastr()->success('invitation enregistré avec succes');
        return to_route('parametre.configuration.invitation');

    }

    public function modif (string $uuid) {
        $invitation= Invitation::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Parametre.Configuration.Invitation.Modif',compact('invitation'));
    }

    public function update(Request $request,string $uuid)
    {
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'date_rdv'=>'required',
            'motif'=>'required',
            'se_munir'=>'required'
        ]);

        $invitation= Invitation::where('uuid',$uuid)->first();
        $invitation->nom=$request->nom;
        $invitation->prenom=$request->prenom;
        $invitation->date_rdv=$request->date_rdv;
        $invitation->motif=$request->motif;
        $invitation->se_munir=$request->se_munir;
        $invitation->update();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Modifier',
                'activite'=>'Invitation',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        toastr()->success('invitation modifié avec succes');
        return to_route('parametre.configuration.invitation');

    }

    public function imprimer_invitation (string $uuid) {
        $invitation=Invitation::where('uuid',$uuid)->firstOrFail();
        $annee=Annee::where('active',1)->first();
        Historique::create(
            [
                'user_id'=>Auth::user()->id,
                'action'=>'Imprimer',
                'activite'=>'Invitation',
                'annee_id'=>$annee->id,
                'date'=>Carbon::now()->locale('fr')->isoFormat('D MMMM YYYY [à] HH:mm:ss') 
            ]
            );
        $pdf = Pdf::loadView('Admin::Parametre.Configuration.Invitation.Imprimer', compact('invitation','annee'));
        return $pdf->stream('invitation.pdf'); 
    }
}
