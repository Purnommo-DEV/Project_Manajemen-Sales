<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\BPPBM;
use App\Models\Produk;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use App\Models\DetailInsentif;
use App\Models\DetailTransaksi;
use App\Http\Controllers\Controller;

class Supervisor_ManajemenBPPBM extends Controller
{
    public function halaman_pengajuan_bppbm(){
        return view('Supervisor.BPPBM.pengajuan_bppbm');
    }

    public function data_perjalanan(Request $request)
    {
        $data = Perjalanan::select([
            'perjalanan.*'
        ])->with('relasi_sales', 'relasi_kendaraan')->whereRelation('relasi_sales', 'role_id', 2);

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

    public function detail_pengajuan_bppbm($kode_perjalanan){
        $perjalanan = Perjalanan::with('relasi_sales')->where('kode', $kode_perjalanan)->first();
        return view('Supervisor.BPPBM.detail_pengajuan_bppbm', compact('perjalanan'));
    }

    public function data_detail_pengajuan_bppbm(Request $request, $perjalanan_id){
        $data = BPPBM::select([
            'bppbm.*'
        ])->with('relasi_perjalanan', 'relasi_produk', 'relasi_status_bppbm')->where('perjalanan_id', $perjalanan_id);


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
        return view('Supervisor.BPPBM.detail_bppbm_customer', compact('data_bppbm', 'pemasangan_jual', 'insentif', 'retur'));
    }

    public function setujui_pengajuan_bppbm($id){
        // BPPBM::whereIn('id', $request->ids)->update([
        //     'id_status_bppbm_awal' => 1
        // ]);

        BPPBM::where('id', $id)->update([
            'id_status_bppbm_awal' => 1
        ]);

        $data_bppbm = BPPBM::where('id', $id)->first();
        $data_produk = Produk::where('id', $data_bppbm->produk_id)->first();
        if($data_bppbm->pengambilan > $data_produk->stok){
            return response()->json([
                'status' => 0,
                'msg' => "Pengambilan produk melebihi stok"
            ]);
        }else{
            $data_produk->update([
                'stok' => $data_produk->stok - $data_bppbm->pengambilan
            ]);
            return response()->json([
                'status' => 1,
                'msg' => "Data BPPBM telh disetujui"
            ]);
        }


        // Produk::whereIn('id', $request->produk_ids)->update([
        //     'id_status_bppbm_awal' => 1
        // ]);

        // $produk_bppbm = BPPBM::whereIn('id', $request->ids)->get()->toArray();
        // foreach($request->ids as $data_bppbm){
        //     $data_produk_bppbm = BPPBM::where($data_bppbm['produk_id']);
        //     dd($data_produk_bppbm);
        // }
    }

    public function tidak_setujui_pengajuan_bppbm($id){
        // BPPBM::whereIn('id', $request->ids)->update([
        //     'id_status_bppbm_awal' => 1
        // ]);

        BPPBM::where('id', $id)->update([
            'id_status_bppbm_awal' => 2
        ]);

        return response()->json([
            'status' => 1,
            'msg' => "Pengajuan BPPBM tidak disetujui"
        ]);

        // Produk::whereIn('id', $request->produk_ids)->update([
        //     'id_status_bppbm_awal' => 1
        // ]);

        // $produk_bppbm = BPPBM::whereIn('id', $request->ids)->get()->toArray();
        // foreach($request->ids as $data_bppbm){
        //     $data_produk_bppbm = BPPBM::where($data_bppbm['produk_id']);
        //     dd($data_produk_bppbm);
        // }
    }
}
