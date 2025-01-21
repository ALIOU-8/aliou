<?php

namespace App\Admin\Controllers\CFU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CFUController extends Controller
{
    public function index () {
        return view('Admin::CFU.Liste');
    }

    public function ajout () {
        return view('Admin::CFU.Ajout');
    }

    public function modif () {
        return view('Admin::CFU.Modif');
    }

    public function voir () {
        return view('Admin::CFU.Voir');
    }

    public function corbeille () {
        return view('Admin::CFU.Corbeille');
    }

    // public function statistique()  {
    //     return view('Admin::CFU.statistique');
    // }
}
