<?php

namespace App\Http\Controllers\Admin;

use App\Models\Perusahaan;
use App\Models\PesanProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PesanProdukDetail;
use App\Models\PesanProdukTransaksi;
use Illuminate\Support\Facades\Validator;
use Alert;

class Admin_PesanProduk extends Controller
{
    //PESAN PRODUK
    public function halaman_pesan_produk(){
        $perusahaan = Perusahaan::get(['id', 'perusahaan']);
        return view('Admin.PesanProduk.pesan_produk', compact('perusahaan'));
    }

    public function data_pesan_produk(Request $request)
    {
        $data = PesanProduk::select([
            'pesan_produk.*'
        ])->with('relasi_perusahaan');


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

    public function tambah_data_pesan_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'perusahaan_id' => 'required',
        ], [
            'perusahaan_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_pesan_produk = PesanProduk::create([
                'kode' => 'PP-' . Str::random(7),
                'perusahaan_id' => $request->perusahaan_id,
                'status' => 0,
            ]);

            if (!$tambah_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Pesanan Produk'
                ]);
            }
        }
    }

    public function ubah_data_pesan_produk(Request $request)
    {
        $data_pesan_produk = PesanProduk::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'perusahaan_id' => 'required'
        ], [
            'perusahaan_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_pesan_produk->update([
                'perusahaan_id' => $request->perusahaan_id,
            ]);

            if (!$data_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Pesanan Produk',
                ]);
            }
        }
    }

    public function hapus_data_pesan_produk($id)
    {
        $hapuslist_pesan_produk = PesanProduk::find($id)->delete();
        if (!$hapuslist_pesan_produk) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Pesanan Produk'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Pesanan Produk'
            ]);
        }
    }

    // DETAIL PESAN PRODUK
    public function detail_pesan_produk($kode_pesan_produk){
        $pesanan_produk = PesanProdukTransaksi::where('kode', $kode_pesan_produk)->first();
        return view('Admin.PesanProduk.detail_pesan_produk', compact('pesanan_produk'));
    }

    public function data_detail_pesan_produk(Request $request, $pesan_produk_id)
    {
        $data = PesanProdukDetail::select([
            'pesan_produk_detail.*'
        ])->where('pesan_produk_transaksi_id', $pesan_produk_id)->with('relasi_pesan_produk', 'relasi_produk');


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

    public function tambah_data_detail_pesan_produk(Request $request)
    {
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;
        $catatan = $request->catatan;

        $validator = Validator::make($request->all(), [
            'produk_id.*' => 'required',
            'jumlah.*' => 'required',
        ], [
            'produk_id.*.required' => 'Wajib diisi',
            'jumlah.*.required' => 'Wajib diisi'
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            for($i = 0; $i < count($nama_produk); $i++){
                $tambah_pesan_produk = PesanProdukDetail::create([
                    'pesan_produk_transaksi_id' => $request->pesan_produk_transaksi_id,
                    'nama_produk'     => $nama_produk[$i],
                    'catatan'         => $catatan[$i],
                    'jumlah'            => $jumlah[$i],
                ]);
            }

            if (!$tambah_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Pesanan Produk'
                ]);
            }
        }
    }

    public function ubah_data_detail_pesan_produk(Request $request)
    {
        $detail_data_pesan_produk = PesanProdukDetail::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'stok' => 'required',
        ], [
            'nama_produk.required' => 'Wajib diisi',
            'stok.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $detail_data_pesan_produk->update([
                'nama_produk' => $request->nama_produk,
                'stok'        => $request->stok,
                'catatan'     => $request->catatan
            ]);

            if (!$detail_data_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Pesanan Produk',
                ]);
            }
        }
    }

    public function hapus_data_detail_pesan_produk($id)
    {
        $hapuslist_pesan_produk = PesanProdukDetail::find($id)->delete();
        if (!$hapuslist_pesan_produk) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Pesanan Produk'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Pesanan Produk'
            ]);
        }
    }

    public function halaman_tambah_pesan_produk($kode_perusahaan){
        $perusahaan = Perusahaan::where('kode', $kode_perusahaan)->first();
        return view('Admin.PesanProduk.tambah_pesan_produk', compact('perusahaan'));
    }

    public function data_tambah_pesan_produk(Request $request, $perusahaan_id)
    {
        $data = PesanProdukTransaksi::select([
            'pesan_produk_transaksi.*'
        ])->with('relasi_perusahaan')->where('perusahaan_id', $perusahaan_id);

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

    public function tambah_data_tambah_pesan_produk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
        ], [
            'tanggal.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_tambah_pesan_produk = PesanProdukTransaksi::create([
                'kode' => 'TP-' . Str::random(7),
                'perusahaan_id' => $request->perusahaan_id,
                'tanggal' => $request->tanggal,
                'status' => 0,
            ]);

            if (!$tambah_tambah_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Pesanan Produk'
                ]);
            }
        }
    }

    public function ubah_data_tambah_pesan_produk(Request $request)
    {
        $data_tambah_pesan_produk = PesanProdukTransaksi::where('id', $request->id)->first();
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required',
        ], [
            'tanggal.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $data_tambah_pesan_produk->update([
                'tanggal' => $request->tanggal,
            ]);

            if (!$data_tambah_pesan_produk) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Pesanan Produk'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Pesanan Produk',
                ]);
            }
        }
    }

    public function hapus_data_tambah_pesan_produk($id)
    {
        $hapuslist_tambah_pesan_produk = PesanProdukTransaksi::find($id)->delete();
        if (!$hapuslist_tambah_pesan_produk) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Pesanan Produk'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Pesanan Produk'
            ]);
        }
    }

    public function tambah_lampiran_pesanan(Request $request){
        $data_transaksi = PesanProdukTransaksi::where('kode', $request->pesan_produk_transaksi_id)->first();
        if($request->hasFile('lampiran')){
            $filenameWithExt = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('lampiran')->storeAs('public/lampiran', $filenameSimpan);
        }else{
            $filenameSimpan = "";
        }
        $data_transaksi->update([
            'kode_po'  => $request->kode_po,
            'lampiran' => $filenameSimpan
        ]);

        Alert::success('Berhasil', 'Data lampiran berhasil disimpan');
        return back();
    }
}
