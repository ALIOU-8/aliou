<?php

namespace App\Admin\Controllers\Licence;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    public function index () {
        return view('Admin::Licence.Liste');
    }

    public function ajout () {
        return view('Admin::Licence.Ajout');
    }

    public function modif () {
        return view('Admin::Licence.Modif');
    }

    public function voir () {
        return view('Admin::Licence.Voir');
    }

    public function corbeille () {
        return view('Admin::Licence.Corbeille');
    }
}
