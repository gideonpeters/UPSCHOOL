<?php

namespace App\Http\Controllers;

use App\ExeatType;
use Illuminate\Http\Request;

class ExeatTypeController extends Controller
{
    public function index()
    {
        //
        $exeat_types = ExeatType::all();

        return response()->json([
            'status' => true,
            'message' => 'These are all the exeat types',
            'data' => $exeat_types
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $exeat_type = new ExeatType();
        $exeat_type->name = $request->name;
        $exeat_type->description = $request->description;
        $exeat_type->metric = $request->metric;
        $exeat_type->duration = $request->duration;

        $exeat_type->save();

        return response()->json([
            'status' => true,
            'message' => 'exeat type created successfully',
            'data' => $exeat_type
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExeatType  $exeatType
     * @return \Illuminate\Http\Response
     */
    public function show(ExeatType $exeatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExeatType  $exeatType
     * @return \Illuminate\Http\Response
     */
    public function edit(ExeatType $exeatType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExeatType  $exeatType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExeatType $exeatType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExeatType  $exeatType
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExeatType $exeatType)
    {
        //
    }
}
