<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class Admin_KendaraanController extends Controller
{
    public function halaman_kendaraan()
    {
        return view('Admin.Kendaraan.kendaraan');
    }

    public function data_kendaraan(Request $request)
    {
        $data = Kendaraan::select([
            'kendaraan.*'
        ])->orderBy('id', 'desc');

        // if($request->input('jurusan_id')!=null){
        //     $data = $data->where('jurusan_id', $request->jurusan_id);
        // }

        // if($request->input('search.value')!=null){
        //     $data = $data->where(function($q)use($request){
        //             $q->whereRaw('LOWER(muk) like ?',['%'.strtolower($request->input('search.value')).'%']);
        //     });
        //     $data = $data->with('relasi_jurusan')->whereHas('relasi_jurusan', function($q)use($request) {
        //         $q->whereRaw('LOWER(jurusan) like ?',['%'.strtolower($request->input('search.value')).'%']);
        //     });
        // }

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

    public function tambah_data_kendaraan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => 'required',
            'plat' => 'required',
            'keterangan_lainnya' => 'required',
            'status' => 'required',
        ], [
            'tipe.required' => 'Wajib diisi',
            'plat.required' => 'Wajib diisi',
            'keterangan_lainnya.required' => 'Wajib diisi',
            'status.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_kendaraan = Kendaraan::create([
                'tipe'      => $request->tipe,
                'plat'     => $request->plat,
                'keterangan_lainnya'  => $request->keterangan_lainnya,
                'status'  => $request->status,
            ]);

            if (!$tambah_kendaraan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Kendaraan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Kendaraan'
                ]);
            }
        }
    }

    public function ubah_data_kendaraan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => 'required',
            'plat' => 'required',
            'keterangan_lainnya' => 'required',
        ], [
            'tipe.required' => 'Wajib diisi',
            'plat.required' => 'Wajib diisi',
            'keterangan_lainnya.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $ubah_kendaraan = Kendaraan::where('id', $request->id)->update([
                'tipe'      => $request->tipe,
                'plat'     => $request->plat,
                'keterangan_lainnya'  => $request->keterangan_lainnya,
                'status'  => $request->status_kendaraan,
            ]);

            if (!$ubah_kendaraan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data Kendaraan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Data Kendaraan'
                ]);
            }
        }
    }

    public function hapus_data_kendaraan($id)
    {
        $hapus_kendaraan = Kendaraan::find($id)->delete();
        if (!$hapus_kendaraan) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Kendaraan'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Kendaraan'
            ]);
        }
    }
}
