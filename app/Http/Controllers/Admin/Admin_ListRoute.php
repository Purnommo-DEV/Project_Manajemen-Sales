<?php

namespace App\Http\Controllers\Admin;

use App\Models\Rute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailInsentif;
use App\Models\DetailRetur;
use App\Models\DetailTransaksi;
use App\Models\Kunjungan;
use App\Models\StokVisibility;

class Admin_ListRoute extends Controller
{
    public function halaman_list_rute(){
        return view('Admin.Route.list_rute');
    }

    public function data_list_rute(Request $request)
    {
        $data = Rute::select([
            'rute.*'
        ])->with('relasi_customer', 'relasi_perjalanan')->orderBy('created_at', 'desc');


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

    public function detail_rute_plan($id){
        return view('Admin.Route.list_detail_rute', compact('id'));
    }

    public function data_kunjungan_rute_id(Request $request, $id){
        $data = Kunjungan::select([
            'kunjungan.*'
        ])->with('relasi_status_kunjungan', 'relasi_alasan_batal')->where('id_rute', $id)->orderBy('created_at', 'desc');


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

    public function data_detail_insentif(Request $request, $id){
        $data = DetailInsentif::select([
            'detail_insentif.*'
        ])->with('relasi_customer')->where('kunjungan_id', $id);


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

    public function data_detail_retur(Request $request, $id){
        $data = DetailRetur::select([
            'detail_retur.*'
        ])->with('relasi_customer')->where('kunjungan_id', $id)->orderBy('created_at', 'desc');


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

    public function data_detail_penjualan(Request $request, $id){
        $data = DetailTransaksi::select([
            'detail_transaksi.*'
        ])->with('relasi_customer')->where('kunjungan_id', $id)->orderBy('created_at', 'desc');


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

    public function detail_stok_visibility(Request $request, $id){
        $data = StokVisibility::select([
            'stok_visibility.*'
        ])->with('relasi_kondisi_pemajangan')->where('kunjungan_id', $id)->orderBy('created_at', 'desc');


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
}
