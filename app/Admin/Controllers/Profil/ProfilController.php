<?php

namespace App\Admin\Controllers\Profil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfilController extends Controller
{
    public function index () {
        $user = Auth::user();
        return view('Admin::Profil.profil',compact('user'));
    }
    public function  change(Request $request, string $uuid)
    {
        $request->validate([
            'image'=>'required|image|max:5120'
        ]);

        $profile=$request->file('image');
        $extension=$profile->getClientOriginalExtension();
        $nomImage=pathinfo($profile->getClientOriginalName(),PATHINFO_FILENAME);
        $monImage=$nomImage.''.'_'.time().'.'.$extension;
        $profile->storeAs('public/profil',$monImage);
        $user=User::where('uuid',$uuid)->firstOrFail();
        $user->image=$monImage;
        $user->update();
        toastr()->success("Profil changer avec succès");
        return back();
    }
    public function modif(Request $request, string $uuid){
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>[
                'required',
                Rule::unique('users','email')->ignore($uuid,'uuid')
            ],
            'telephone'=>[
                'required',
                Rule::unique('users','telephone')->ignore($uuid,'uuid')
            ]           
        ]);
        $user = User::where('uuid',$uuid)->firstOrFail();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->email = $request->email;
        $user->telephone = $request->telephone;
        $user->update();
        toastr()->success("Profil modifié avec succès !");
        return back();
    }

    public function mdp_update (Request $request, string $uuid) {
        //S'assurer que le nouveau mot de passe soit le meme mot de passe de confirmation
        // $idUser = Auth::guard('admin')->user()->id;
        $user1 = User::where('uuid',$uuid)->first();
        $idUser = $user1->id;
        $user =  User::FindOrFail($idUser);
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6', // Vérifie que le nouveau mot de passe est confirmé
        ]);
        
        if(Hash::check($request->old_password, $user->password)){
            $user->password = bcrypt($request->password);
            $user->update();
            toastr()->success('Mot de passe modifié avec succès');
            // Auth::guard('admin')->logout();
            return redirect()->route('login');
        }else{
            toastr()->error('Ancien mot de passe incorrect');
            return back();
        }
    }
}
