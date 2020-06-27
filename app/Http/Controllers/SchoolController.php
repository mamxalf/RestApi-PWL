<?php

namespace App\Http\Controllers;

use Validator;
use App\School;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SchoolController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     //
    // }

    //
    public function list()
    {
        $data = School::all();

        return response()->json([
            'success' => TRUE,
            'message' => 'List Data Sekolah!',
            'data'    => $data,
        ], 200);
    }


    public function detail($id)
    {
        $data = School::where('school_id', $id)->first();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Fotografer!',
                'data'      => $data
            ], 200);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data Tidak Ditemukan!',
            ], 404);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'name'             => 'required',
            'total_classrooms' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $new_school = new \App\School();

            $new_school->name     = $request->input('name');
            $new_school->total_classrooms = $request->input('total_classrooms');

            if ($new_school->save()) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $new_school,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $new_school,
                ], 400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $school = School::where('school_id', $id)->first();

        $school->name             = $request->input('name');
        $school->total_classrooms = $request->input('total_classrooms');

        $school->save();

        if ($school) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data berhasil di Post',
                'data'    => $school,
            ], 201);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data gagal di Post',
                'data'    => $school,
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = School::where('school_id', $id)->first();

        $data->delete();
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di Hapus !'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data gagal di Hapus !'
            ], 400);
        }
    }
}
