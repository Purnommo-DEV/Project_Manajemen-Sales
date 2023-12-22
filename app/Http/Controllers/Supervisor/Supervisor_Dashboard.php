<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Supervisor_Dashboard extends Controller
{
    public function dashboard(){
        return view('Supervisor.Dashboard.dashboard');
    }
}
