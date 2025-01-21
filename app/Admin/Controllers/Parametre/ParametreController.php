<?php

namespace App\Admin\Controllers\Parametre;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParametreController extends Controller
{
    public function index() {
        return view('Admin::Parametre.Index');
    }
}
