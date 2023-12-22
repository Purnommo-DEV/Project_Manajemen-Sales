<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Hari;
use App\Models\Rute;
use App\Models\User;
use App\Models\RuteWS;
use App\Models\Customer;
use App\Models\RuteTemp;
use App\Models\Perjalanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_Perencanaan extends Controller
{
    //PERENCANAAN PERJALANAN
    public function halaman_perjalanan(){
        $sales_retail = User::orderBy('created_at', 'desc')->get(['id', 'nama', 'role_id'])->where('role_id', 2);
        return view('Admin.Perencanaan.Perjalanan.perjalanan', compact('sales_retail'));
    }

    public function data_perjalanan(Request $request)
    {
        $data = Perjalanan::select([
            'perjalanan.*'
        ])->with('relasi_sales', 'relasi_kendaraan')->whereRelation('relasi_sales', 'role_id', 2)->orderBy('created_at', 'desc');

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

    public function tambah_data_perjalanan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_sales_id' => 'required',
        ], [
            'user_sales_id.required' => 'Wajib diisi']);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_perjalanan = Perjalanan::create([
                'kode' => 'P-' . Str::random(7),
                'user_sales_id' => $request->user_sales_id,
            ]);

            $tambah_rute = Rute::create([
                'perjalanan_id' =>$tambah_perjalanan->id
            ]);

            if (!$tambah_perjalanan) {
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

    public function ubah_data_perjalanan(Request $request)
    {
        $data_perjalanan = Perjalanan::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'user_sales_id' => 'required'
        ], [
            'user_sales_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_perjalanan->update([
                'user_sales_id' => $request->user_sales_id,
            ]);

            if (!$data_perjalanan) {
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

    public function hapus_data_perjalanan($id)
    {
        $hapuslistsales = Perjalanan::find($id)->delete();
        if (!$hapuslistsales) {
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

    // HALAMAN KUNJUNGAN CUSTOMER
    public function halaman_kunjungi_customer($kode_perjalanan){
        $perjalanan = Perjalanan::where('kode', $kode_perjalanan)->first();
        $customer_retail = Customer::get(['id', 'nama', 'jenis_customer'])->where('jenis_customer', 'r');
        return view('Admin.Perencanaan.Perjalanan.daftar_kunjungi_customer', compact('customer_retail', 'perjalanan'));
    }

    public function data_kunjungi_customer(Request $request, $perjalanan_id)
    {
        $data = Rute::select([
            'rute.*'
        ])->with('relasi_customer', 'relasi_perjalanan')->where('perjalanan_id', $perjalanan_id)->orderBy('created_at', 'desc');


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

    public function tambah_data_kunjungi_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'hari'        => 'required',
            'minggu_ke'   => 'required',
            'ganjil_genap'=> 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'hari.required'        => 'Wajib diisi',
            'minggu_ke.required'   => 'Wajib diisi',
            'ganjil_genap.required'=> 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_kunjungi_customer = Rute::create([
                'perjalanan_id' => $request->perjalanan_id,
                'customer_id' => $request->customer_id,
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke,
                'ganjil_genap' => $request->ganjil_genap,
                'status'  => 0
            ]);

            if (!$tambah_kunjungi_customer) {
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

    public function ubah_data_kunjungi_customer(Request $request)
    {
        $data_kunjungi_customer = Rute::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'hari'        => 'required',
            'minggu_ke'   => 'required',
            'ganjil_genap'=> 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'hari.required'        => 'Wajib diisi',
            'minggu_ke.required'   => 'Wajib diisi',
            'ganjil_genap.required'=> 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_kunjungi_customer->update([
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke,
                'ganjil_genap' => $request->ganjil_genap,
            ]);

            if (!$data_kunjungi_customer) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Daftar Rencana Kunjungi Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Daftar Rencana Kunjungi Customer',
                ]);
            }
        }
    }

    public function hapus_data_kunjungi_customer($id)
    {
        $hapus_daftar_customer = Rute::find($id)->delete();
        if (!$hapus_daftar_customer) {
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

    // HALAMAN PERJALANAN
    public function halaman_perjalanan_temp(){
        $sales_retail = User::get(['id', 'nama', 'role_id'])->where('role_id', 2)->orderBy('created_at', 'desc');
        return view('Admin.Perencanaan.Perjalanan.perjalanan_temp', compact('sales_retail'));
    }

    // HALAMAN KUNJUNGAN CUSTOMER TEMPORARY PLAN
    public function halaman_kunjungi_customer_temp($kode_perjalanan){
        $perjalanan = Perjalanan::where('kode', $kode_perjalanan)->first();
        $customer_retail = Customer::get(['id', 'nama', 'jenis_customer'])->where('jenis_customer', 'r');
        return view('Admin.Perencanaan.Perjalanan.daftar_kunjungi_customer_temp', compact('customer_retail', 'perjalanan'));
    }

    public function data_kunjungi_customer_temp(Request $request, $perjalanan_id)
    {
        $data = RuteTemp::select([
            'rute_temp.*'
        ])->with('relasi_customer', 'relasi_perjalanan')->where('perjalanan_id', $perjalanan_id)->orderBy('created_at', 'desc');


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

    public function tambah_data_kunjungi_customer_temp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'tanggal'     => 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'tanggal.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_kunjungi_customer = RuteTemp::create([
                'perjalanan_id' => $request->perjalanan_id,
                'customer_id' => $request->customer_id,
                'tanggal' => $request->tanggal,
                'status'  => 0
            ]);

            if (!$tambah_kunjungi_customer) {
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

    public function ubah_data_kunjungi_customer_temp(Request $request)
    {
        $data_kunjungi_customer = RuteTemp::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'tanggal' => 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'tanggal.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_kunjungi_customer->update([
                'customer_id' => $request->customer_id,
                'tanggal' => $request->tanggal,
            ]);

            if (!$data_kunjungi_customer) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Daftar Rencana Kunjungi Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Daftar Rencana Kunjungi Customer',
                ]);
            }
        }
    }

    public function hapus_data_kunjungi_customer_temp($id)
    {
        $hapus_daftar_customer = RuteTemp::find($id)->delete();
        if (!$hapus_daftar_customer) {
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

    //PERENCANAAN PERJALANAN WHOLESALE
    public function halaman_perjalanan_ws(){
        $sales_wholesale = User::get(['id', 'nama', 'role_id'])->where('role_id', 3);
        return view('Admin.Perencanaan.PenagihanHutang.perjalanan_wholesale', compact('sales_wholesale'));
    }

    public function data_perjalanan_ws(Request $request)
    {
        $data = Perjalanan::select([
            'perjalanan.*'
        ])->with('relasi_sales', 'relasi_kendaraan')->whereRelation('relasi_sales', 'role_id', 3)->orderBy('created_at', 'desc');


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

    public function tambah_data_perjalanan_ws(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_sales_id' => 'required',
        ], [
            'user_sales_id.required' => 'Wajib diisi']);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_perjalanan = Perjalanan::create([
                'kode' => 'P-' . Str::random(7),
                'user_sales_id' => $request->user_sales_id,
            ]);

            if (!$tambah_perjalanan) {
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

    public function ubah_data_perjalanan_ws(Request $request)
    {
        $data_perjalanan_ws = Perjalanan::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'user_sales_id' => 'required'
        ], [
            'user_sales_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_perjalanan_ws->update([
                'user_sales_id' => $request->user_sales_id,
            ]);

            if (!$data_perjalanan_ws) {
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

    public function hapus_data_perjalanan_ws($id)
    {
        $hapuslistsales = Perjalanan::find($id)->delete();
        if (!$hapuslistsales) {
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

    // HALAMAN KUNJUNGAN CUSTOMER
    public function halaman_penagihan_hutang_ws($kode_perjalanan){
        $perjalanan = Perjalanan::where('kode', $kode_perjalanan)->first();
        $customer_wholesale = Customer::get(['id', 'nama', 'jenis_customer'])->where('jenis_customer', 'w');
        return view('Admin.Perencanaan.PenagihanHutang.daftar_penagihan_hutang_ws', compact('customer_wholesale', 'perjalanan'));
    }

    public function data_penagihan_hutang_ws(Request $request, $perjalanan_id)
    {
        $data = RuteWS::select([
            'rute_ws.*'
        ])->with('relasi_customer', 'relasi_perjalanan')->where('perjalanan_id', $perjalanan_id)->orderBy('created_at', 'desc');


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

        $data = RuteWS::seletc([
            'rute_ws.*'
        ])->with('relasi_customer', 'relasi_perjalanan')->where('perjalanan_id', $perjalanan_id);


    }

    public function tambah_data_penagihan_hutang_ws(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'hari'        => 'required',
            'minggu_ke'   => 'required',
            'ganjil_genap'=> 'required',
            'penjualan'=> 'required',
            'tempo'=> 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'hari.required'        => 'Wajib diisi',
            'minggu_ke.required'   => 'Wajib diisi',
            'ganjil_genap.required'=> 'Wajib diisi',
            'penjualan.required'=> 'Wajib diisi',
            'tempo.required'=> 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_penagihan_hutang_ws = RuteWS::create([
                'perjalanan_id' => $request->perjalanan_id,
                'customer_id' => $request->customer_id,
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke,
                'ganjil_genap' => $request->ganjil_genap,
                'penjualan' => Carbon::parse($request->penjualan),
                'tempo' => $request->tempo,
                'jatuh_tempo' => Carbon::parse($request->penjualan)->addDays($request->tempo),
                'status'  => 0
            ]);

            if (!$tambah_penagihan_hutang_ws) {
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

    public function ubah_data_penagihan_hutang_ws(Request $request)
    {
        $data_penagihan_hutang_ws = RuteWS::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required',
            'hari'        => 'required',
            'minggu_ke'   => 'required',
            'ganjil_genap'=> 'required',
            'penjualan'   => 'required'
        ], [
            'customer_id.required' => 'Wajib diisi',
            'hari.required'        => 'Wajib diisi',
            'minggu_ke.required'   => 'Wajib diisi',
            'ganjil_genap.required'=> 'Wajib diisi',
            'penjualan.required'   => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_penagihan_hutang_ws->update([
                'hari' => $request->hari,
                'minggu_ke' => $request->minggu_ke,
                'ganjil_genap' => $request->ganjil_genap,
                'penjualan' => $request->penjualan,
                'tempo' => $request->tempo,
                'jatuh_tempo' => Carbon::parse($request->penjualan)->addDays($request->tempo)
            ]);

            if (!$data_penagihan_hutang_ws) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Daftar Rencana Kunjungi Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Daftar Rencana Kunjungi Customer',
                ]);
            }
        }
    }

    public function hapus_data_penagihan_hutang_ws($id)
    {
        $hapus_daftar_customer = RuteWS::find($id)->delete();
        if (!$hapus_daftar_customer) {
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
