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
        return view('Admin::Biens.Modif');
    }
}
