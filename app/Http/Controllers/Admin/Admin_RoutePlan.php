<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rute;
use App\Models\User;
use App\Models\Customer;
use App\Models\RoutePlan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoutePlanCustomer;
use Illuminate\Support\Facades\Validator;

class Admin_RoutePlan extends Controller
{
    //RUTE PLAN
    public function halaman_rute_plan(){
        $sales_retail = User::get(['id', 'nama', 'role_id'])->where('role_id', 2);
        return view('Admin.Route.RoutePlan.route_plan', compact('sales_retail'));
    }

    public function data_rute_plan(Request $request)
    {
        $data = RoutePlan::select([
            'route_plan.*'
        ])->with('relasi_sales')->orderBy('created_at', 'desc')->orderBy('created_at', 'desc');


        $rekamFilter = $data->get()->count();
        if ($request->input('length') != -1)
            $data = $data->skip($request->input('start'))->take($request->input('length'));
        $rekamTotal = $data->count();
        $data = $data->get();

        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function tambah_rute_plan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_sales' => 'required',
            'hari' => 'required',
            'minggu_ke' => 'required'
        ], [
            'id_sales.required' => 'Wajib diisi',
            'hari.required' => 'Wajib diisi',
            'minggu_ke.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_rute_plan = RoutePlan::create([
                'kode' => 'R-' . Str::random(7),
                'id_sales' => $request->id_sales,
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke
            ]);

            if (!$tambah_rute_plan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah List Sales Perjalanan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan List Sales Perjalanan'
                ]);
            }
        }
    }

    public function ubah_rute_plan(Request $request)
    {
        $rute_plan = RoutePlan::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'id_sales' => 'required',
            'hari' => 'required',
            'minggu_ke' => 'required'
        ], [
            'id_sales.required' => 'Wajib diisi',
            'hari.required' => 'Wajib diisi',
            'minggu_ke.required' => 'Wajib diisi'
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $rute_plan->update([
                'id_sales' => $request->id_sales,
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke
            ]);

            if (!$rute_plan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah List Sales Perjalanan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah List Sales Perjalanan',
                    'route' => route('admin.HalamanPerjalanan')
                ]);
            }
        }
    }

    public function hapus_rute_plan($id)
    {
        $hapus_rute_plan = RoutePlan::find($id)->delete();
        if (!$hapus_rute_plan) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus List Sales Perjalanan'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data List Sales Perjalanan'
            ]);
        }
    }


    //RUTE PLAN CUSTOMER
    public function halaman_rute_plan_customer($kode){
        $rute_plan = RoutePlan::where('kode', $kode)->first();
        $customer_retail = Customer::get(['id', 'nama', 'jenis_customer'])->where('jenis_customer', 'r');
        return view('Admin.Route.RoutePlan.route_plan_customer', compact('customer_retail', 'rute_plan'));
    }

    public function data_rute_plan_customer(Request $request, $id_rute)
    {
        $data = RoutePlanCustomer::select([
            'route_plan_customer.*'
        ])->with('relasi_customer', 'relasi_route_plan')->where('id_route_plan', $id_rute)->orderBy('created_at', 'desc');


        $rekamFilter = $data->get()->count();
        if ($request->input('length') != -1)
            $data = $data->skip($request->input('start'))->take($request->input('length'));
        $rekamTotal = $data->count();
        $data = $data->get();

        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function tambah_rute_plan_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_customer' => 'required',
        ], [
            'id_customer.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_rute_plan_customer = RoutePlanCustomer::create([
                'id_route_plan' => $request->id_route_plan,
                'id_customer' => $request->id_customer
            ]);

            if (!$tambah_rute_plan_customer) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Daftar Rencana Kunjungi Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Daftar Rencana Kunjungi Customer'
                ]);
            }
        }
    }

    public function hapus_rute_plan_customer($id)
    {
        $hapus_rute_plan_customer = RoutePlanCustomer::find($id)->delete();
        if (!$hapus_rute_plan_customer) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Daftar Rencana Kunjungi Customer'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Daftar Rencana Kunjungi Customer'
            ]);
        }
    }
}
