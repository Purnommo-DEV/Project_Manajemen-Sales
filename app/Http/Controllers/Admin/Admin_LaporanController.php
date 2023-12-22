<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use App\Models\Rute;
use App\Models\BPPBM;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Customer;
use App\Models\Transaksi;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\StatusPesanan;
use App\Models\TransaksiDetail;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;

class Admin_LaporanController extends Controller
{
    // LAPORAN STOK PRODUK
    public function halaman_laporan_stok_produk(){
        return view('Admin.Laporan.stok_produk');
    }

    public function data_laporan_stok_produk(Request $request){
        $data = Produk::select([
            'produk.*'
        ])->orderBy('created_at', 'desc');

        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(nama_produk) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            })->orWhere(function ($q2) use ($request) {
                $q2->whereRaw('LOWER(kode) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            });
        }

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

    // LAPORAN BPPBM
    public function halaman_laporan_bppbm(){
        return view('Admin.Laporan.bppbm');
    }

    public function data_laporan_bppbm(Request $request)
    {
        $data = Perjalanan::select([
            'perjalanan.*'
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

    public function detail_data_laporan_bppbm(Request $request, $perjalanan_id){
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

    public function print_detail_data_laporan_bppbm($perjalanan_id){
        $perjalanan = Perjalanan::with('relasi_sales', 'relasi_kendaraan')->where('id', $perjalanan_id)->first();
        $bppbm = BPPBM::with('relasi_perjalanan', 'relasi_produk')->where('perjalanan_id', $perjalanan_id)->get();
        $print_data = PDF::loadView('Admin.Laporan.print_laporan_bppbm', [
            'bppbm' => $bppbm,
            'perjalanan' => $perjalanan
        ])->setPaper("A4", "portrait")->setOptions(['defaultFont' => 'sans-serif']);
    	return $print_data->stream('laporan_bppbm.pdf');
    }

    // LAPORAN PERJALANAN
    public function halaman_laporan_perjalanan(){
        return view('Admin.Laporan.perjalanan');
    }

    public function data_laporan_perjalanan(Request $request)
    {
        $data = Perjalanan::select([
            'perjalanan.*'
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

    public function detail_data_laporan_perjalanan(Request $request, $perjalanan_id){
        $data = Rute::select([
            'rute.*'
        ])->with('relasi_perjalanan', 'relasi_customer')->where('perjalanan_id', $perjalanan_id);


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

    // LAPORAN TRANSAKSI
    public function halaman_laporan_transaksi(){
        return view('Admin.Laporan.transaksi');
    }

    public function data_laporan_transaksi(Request $request)
    {
        $data = DetailTransaksi::select([
            'detail_transaksi.*'
        ])->with('relasi_bppbm.relasi_produk','relasi_customer');

        // $data = Transaksi::select([
        //     'transaksi.*'
        // ])->with('relasi_perjalanan','relasi_perjalanan.relasi_sales','relasi_customer');

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

    // public function detail_data_laporan_transaksi(Request $request, $transaksi_id){
    //     $data = TransaksiDetail::select([
    //         'transaksi_detail.*'
    //     ])->with('relasi_transaksi', 'relasi_produk')->where('transaksi_id', $transaksi_id);


    //     $rekamFilter = $data->get()->count();
    //     if ($request->input('length') != -1)
    //         $data = $data->skip($request->input('start'))->take($request->input('length'));
    //     $rekamTotal = $data->count();
    //     $data = $data->get();

    //     return response()->json([
    //         'draw' => $request->input('draw'),
    //         'data' => $data,
    //         'recordsTotal' => $rekamTotal,
    //         'recordsFiltered' => $rekamFilter
    //     ]);
    // }

    // LAPORAN CUSTOMER
    public function halaman_laporan_customer(){
        return view('Admin.Laporan.customer');
    }

    public function data_laporan_customer(Request $request)
    {
        $data = Customer::select([
            'customer.*'
        ])->orderBy('id', 'desc');

        if ($request->input('search.value') != null) {
            $data = $data->where(function ($q) use ($request) {
                $q->whereRaw('LOWER(nama) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhere->whereRaw('LOWER(alamat) like ?', ['%' . strtolower($request->input('search.value')) . '%'])
                    ->orWhere->whereRaw('LOWER(nomor_hp) like ?', ['%' . strtolower($request->input('search.value')) . '%']);
            });
        }

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
