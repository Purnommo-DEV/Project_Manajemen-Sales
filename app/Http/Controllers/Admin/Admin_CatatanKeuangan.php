<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CatatanKeuangan;
use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use App\Models\KategoriCatatanKeuangan;
use Illuminate\Support\Facades\Validator;

class Admin_CatatanKeuangan extends Controller
{
    public function halaman_ctt_keuangan()
    {
        $jenis = JenisTransaksi::get();
        $kategori = KategoriCatatanKeuangan::get();
        return view('Admin.Keuangan.keuangan', compact('jenis', 'kategori'));
    }

    public function data_ctt_keuangan(Request $request)
    {
        $data = CatatanKeuangan::select([
            'catatan_keuangan.*'
        ])->with('relasi_jenis_transaksi', 'relasi_kategori_transaksi')->orderBy('created_at', 'desc');

        if ($request->input('tgl_awal') && $request->input('tgl_akhir')) {
            $data = $data->whereBetween('tanggal', [$request->input('tgl_awal'), $request->input('tgl_akhir')]);
        }

        // if ($request->input('search.value') != null) {
        //     $data = $data->where(function ($q) use ($request) {
        //         $q->whereRaw('LOWER(nama_produk) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
        //     })->orWhere(function ($q2) use ($request) {
        //         $q2->whereRaw('LOWER(kode) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
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

    public function tambah_data_ctt_keuangan(Request $request)
    {
        $nominal = str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->nominal);
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jenis_id' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
            'foto_bukti' => 'required',
        ], [
            'tanggal.required' => 'Wajib diisi',
            'jenis_id.required' => 'Wajib diisi',
            'kategori_id.required' => 'Wajib diisi',
            'nominal.required' => 'Wajib diisi',
            'keterangan.required' => 'Wajib diisi',
            'foto_bukti.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            if($request->hasFile('foto_bukti')){
                $filenameWithExt = $request->file('foto_bukti')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto_bukti')->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.time().'.'.$extension;
                $path = $request->file('foto_bukti')->storeAs('public/foto_bukti', $filenameSimpan);
            }else{
                $filenameSimpan = "";
            }
            $tmbhCatatanKeuangan = CatatanKeuangan::create([
                'tanggal' => $request->tanggal,
                'jenis_id' => $request->jenis_id,
                'kategori_id' => $request->kategori_id,
                'nominal' => $nominal,
                'keterangan' => $request->keterangan,
                'foto_bukti' => $filenameSimpan
            ]);

            if (!$tmbhCatatanKeuangan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Catatan Keuangan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Catatan Keuangan'
                ]);
            }
        }
    }

    public function ubah_data_ctt_keuangan(Request $request)
    {
        $nominal = str_replace(['Rp. ', '.', '.'], ['', '', ''], $request->nominal);
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
            'jenis_id' => 'required',
            'kategori_id' => 'required',
            'nominal' => 'required',
            'keterangan' => 'required',
        ], [
            'tanggal.required' => 'Wajib diisi',
            'jenis_id.required' => 'Wajib diisi',
            'kategori_id.required' => 'Wajib diisi',
            'nominal.required' => 'Wajib diisi',
            'keterangan.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_catatan_keuangan = CatatanKeuangan::where('id', $request->id)->first();
             if($request->hasFile('foto_bukti')){
                $filenameWithExt = $request->file('foto_bukti')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('foto_bukti')->getClientOriginalExtension();
                $filenameSimpan = $filename.'_'.time().'.'.$extension;
                $path = $request->file('foto_bukti')->storeAs('public/foto_bukti', $filenameSimpan);
            }else{
                $filenameSimpan = $data_catatan_keuangan->foto_bukti;
            }
            $ubahCatatanKeuangan = CatatanKeuangan::where('id', $request->id)->update([
                'tanggal' => $request->tanggal,
                'jenis_id' => $request->jenis_id,
                'kategori_id' => $request->kategori_id,
                'nominal' => $nominal,
                'keterangan' => $request->keterangan,
                'foto_bukti' => $filenameSimpan
            ]);

            if (!$ubahCatatanKeuangan) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Catatan Keuangan'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Catatan Keuangan'
                ]);
            }
        }
    }

    // public function hapus_data_ctt_keuangan($id)
    // {
    //     $hapus_produk = Produk::find($id)->delete();
    //     if (!$hapus_produk) {
    //         return response()->json([
    //             'status' => 0,
    //             'msg' => 'Terjadi kesalahan, Gagal Menghapus Pengguna'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 1,
    //             'msg' => 'Berhasil Menghapus Data Pengguna'
    //         ]);
    //     }
    // }
}
