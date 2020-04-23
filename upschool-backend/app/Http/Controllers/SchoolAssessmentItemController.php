<?php

namespace App\Http\Controllers;

use App\Course;
use App\Semester;
use App\StudentCourse;
use Illuminate\Http\Request;
use App\SchoolAssessmentItem;

class SchoolAssessmentItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $school_assessment_item = new SchoolAssessmentItem();
        $school_assessment_item->student_course_id = $request->student_course_id;
        $school_assessment_item->school_assessment_id = $request->school_assessment_id;
        $school_assessment_item->score = $request->score;
        $school_assessment_item->save();

        return response()->json([
            'status' => true,
            'message' => 'uploaded school assessment successfully',
            'data' => $school_assessment_item
        ], 201);
    }

    public function show(Request $request)
    {
        //
        $currentSemester = Semester::latest()->first();
        $course = Course::find($request->course_id);
        $student_courses = StudentCourse::whereCourseId($course->id)->whereSemesterId($currentSemester->id)->get()->load('school_assessment_items', 'student')->map(function ($item, $key) {
            return $item->only(['student', 'school_assessment_items']);
        });

        return response()->json([
            'status' => true,
            'message' => 'these are all the student assessments sumitted',
            'data' => $student_courses
        ], 201);

        // dd($student_courses->toArray());
        // $school_assessment_items = SchoolAssessmentItem::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolAssessmentItem  $schoolAssessmentItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolAssessmentItem $schoolAssessmentItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolAssessmentItem  $schoolAssessmentItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolAssessmentItem $schoolAssessmentItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolAssessmentItem  $schoolAssessmentItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolAssessmentItem $schoolAssessmentItem)
    {
        //
    }
}
