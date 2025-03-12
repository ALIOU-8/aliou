<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login () {
        return view('Auth::layout');
    }

    // Utilisateur 
    public function user(){
        $Utilisateur = User::get();
        return view('Admin::Parametre.Utilisateur.Liste',compact('Utilisateur'));
    }

    public function add_user(){
        $droit=['admin','cfu','tpu','licence','patente'];
        return view('Admin::Parametre.Utilisateur.Ajout',compact('droit'));
    }

    public function inscription(Request $request){
        $request->validate([
            'matricule'=>'required|unique:users',
            'nom'=>'required',
            'prenom'=>'required',
            'droit'=>'required',
            'password'=>'required|min:6|confirmed'
        ]);
        $user = new User();
        $matricule = Personnel::where('matricule',$request->matricule)->first();
        if($matricule == []){
            toastr()->error("Ce matricule n'appartient à aucun personnel");
            return back();
        }
        $user->matricule = $request->matricule;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->droit = $request->droit;
        $user->password =  bcrypt($request->password);
        $user->save();
        toastr()->success("Utilisateur ajouté avec succès !");
        return redirect()->route('parametre.user')->with('success','Utilisateur ajouté avec succès');
    }

    public function modif_user(string $id){
        $droit=['admin','cfu','tpu','licence','patente'];
        $user = User::where('id',$id)->first();
        return view('Admin::Parametre.Utilisateur.Modif',compact('user','droit'));
    }

    public function modification(Request $request, string $id){
        $request->validate([
            'matricule'=>[
                'required',
                Rule::unique('users')->ignore($id)
            ],
            'nom'=>'required',
            'prenom'=>'required',
            'droit'=>'required',
            'password'=>'required|min:6|confirmed'
        ]);
        $user = User::where('id',$id)->first();
        $matricule = Personnel::where('matricule',$request->matricule)->first();
        if($matricule == []){
            toastr()->error("Ce matricule n'appartient à aucun personnel");
            return back();
        }
        $user->matricule = $request->matricule;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->droit = $request->droit;
        $user->password =  bcrypt($request->password);
        $user->update();
        toastr()->success("Utilisateur modifié avec succès !");
        return redirect()->route('parametre.user');
    }

    public function bloquer (string $id){
        $user = User::where('id',$id)->first();
        $message = "";
        if($user->statut == 0) {
            $user->statut = 1;  
            $message = "Utilisateur bloqué avec succès !";
        }
        else {
            $user->statut = 0;   
            $message = "Utilisateur débloqué avec succès !";
        }
        $user->update();
        toastr()->success("$message");
        return redirect()->route('parametre.user');

    }

    public function login_store (Request $request){
        $credits = $request->validate([
            'matricule'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('matricule', $request->matricule)->first();         
        if($user){
            $droitUser = $user->droit;
            if(Auth::attempt($credits)){
                return redirect()->intended('/');
            }else{
                toastr()->error('Identifiant incorrect');
                return back();
            }
        }else{
            toastr()->error('Identifiant incorrect');
            return back();
        }
    }

}
