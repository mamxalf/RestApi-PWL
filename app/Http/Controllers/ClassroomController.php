<?php

namespace App\Http\Controllers;

use Validator;
use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClassroomController extends Controller
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
        $data = Classroom::all();

        return response()->json([
            'success' => TRUE,
            'message' => 'List Data Kelas!',
            'data'    => $data,
        ], 200);
    }


    public function detail($id)
    {
        $data = Classroom::where('classroom_id', $id)->first();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Kelas!',
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
            'school_id'      => 'required',
            'name'           => 'required',
            'total_students' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $new_classroom = new \App\Classroom();

            $new_classroom->school_id      = $request->input('school_id');
            $new_classroom->name           = $request->input('name');
            $new_classroom->total_students = $request->input('total_students');

            if ($new_classroom->save()) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $new_classroom,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $new_classroom,
                ], 400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::where('classroom_id', $id)->first();

        $classroom->school_id      = $request->input('school_id');
        $classroom->name           = $request->input('name');
        $classroom->total_students = $request->input('total_students');

        $classroom->save();

        if ($classroom) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data berhasil di Post',
                'data'    => $classroom,
            ], 201);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data gagal di Post',
                'data'    => $classroom,
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = Classroom::where('classroom_id', $id)->first();

        $data->delete();
        if ($data) {
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di Hapus !',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Data gagal di Hapus !'
            ], 400);
        }
    }

    public function listBySchool($id)
    {
        $data = Classroom::where('school_id', $id)->get();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Kelas Sekolah!',
                'data'      => $data
            ], 200);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data Tidak Ditemukan!',
            ], 404);
        }
    }
}
