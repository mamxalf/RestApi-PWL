<?php

namespace App\Http\Controllers;

use Validator;
use App\Fotografer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Auth\EloquentUserProvider;
// use Illuminate\Support\Facades\DB;


class FotograferController extends Controller
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
        $data = Fotografer::all();

        return response()->json([
            'success' => TRUE,
            'message' => 'List Data Fotografer!',
            'data'    => $data,
        ], 200);
    }


    public function detail($id)
    {
        $data = Fotografer::where('fotografer_id', $id)->first();

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
            'name'     => 'required',
            'username' => 'required|min:5',
            'email'    => 'required|unique:fotografers',
            'password' => 'required',
            'kontak'   => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $new_fotografer = new \App\Fotografer();

            $new_fotografer->name     = $request->input('name');
            $new_fotografer->username = $request->input('username');
            $new_fotografer->email    = $request->input('email');
            $new_fotografer->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
            $new_fotografer->kontak   = $request->input('kontak');
            $new_fotografer->alamat   = $request->input('alamat');
            $new_fotografer->foto     = $request->input('foto');

            if ($new_fotografer->save()) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $new_fotografer,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $new_fotografer,
                ], 400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name'     => 'required',
            'email'    => 'required',
            'kontak'   => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $fotografer = Fotografer::where('fotografer_id', $id)->first();
            
            $fotografer->name     = $request->input('name');
            $fotografer->username = $request->input('username');
            $fotografer->email    = $request->input('email');
            $fotografer->password = password_hash($request->input('password'), PASSWORD_BCRYPT);
            $fotografer->kontak   = $request->input('kontak');
            $fotografer->alamat   = $request->input('alamat');
            $fotografer->foto     = $request->input('foto');
    
            $fotografer->save();
    
            if ($fotografer) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $fotografer,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $fotografer,
                ], 400);
            }
        }
    }

    public function destroy($id)
    {
        $data = Fotografer::where('fotografer_id', $id)->first();

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
