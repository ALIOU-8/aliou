<?php

namespace App\Admin\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index () {
        $user = Auth::user();
        return view('Admin::Profil.profil',compact('user'));
    }
}
