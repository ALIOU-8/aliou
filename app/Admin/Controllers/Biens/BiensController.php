<?php

namespace App\Admin\Controllers\Biens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BiensController extends Controller
{
    public function index () {
        return view('Admin::Biens.Liste');
    }

    public function ajout () {
        return view('Admin::Biens.Ajout');
    }

    public function modif () {
        return view('Admin::Biens.Modif');
    }

    public function type () {
        return view('Admin::Biens.Type');
    }
}
