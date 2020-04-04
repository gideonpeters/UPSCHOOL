<?php

namespace App\Http\Controllers;

use App\Curriculum;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        //
        $curricula = Curriculum::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the curricula',
            'data' => $curricula
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $curriculum = new Curriculum();

        $curriculum->program_id = $request->program_id;
        $curriculum->level = $request->level;

        $curriculum->save();

        return response()->json([
            'status' => true,
            'message' => 'curriculum created successfully',
            'data' => $curriculum
        ], 201);
    }

    public function show(Curriculum $curriculum, $id)
    {
        //
        $curriculum = Curriculum::find($id);

        if (!$curriculum) {
            return response()->json([
                'status' => false,
                'message' => 'This curriculum does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved curriculum',
            'data' => $curriculum
        ], 201);
    }

    public function edit(Curriculum $curriculum)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Curriculum $curriculum)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Curriculum  $curriculum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Curriculum $curriculum)
    {
        //
    }
}
