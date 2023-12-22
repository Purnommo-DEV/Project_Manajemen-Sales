<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\RoutePlanTemp;
use App\Http\Controllers\Controller;
use App\Models\RoutePlanTempCustomer;
use Illuminate\Support\Facades\Validator;

class Admin_RoutePlanTemp extends Controller
{
    //RUTE PERJALANAN TEMPORARY
    public function halaman_rute_plan_temp(){
        $sales_retail = User::get(['id', 'nama', 'role_id'])->where('role_id', 2);
        return view('Admin.Route.RoutePlanTemp.route_plan_temp', compact('sales_retail'));
    }

    public function data_rute_plan_temp(Request $request)
    {
        $data = RoutePlanTemp::select([
            'route_plan_temp.*'
        ])->with('relasi_sales');


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

    public function tambah_rute_plan_temp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_sales' => 'required',
            'tanggal' => 'required',
        ], [
            'id_sales.required' => 'Wajib diisi',
            'tanggal.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_rute_plan_temp = RoutePlanTemp::create([
                'kode' => 'RT-' . Str::random(7),
                'id_sales' => $request->id_sales,
                'tanggal' => $request->tanggal,
            ]);

            if (!$tambah_rute_plan_temp) {
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

    public function ubah_rute_plan_temp(Request $request)
    {
        $rute_plan_temp = RoutePlanTemp::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'id_sales' => 'required',
            'tanggal' => 'required'
        ], [
            'id_sales.required' => 'Wajib diisi',
            'tanggal.required' => 'Wajib diisi'
        ]);
        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $rute_plan_temp->update([
                'id_sales' => $request->id_sales,
                'tanggal' => $request->tanggal,
            ]);

            if (!$rute_plan_temp) {
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

    public function hapus_rute_plan_temp($id)
    {
        $hapus_rute_plan_temp = RoutePlanTemp::find($id)->delete();
        if (!$hapus_rute_plan_temp) {
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


    //RUTE PERJALANAN TEMPORARY CUSTOMER
    public function halaman_rute_plan_temp_customer($kode){
        $rute_plan_temp = RoutePlanTemp::where('kode', $kode)->first();
        $customer_retail = Customer::get(['id', 'nama', 'jenis_customer'])->where('jenis_customer', 'r');
        return view('Admin.Route.RoutePlanTemp.route_plan_temp_customer', compact('customer_retail', 'rute_plan_temp'));
    }

    public function data_rute_plan_temp_customer(Request $request, $id_rute)
    {
        $data = RoutePlanTempCustomer::select([
            'route_plan_temp_customer.*'
        ])->with('relasi_customer', 'relasi_route_plan_temp')->where('id_route_plan_temp', $id_rute);


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

    public function tambah_rute_plan_temp_customer(Request $request)
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
            $tambah_rute_plan_temp_customer = RoutePlanTempCustomer::create([
                'id_route_plan_temp' => $request->id_route_plan_temp,
                'id_customer' => $request->id_customer
            ]);

            if (!$tambah_rute_plan_temp_customer) {
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

    public function hapus_rute_plan_temp_customer($id)
    {
        $hapus_rute_plan_temp_customer = RoutePlanTempCustomer::find($id)->delete();
        if (!$hapus_rute_plan_temp_customer) {
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
