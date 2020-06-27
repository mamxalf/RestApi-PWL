<?php

namespace App\Http\Controllers;

use Validator;
use App\Input;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InputController extends Controller
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
        $data = Input::all();

        return response()->json([
            'success' => TRUE,
            'message' => 'List Data Input!',
            'data'    => $data,
        ], 200);
    }


    public function detail($id)
    {
        $data = Input::where('input_id', $id)->first();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Input!',
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
            'schedule_id' => 'required',
            'name'        => 'required',
            'file_name'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $new_input = new \App\Input();

            $new_input->schedule_id = $request->input('schedule_id');
            $new_input->name        = $request->input('name');
            $new_input->file_name   = $request->input('file_name');

            if ($new_input->save()) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $new_input,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $new_input,
                ], 400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $input = Input::where('input_id', $id)->first();

        $input->name        = $request->input('name');
        $input->schedule_id = $request->input('schedule_id');
        $input->file_name   = $request->input('file_name');

        $input->save();

        if ($input) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data berhasil di Post',
                'data'    => $input,
            ], 201);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data gagal di Post',
                'data'    => $input,
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = Input::where('input_id', $id)->first();

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

    public function listPicked($id)
    {
        $data = Input::where('schedule_id', $id)->get();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Input!',
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
