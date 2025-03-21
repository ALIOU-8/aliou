<?php

namespace App\Admin\Controllers\Invitation;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use Illuminate\Http\Request;

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
        toastr()->success('invitation modifié avec succes');
        return to_route('parametre.configuration.invitation');

    }

    public function imprimer_invitation (string $uuid) {
        $invitation=Invitation::where('uuid',$uuid)->firstOrFail();
        return view('Admin::Parametre.Configuration.Invitation.Imprimer', compact('invitation'));
    }
}
