<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Kunjungan;
use Illuminate\Http\Request;

class Admin_DashboardController extends Controller
{
    public function dashboard(){
        $customer = Customer::count();
        $telah_dikunjungi = Kunjungan::where('id_status_kunjungan', 1)->count();
        $batal_dikunjungi = Kunjungan::where('id_status_kunjungan', 4)->count();
        $tunda_dikunjungi = Kunjungan::where('id_status_kunjungan', 3)->count();
        return view('Admin.Dashboard.dashboard');
    }
}
