<?php

namespace App\Auth\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ForgetPasswordMail;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login () {
        return view('Auth::login');
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
        $droit=['admin','cfu','tpu','patente'];
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
        $droit=['admin','cfu','tpu','patente'];
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
            'email'=>'required',
            'password'=>'required'
        ]);
        $user = User::where('email', $request->email)->first();         
        if($user){
            $droitUser = $user->droit;
            if($user->statut==0)
                {
                    if(Auth::attempt($credits)){
                        if($droitUser === 'admin'){
                            toastr()->success('Bienvenue à vous '.$user->nom);
                            return redirect()->route('dashboard');
                        }elseif($droitUser === 'cfu'){
                            toastr()->success('Bienvenue à vous '.$user->nom);
                            return redirect()->route('dashboard.cfu');
                        }elseif($droitUser === 'tpu'){
                            toastr()->success('Bienvenue à vous '.$user->nom);
                            return redirect()->route('dashboard.tpu');
                        }elseif($droitUser ==='patente'){   
                            toastr()->success('Bienvenue à vous '.$user->nom);
                            return redirect()->route('dashboard.patente');
                        }else{
                            toastr()->error('Identifiant incorrect');
                            return back();
                        }
                }else{
                    toastr()->error('Identifiant incorrect');
                    return back();
                }
                }else{
                    toastr()->error('Votre compte a été désactivé contactez l\'administrateur');
                     return back();
                }
        }else{
            toastr()->error('pas de compte pour ces identifiants');
            return back();
        }
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    //Mot de passe oublié 

    public function forget(){
        return view('Auth::forget');
    }

    public function verification(Request $request){
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if(!$user){
            toastr()->error('Email non trouvé');
            return back();
        }
        $otp = rand(min: 0000000, max: 999999);
        // $message = "Votre code de verificacion est :".$otp;
        toastr()->info("Un code de vérification a été envoyé à votre email.");
        // toastr("$message");
        // Mettre l'otp et le numéro de téléphone en session 
        session()->put('otp', $otp);
        session()->put('email', $request->email);
        // Envoyer un mail à cet email avec l'otp
        Mail::to($request->email)->send(new ForgetPasswordMail($otp));
        return redirect()->route('auth.otp');
        
    }

    public function otp(){
        // Vérifier si la session est active
        if(session()->get('otp')){
            return view('Auth::otp');
        }else{
            toastr()->error('Veuillez générer un nouveau code');
            return redirect()->route('auth.forget');
        }
    }

    public function confirm_otp(Request $request){
        // Recuperer l'otp de la session 160322
        $request->validate([
            'otp' => 'required|numeric'
        ]);
        $otp = session()->get('otp');
        if($otp != $request->otp){
            toastr()->error('Code incorrect');
            return back();
        }
        return redirect()->route('auth.mdp');
    }

    public function mdp(){
        return view('Auth::mdp');
    }

    public function mdp_update(Request $request){
        request()->validate([
            'password'=>'required|confirmed|min:6'
        ]);
        $email = session()->get('email');
        $user = User::where('email', $email)->first();
        $user->password =  bcrypt($request->password);
        $user->update();
        toastr()->success('Mot de passe modifié');
        return redirect()->route('login');
    }

}
