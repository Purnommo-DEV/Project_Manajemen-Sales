<?php

namespace App\Http\Controllers\Admin;

use App\Models\Perusahaan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_Perusahaan extends Controller
{
    //CRUD PERUSAHAAN
    public function halaman_perusahaan(){
        return view('Admin.Perusahaan.perusahaan');
    }

    public function data_perusahaan(Request $request)
    {
        $data = Perusahaan::select([
            'perusahaan.*'
        ]);

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

    public function tambah_data_perusahaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perusahaan' => 'required',
            'alamat' => 'required'
        ], [
            'perusahaan.required' => 'Wajib diisi',
            'alamat.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_perusahaan = Perusahaan::create([
                'kode' => 'PR-' . Str::random(7),
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
            ]);

            if (!$tambah_perusahaan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Perusahaan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Perusahaan'
                ]);
            }
        }
    }

    public function ubah_data_perusahaan(Request $request)
    {
        $data_perusahaan = Perusahaan::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'perusahaan' => 'required',
            'alamat' => 'required'
        ], [
            'perusahaan.required' => 'Wajib diisi',
            'alamat.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_perusahaan->update([
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat,
            ]);

            if (!$data_perusahaan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Perusahaan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Perusahaan'
                ]);
            }
        }
    }

    public function hapus_data_perusahaan($id)
    {
        $hapuslist_perusahaan = Perusahaan::find($id)->delete();
        if (!$hapuslist_perusahaan) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Perusahaan'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Perusahaan'
            ]);
        }
    }
}
