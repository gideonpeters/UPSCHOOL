<?php

namespace App\Http\Controllers;

use App\Semester;
use App\Gradelist;
use Illuminate\Http\Request;

class GradelistController extends Controller
{

    public function index($id)
    {
        //
        $gradelists = Gradelist::whereCourseId($id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the gradelists for this course',
        ], 201);
    }

    public function store(Request $request)
    {
        //

        $gradelist = new Gradelist();
        $gradelist->name = $request->name;
        $gradelist->total_score = $request->total_score;
        $gradelist->course_id = $request->course_id;
        $gradelist->semester_id =  Semester::latest()->first()->id;
        $gradelist->save();

        return response()->json([
            'status' => true,
            'message' => 'new gradelist created for this course',
            'data' => $gradelist
        ], 201);
    }

    public function show(Gradelist $gradelist)
    {
        //
    }

    public function edit(Gradelist $gradelist)
    {
        //
    }

    public function update(Request $request, Gradelist $gradelist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gradelist  $gradelist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradelist $gradelist)
    {
        //
    }
}
