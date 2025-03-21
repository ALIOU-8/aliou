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
        $Utilisateur = User::paginate(10);
        return view('Admin::Parametre.Utilisateur.Liste',compact('Utilisateur'));
    }

    public function recherche(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $Utilisateur=User::where(function ($q) use ($search) {
                $q->where('matricule', 'LIKE', "%{$search}%")
                ->orwhere('nom', 'LIKE', "%{$search}%")
                ->orwhere('prenom', 'LIKE', "%{$search}%")
                ->orwhere('telephone', 'LIKE', "%{$search}%")
                ->orwhere('email', 'LIKE', "%{$search}%")
                ->orwhere('droit', 'LIKE', "%{$search}%")
                ;
            })->paginate(10);
        }
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
            'password'=>'required|min:6|confirmed',
            'telephone'=>'required|unique:users|min:9',
            'email' => 'required|email|unique:users'
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
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->password =  bcrypt($request->password);
        $user->save();
        toastr()->success("Utilisateur ajouté avec succès !");
        return redirect()->route('parametre.user')->with('success','Utilisateur ajouté avec succès');
    }

    public function modif_user(string $uuid){
        $droit=['admin','cfu','tpu','licence','patente'];
        $user = User::where('uuid',$uuid)->first();
        return view('Admin::Parametre.Utilisateur.Modif',compact('user','droit'));
    }

    public function modification(Request $request, string $uuid){
        $request->validate([
            'matricule'=>[
                'required',
                Rule::unique('users','matricule')->ignore($uuid,'uuid')
            ],
            'nom'=>'required',
            'prenom'=>'required',
            'droit'=>'required',
            'password'=>'required|min:6|confirmed',
            'email'=>[
                'required',
                Rule::unique('users','email')->ignore($uuid,'uuid')
            ],
            'telephone'=>[
                'required',
                Rule::unique('users','telephone')->ignore($uuid,'uuid')
            ]
        ]);
        $user = User::where('uuid',$uuid)->first();
        $matricule = Personnel::where('matricule',$request->matricule)->first();
        if($matricule == []){
            toastr()->error("Ce matricule n'appartient à aucun personnel");
            return back();
        }
        $user->matricule = $request->matricule;
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->droit = $request->droit;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->password =  bcrypt($request->password);
        $user->update();
        toastr()->success("Utilisateur modifié avec succès !");
        return redirect()->route('parametre.user');
    }

    public function bloquer (string $uuid){
        $user = User::where('uuid',$uuid)->first();
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
