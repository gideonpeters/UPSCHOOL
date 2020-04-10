<?php

namespace App\Http\Controllers;

use App\Result;
use App\Semester;
use App\StudentCourse;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $results = Result::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the results',
            'data' => $results
        ], 201);
    }

    public function studentIndex(Result $result, $id)
    {
        //
        $results = Result::whereStudentId($id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the results for this student',
            'data' => $results
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish()
    {
        //
        $total_weighted_score = 109;
        $total_units = 22;
        $gpa = $total_weighted_score / $total_units;
        $cgpa = 4.90;

        $student_course = StudentCourse::find(1);
        $result = new Result();
        $result->student_id = $student_course->student_id;
        $result->semester_id = Semester::latest()->first()->id;
        $result->gpa = $gpa;
        $result->cgpa = $cgpa;
        $result->total_weighted_score = $total_weighted_score;
        $result->total_units = $total_units;

        $result->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function show(Result $result)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function edit(Result $result)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Result $result)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Result  $result
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        //
    }
}
