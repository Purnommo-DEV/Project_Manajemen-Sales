<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;

class Admin_AreaController extends Controller
{
    public function halaman_area()
    {
        $data_provinsi = Provinsi::get(['name', 'id']);
        $data_kota = Kota::get(['name', 'id']);
        $data_kecamatan = Kecamatan::get(['name', 'id']);
        $data_desa = Desa::get(['name', 'id']);
        return view('Admin.Area.area', compact('data_provinsi', 'data_kota', 'data_kecamatan', 'data_desa'));
    }

    public function data_area(Request $request)
    {
        $data = Area::select([
            'area.*'
        ])->with('relasi_provinsi', 'relasi_kota', 'relasi_kecamatan', 'relasi_desa');


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

    public function tambah_data_area(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'desa_id' => 'required',
        ], [
            'provinsi_id.required' => 'Wajib diisi',
            'kota_id.required' => 'Wajib diisi',
            'kecamatan_id.required' => 'Wajib diisi',
            'desa_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_area = Area::create([
                'kode' => 'A-' . Str::random(7),
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'desa_id' => $request->desa_id,
            ]);

            if (!$tambah_area) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Customer'
                ]);
            }
        }
    }

    public function ubah_data_area($kode)
    {
        $data_area = Area::where('kode', $kode)->with('relasi_provinsi', 'relasi_kota', 'relasi_kecamatan', 'relasi_desa')->first();
        return view('Admin.Area.ubah_area', compact('data_area'));
    }

    public function proses_ubah_data_area(Request $request, $kode)
    {
        $data_area = Area::where('kode', $kode)->first();
        $validator = Validator::make($request->all(), [
            'provinsi_id' => 'required',
            'kota_id' => 'required',
            'kecamatan_id' => 'required',
            'desa_id' => 'required',
        ], [
            'provinsi_id.required' => 'Wajib diisi',
            'kota_id.required' => 'Wajib diisi',
            'kecamatan_id.required' => 'Wajib diisi',
            'desa_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_area->update([
                'provinsi_id' => $request->provinsi_id,
                'kota_id' => $request->kota_id,
                'kecamatan_id' => $request->kecamatan_id,
                'desa_id' => $request->desa_id,
            ]);

            if (!$data_area) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Area'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Area',
                    'route' => route('admin.HalamanArea')
                ]);
            }
        }
    }

    public function hapus_data_area($id)
    {
        $hapuscustomer = Area::find($id)->delete();
        if (!$hapuscustomer) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Area'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Area'
            ]);
        }
    }
}
