<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {

        // if (Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {

        //     if (auth()->user()->relasi_role->role == 'admin') {
        //         $auth = Auth::user();
        //         $success['token'] = $auth->createToken('auth_token')->plainTextToken;
        //         $success['name'] = $auth->name;

        //         return response()->json([
        //             'status'  => 1,
        //             'success' => true,
        //             'message' => 'Login Admin Berhasil',
        //             'data'    => $success,
        //             'route' => route('admin.Dashboard')

        //         ]);
        //     }
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => "Periksa kembali Email dan Password anda",
        //         'data'    => null
        //     ]);
        // }


        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->relasi_role->role == 'admin') {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil login sebagai Admin !',
                    'route' => route('admin.Dashboard')
                ]);
            }
            elseif (auth()->user()->relasi_role->role == 'spv') {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil login sebagai Supervisor !',
                    'route' => route('supervisor.HalamanPengajuanBPPBM')
                ]);
            }
            // elseif (auth()->user()->relasi_role->role == 'sales_ws') {
            //     return response()->json([
            //         'status' => 1,
            //         'msg' => 'Berhasil login sebagai Marketing !',
            //         'route' => route('salesW.Dashboard')
            //     ]);
            // } elseif (auth()->user()->relasi_role->role == 'spv') {
            //     return response()->json([
            //         'status' => 1,
            //         'msg' => 'Berhasil login sebagai Peninjau !',
            //         'route' => route('spv.Dashboard')
            //     ]);
            // }
            elseif (auth()->user()->relasi_role->role == 'gudang') {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil login sebagai Peninjau !',
                    'route' => route('gudang.Dashboard')
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'msg' => 'Login gagal, Username / password salah !',
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('Login');
    }

    public function register(){
        return view('register');
    }

    public function register_akun(Request $request){
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
                    'msg' => 'Berhasil Mendaftarkan Akun',
                    'route' => route('Login')
                ]);
            }
        }
    }
}
