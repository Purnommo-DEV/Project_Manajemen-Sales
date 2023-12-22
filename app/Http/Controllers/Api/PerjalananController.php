<?php

namespace App\Http\Controllers\Api;

use App\Models\Rute;
use App\Models\Perjalanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stevebauman\Location\Facades\Location;

class PerjalananController extends Controller
{
    public function perjalanan(Request $request)
    {
        $clientIP = "114.5.16.107";
        $position = Location::get($clientIP);

        $perjalanan = Perjalanan::create([
            // 'km_awal'       => $position->countryName . ',' . $position->cityName . ',' . $position->latitude . ',' . $position->longitude,
            'user_sales_id' => $request->user_sales_id,
            'km_awal'       => $request->km_awal,
            'km_akhir'      => $request->km_akhir,
            'kendaraan_id'  => $request->kendaraan_id,
            'list_rute'     => json_encode($request->list_rute),
        ]);

        return response()->json([
            'success'   => true,
            'message'   => "Data Perjalanan Berhasil ditambahkan",
            'perjalanan' => $perjalanan->id
        ]);
    }

    public function list_customer_tujuan($sales_id, $perjalanan_id)
    {
        $data_perjalanan = Perjalanan::where('user_sales_id', $sales_id)->where('id', $perjalanan_id)->first();
        $customer_tujuan = Rute::with('relasi_customer')->where('perjalanan_id', $data_perjalanan->id)->get();

        return response()->json([
            'customer_tujuan' => $customer_tujuan,
            'data_perjalanan' => $data_perjalanan
        ]);
    }
    public function list_perjalanan_sales($sales_id)
    {
        $list_perjalanan = Perjalanan::where('user_sales_id', $sales_id)->get();

        return response()->json([
            'data' => $list_perjalanan,
        ]);
    }
}
