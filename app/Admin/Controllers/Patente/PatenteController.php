<?php

namespace App\Admin\Controllers\Patente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatenteController extends Controller
{
    public function index () {
        return view('Admin::Patente.Liste');
    }

    public function ajout () {
        return view('Admin::Patente.Ajout');
    }

    public function modif () {
        return view('Admin::Patente.Modif');
    }

    public function voir () {
        return view('Admin::Patente.Voir');
    }

    public function corbeille () {
        return view('Admin::Patente.Corbeille');
    }
}
