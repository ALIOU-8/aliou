<?php

namespace App\Admin\Controllers\Profil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index () {
        return view('Admin::Profil.profil');
    }
}
