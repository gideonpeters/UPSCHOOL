<?php

namespace App\Http\Controllers;

use App\Hall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HallController extends Controller
{
    public function index()
    {
        //
        $halls = Hall::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the halls',
            'data' => $halls
        ], 201);
    }

    public function store(Request $request)
    {
        //
    }

    public function storeBulk(Request $request)
    {
        $data = json_decode($request->data, true);
        // dd($data);
        DB::table('halls')->insertOrIgnore($data);

        return response()->json([
            'status' => true,
            'message' => 'Uploaded halls successfully',
            'data' => []
        ]);
    }

    public function show($id)
    {
        //
        $hall = Hall::find($id);

        if (!$hall) {
            return response()->json([
                'status' => false,
                'message' => 'hall does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'this is the hall',
            'data' => $hall
        ], 201);
    }

    public function edit(Hall $hall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hall $hall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hall  $hall
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hall $hall)
    {
        //
    }
}
