<?php

namespace App\Admin\Controllers\Impots;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpotsController extends Controller
{
    public function index () {
        return view('Admin::Impots.Liste');
    }

    public function ajout () {
        return view('Admin::Impots.Imposition');
    }

    public function modif (string $id) {
        return view('Admin::Impots.Modif');
    }

    public function voir (string $id) {
        return view('Admin::Impots.Voir');
    }

    public function payer () {
        return view('Admin::Impots.Payer');
    }

    public function imposition (string $id) {
        return view('Admin::Impots.Imposition');
    }
}
