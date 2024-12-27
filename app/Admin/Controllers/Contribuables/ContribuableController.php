<?php

namespace App\Admin\Controllers\Contribuables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContribuableController extends Controller
{
    public function index () {
        return view('Admin::Contribuables.Liste');
    }

    public function ajout () {
        return view('Admin::Contribuables.Ajout');
    }

    public function modif () {
        return view('Admin::Contribuables.Modif');
    }
}
