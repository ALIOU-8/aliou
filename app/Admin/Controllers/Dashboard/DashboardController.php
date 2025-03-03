<?php

namespace App\Admin\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Annee;
use App\Models\Bien;
use App\Models\Contribuable;
use App\Models\Personnel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $personnel = Personnel::where('delete', 0)->count();
        $contribuable = Contribuable::where('delete', 0)->count();
        $bien = Bien::where('delete', 0)->count();
        $annees = Annee::get();
        return view('Admin::Dashboard.dashboard',compact('personnel','contribuable','bien','annees'));
    }
}
