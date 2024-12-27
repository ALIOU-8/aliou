<?php

namespace App\Admin\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('Admin::Dashboard.dashboard');
    }
}
