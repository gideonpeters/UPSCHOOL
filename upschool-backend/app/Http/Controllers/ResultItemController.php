<?php

namespace App\Http\Controllers;

use App\Semester;
use App\GradeScore;
use App\ResultItem;
use App\StudentCourse;
use Illuminate\Http\Request;

class ResultItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request)
    {
        //
        $currentSemester = Semester::latest()->first();
        // $studentCourses = StudentCourse::whereSemesterId($currentSemester->id);
        $student_course = $request->student_course_id ? StudentCourse::whereSemesterId($currentSemester->id)
            ->whereCourseId($request->course_id)
            ->whereStudentId($request->student_id)->first() : StudentCourse::find($request->student_course_id);

        if ($student_course) {
            $resultItem = new ResultItem();
            $resultItem->semester_id = $currentSemester->id;
            $resultItem->student_course_id = $student_course->id;
            $resultItem->exam_score = 60;
            $resultItem->ca_score = 15;
            $score = 75;

            $grade_scores = GradeScore::all();
            foreach ($grade_scores as $v => $grade_score) {
                # code...
                if (($grade_score->min <= $score) && ($score <= $grade_score->max)) {
                    $resultItem->grade_score = $grade_score->name;
                    $resultItem->weighted_score = $student_course->curriculum_item()->credit_units * $grade_score->points;
                    return;
                };
                // return $resultItem->grade_score = 'I/R';
            }
            $resultItem->save();

            return response()->json([
                'status' => true,
                'message' => 'result published successfully',
                'data' => $resultItem
            ], 201);
        }
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
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function show(ResultItem $resultItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultItem $resultItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultItem $resultItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultItem $resultItem)
    {
        //
    }
}
