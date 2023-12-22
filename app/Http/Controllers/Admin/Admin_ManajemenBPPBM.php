<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BPPBM;
use App\Models\DetailInsentif;
use App\Models\DetailTransaksi;
use App\Models\Perjalanan;
use Illuminate\Http\Request;

class Admin_ManajemenBPPBM extends Controller
{
    public function halaman_pengajuan_bppbm(){
        return view('Admin.BPPBM.pengajuan_bppbm');
    }

    public function detail_pengajuan_bppbm($kode_perjalanan){
        $perjalanan = Perjalanan::with('relasi_sales')->where('kode', $kode_perjalanan)->first();
        return view('Admin.BPPBM.detail_pengajuan_bppbm', compact('perjalanan'));
    }

    public function data_detail_pengajuan_bppbm(Request $request, $perjalanan_id){
        $data = BPPBM::select([
            'bppbm.*'
        ])->with('relasi_perjalanan', 'relasi_produk')->where('perjalanan_id', $perjalanan_id);


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

    public function detail_bppbm_customer($id){
        $data_bppbm = BPPBM::where('id', $id)->first();
        $pemasangan_jual = DetailTransaksi::where('bppbm_id', $id)->get();
        $insentif = DetailInsentif::where('bppbm_id', $id)->get();
        $retur = DetailTransaksi::where('bppbm_id', $id)->get();
        return view('Admin.BPPBM.detail_bppbm_customer', compact('data_bppbm', 'pemasangan_jual', 'insentif', 'retur'));
    }
}

