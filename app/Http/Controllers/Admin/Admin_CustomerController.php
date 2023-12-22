<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Storage;
use App\Models\User;
use App\Models\Customer;
use Milon\Barcode\DNS2D;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Admin_CustomerController extends Controller
{
    public function halaman_customer()
    {
        return view('Admin.Customer.customer');
    }

    public function data_customer(Request $request)
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

    public function tambah_data_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required|numeric|min:0',
            'jenis_customer' => 'required',
        ], [
            'nama.required' => 'Wajib diisi',
            'alamat.required' => 'Wajib diisi',
            'nomor_hp.numeric' => 'Wajib diisi dengan angka',
            'nomor_hp.min' => 'Inputan nomor hp minimal 0',
            'nomor_hp.required' => 'Wajib diisi',
            'jenis_customer.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {

            $tambacustomer = new Customer();
            $tambacustomer->kode = 'CS-' . Str::random(7);
            $tambacustomer->nama = $request->nama;
            $tambacustomer->alamat = $request->alamat;
            $tambacustomer->nomor_hp = $request->nomor_hp;
            $tambacustomer->jenis_customer = $request->jenis_customer;
            // Barcode
            $nama_file = $tambacustomer->nama . '.png';
            $penyimpanan = 'storage/barcode/' . $tambacustomer->kode . '-' . $nama_file;
            QrCode::size(300)->generate($tambacustomer->kode, $penyimpanan);
            $tambacustomer->barcode = 'barcode/' . $tambacustomer->kode . '-' . $nama_file;
            $tambacustomer->save();

            if (!$tambacustomer) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Customer'
                ]);
            }
        }
    }

    public function print_barcode_customer($kode)
    {
        $data_customer = Customer::where('kode', $kode)->first();
        return view('Admin.Customer.print_barcode', compact('data_customer'));
        // $pdf = Pdf::loadView('Admin.Customer.print_barcode', ['data_customer' => $data_customer])->setOptions(['defaultFont' => 'sans-serif']);
        // return $pdf->stream('Barcode' . $data_customer->kode . $data_customer->nama . '.pdf');
    }

    public function ubah_data_customer(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'required|numeric|min:0',
            'jenis_customer' => 'required',
        ], [
            'nama.required' => 'Wajib diisi',
            'alamat.required' => 'Wajib diisi',
            'nomor_hp.numeric' => 'Wajib diisi dengan angka',
            'nomor_hp.min' => 'Inputan nomor hp minimal 0',
            'nomor_hp.required' => 'Wajib diisi',
            'jenis_customer.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $ubah_data_customer = Customer::where('id', $request->id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'nomor_hp' => $request->nomor_hp,
                'jenis_customer' => $request->jenis_customer,
            ]);

            if (!$ubah_data_customer) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data Customer'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Mengubah Data Customer'
                ]);
            }
        }
    }

    public function hapus_data_customer($id)
    {
        $hapuscustomer = Customer::find($id)->delete();
        if (!$hapuscustomer) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Customer'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Customer'
            ]);
        }
    }

}
