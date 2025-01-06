<?php

namespace App\Admin\Controllers\Personnels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonnelsController extends Controller
{
    public function index () {
        return view('Admin::Personnels.Liste');
    }

    public function ajout () {
        return view('Admin::Personnels.Ajout');
    }

    public function modif () {
        return view('Admin::Personnels.Modif');
    }

    public function voir () {
        return view('Admin::Personnels.Voir');
    }
}
