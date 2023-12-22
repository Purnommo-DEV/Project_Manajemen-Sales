<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class Admin_PenggunaController extends Controller
{
    public function halaman_pengguna()
    {
        $role = Roles::get(['id', 'role']);
        return view('Admin.Pengguna.data_pengguna', ['role' => $role]);
    }

    public function data_pengguna(Request $request)
    {
        $data = User::select([
            'users.*'
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
        $data = $data->with('relasi_role')->get();
        return response()->json([
            'draw' => $request->input('draw'),
            'data' => $data,
            'recordsTotal' => $rekamTotal,
            'recordsFiltered' => $rekamFilter
        ]);
    }

    public function tambah_data_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role_id' => 'required',
        ], [
            'nama.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'email.email' => 'Wajib diisi dengan type email @',
            'email.unique' => 'Email telah terdaftar',
            'password.required' => 'Wajib diisi',
            'role_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_pengguna = User::create([
                'kode'      => 'USR-' . Str::random('10'),
                'nama'      => $request->nama,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
                'role_id'   => $request->role_id,
            ]);

            if (!$tambah_pengguna) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Pengguna'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Pengguna'
                ]);
            }
        }
    }

    public function ubah_data_pengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'sometimes',
            'role_id' => 'required',
        ], [
            'nama.required' => 'Wajib diisi',
            'email.required' => 'Wajib diisi',
            'email.email' => 'Wajib diisi dengan type email @',
            'role_id.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $ubah_pengguna = User::where('id', $request->id)->first();
            if (!$request->password) {
                $password = $ubah_pengguna->password;
            } else {
                $password = Hash::make($request->password);
            }
            $ubah_pengguna = User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => $password,
                'role_id' => $request->role_id
            ]);

            if (!$ubah_pengguna) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Mengubah Data Pengguna'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Data Pengguna'
                ]);
            }
        }
    }

    public function hapus_data_pengguna($id)
    {
        $hapus_pengguna = User::find($id)->delete();
        if (!$hapus_pengguna) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Pengguna'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Pengguna'
            ]);
        }
    }
}
