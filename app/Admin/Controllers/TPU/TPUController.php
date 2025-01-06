<?php

namespace App\Admin\Controllers\TPU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TPUController extends Controller
{
    public function index () {
        return view('Admin::TPU.Liste');
    }

    public function ajout () {
        return view('Admin::TPU.Ajout');
    }

    public function modif () {
        return view('Admin::TPU.Modif');
    }
}
