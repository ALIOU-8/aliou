<?php

namespace App\Admin\Controllers\CFU;

use App\Http\Controllers\Controller;

class OccupantController extends Controller
{
    
    public function index () {
        return view('Admin::CFU.Occupant.Liste');
    }

    public function ajout () {
        return view('Admin::CFU.Occupant.Ajout');
    }

    public function modif () {
        return view('Admin::CFU.Occupant.Modif');
    }

    public function voir () {
        return view('Admin::CFU.Occupant.Voir');
    }

    public function corbeille () {
        return view('Admin::CFU.Occupant.Corbeille');
    }
}
