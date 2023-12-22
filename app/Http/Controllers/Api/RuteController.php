<?php

namespace App\Http\Controllers\Api;

use App\Models\Rute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RuteController extends Controller
{
    public function tambah_rute(Request $request)
    {
        $rute = Rute::create([
            // 'km_awal'       => $position->countryName . ',' . $position->cityName . ',' . $position->latitude . ',' . $position->longitude,
            'perjalanan_id' => $request->perjalanan_id,
            'customer_id'   => $request->customer_id,
            'status'        => 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => "Data Perjalanan Berhasil ditambahkan",
            'rute'    => $rute->id
        ]);
    }
}
