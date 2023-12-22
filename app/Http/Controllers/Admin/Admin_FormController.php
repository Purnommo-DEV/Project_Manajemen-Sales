<?php

namespace App\Http\Controllers\Admin;

use App\Models\FormSurvey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FormSurveyParameter;
use Illuminate\Support\Facades\Validator;

class Admin_FormController extends Controller
{
    public function halaman_form_survey(){
        $form_survey = FormSurvey::get();
        return view('Admin.Form.FormSurvey.form_survey', compact('form_survey'));
    }

    public function tambah_nama_form(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ], [
            'name.required' => 'Wajib diisi',
        ]);

        if (!$validator->passes()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->toArray()
            ]);
        } else {
            $tambah_nama_form = FormSurvey::create([
                'code'      => 'KS-' . Str::random('10'),
                'name'      => $request->name,
            ]);

            if (!$tambah_nama_form) {
                return response()->json([
                    'status' => 0,
                    'msg' => 'Terjadi kesalahan, Gagal Menambah Form Survey'
                ]);
            } else {
                return response()->json([
                    'status' => 1,
                    'msg' => 'Berhasil Menambahkan Form Survey'
                ]);
            }
        }
    }

    public function hapus_nama_form($id){
        $hapus_nama_form = FormSurvey::find($id)->delete();
        if (!$hapus_nama_form) {
            return response()->json([
                'status' => 0,
                'msg' => 'Terjadi kesalahan, Gagal Menghapus Form Survey'
            ]);
        } else {
            return response()->json([
                'status' => 1,
                'msg' => 'Berhasil Menghapus Data Form Survey'
            ]);
        }
    }

    public function tambah_nama_form_parameter(Request $request){
        $names = $request->input('name');
        $categorys = $request->input('category');

        for ($x = 0; $x < count($names); $x++) {
            $name = $names[$x];
            $category = $categorys[$x];

            $data_form_survey_parameter = FormSurveyParameter::count();
            FormSurveyParameter::create([
                'form_survey_id' => $request->id,
                'code'           => 'KSP-' . Str::random('10'),
                'label'           => $name,
                'category'       => $category,
                'sequence'       => $data_form_survey_parameter + 1
            ]);
        }
        return response()->json([
            'status' => 1,
            'msg'   => 'Berhasil Membuat Form Survey Parameter'
        ]);
    }
}
