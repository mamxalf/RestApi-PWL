<?php

namespace App\Http\Controllers;

use Validator;
use App\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ScheduleController extends Controller
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
        $data = Schedule::all();

        return response()->json([
            'success' => TRUE,
            'message' => 'List Data Jadwal!',
            'data'    => $data,
        ], 200);
    }


    public function detail($id)
    {
        $data = Schedule::where('schedule_id', $id)->first();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Detail Data Jadwal!',
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
            'classroom_id'  => 'required',
            'location'      => 'required',
            'date'          => 'required',
            'time'          => 'required',
            'status'        => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => FALSE,
                'message' => $validator->errors(),
            ], 401);
        } else {
            $new_schedule = new \App\Schedule();

            $new_schedule->fotografer_id = $request->input('fotografer_id');
            $new_schedule->classroom_id  = $request->input('classroom_id');
            $new_schedule->location      = $request->input('location');
            $new_schedule->date          = $request->input('date');
            $new_schedule->time          = $request->input('time');
            $new_schedule->status        = $request->input('status');

            if ($new_schedule->save()) {
                return response()->json([
                    'success' => TRUE,
                    'message' => 'Data berhasil di Post',
                    'data'    => $new_schedule,
                ], 201);
            } else {
                return response()->json([
                    'success' => FALSE,
                    'message' => 'Data gagal di Post',
                    'data'    => $new_schedule,
                ], 400);
            }
        }
    }

    public function update(Request $request, $id)
    {
        $schedule = Schedule::where('schedule_id', $id)->first();

        $schedule->fotografer_id = $request->input('fotografer_id');
        $schedule->location      = $request->input('location');
        $schedule->classroom_id  = $request->input('classroom_id');
        $schedule->time          = $request->input('time');
        $schedule->date          = $request->input('date');
        $schedule->status        = $request->input('status');

        $schedule->save();

        if ($schedule) {
            return response()->json([
                'success' => TRUE,
                'message' => 'Data berhasil di Post',
                'data'    => $schedule,
            ], 201);
        } else {
            return response()->json([
                'success' => FALSE,
                'message' => 'Data gagal di Post',
                'data'    => $schedule,
            ], 400);
        }
    }

    public function destroy($id)
    {
        $data = Schedule::where('schedule_id', $id)->first();

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

    public function listByPicked($id)
    {
        $data = Schedule::where('fotografer_id', $id)->get();

        if ($data) {
            return response()->json([
                'success'   => TRUE,
                'message'   => 'Data Jadwal yang sudah di Ambil!',
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
