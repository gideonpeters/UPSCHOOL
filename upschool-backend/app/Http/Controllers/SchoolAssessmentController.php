<?php

namespace App\Http\Controllers;

use App\Semester;
use App\GradeItem;
use App\Gradelist;
use App\StudentCourse;
use App\SchoolAssessment;
use Illuminate\Http\Request;
use App\SchoolAssessmentItem;

class SchoolAssessmentController extends Controller
{
    public function index()
    {
        //
        $school_assessments = SchoolAssessment::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the school assessment items',
            'data' => $school_assessments
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $currentSemester = Semester::latest()->first();

        $school_assessment = new SchoolAssessment();

        $school_assessment->name = $request->name;
        $school_assessment->total_score = $request->total_score;

        $school_assessment->save();

        $student_courses = StudentCourse::whereSemesterId($currentSemester->id)->get();

        foreach ($student_courses as $key => $student_course) {
            # code...
            $school_assessment_item = new SchoolAssessmentItem();
            $school_assessment_item->school_assessment_id = $school_assessment->id;
            $school_assessment_item->score = null;
            $school_assessment_item->student_course_id = $student_course->id;
            $school_assessment_item->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'school assessment created for the school',
            'data' => $school_assessment
        ], 201);
    }

    public function upload(Request $request)
    {
        $school_assessment = SchoolAssessment::find($request->school_assessment_id);
        // $currentSemester = Semester::latest()->first();

        $json = json_decode($request->ids, true);
        $action = strtolower($request->action);

        $grade_items = GradeItem::whereIn('gradelist_id', $json)->get()->groupBy('student_course_id');

        // $arr = array();

        foreach ($grade_items as $key => $grade_item) {
            # code...
            $grade_item->load('gradelist');

            switch ($action) {
                case 'sum':
                    # code...
                    $score = $grade_item->sum('score');
                    $total_score = $grade_item->gradelist->sum('total_score');
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                case 'average':
                    # code...
                    $score = $grade_item->avg('score');
                    $total_score = $grade_item->gradelist->avg('total_score');
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                case 'max':
                    # code...
                    $score = $grade_item->max('score');
                    $total_score = $grade_item->gradelist->total_score;
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                case 'min':
                    # code...
                    $score = $grade_item->min('score');
                    $total_score = $grade_item->gradelist->total_score;
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                default:
                    # code...
                    $score = $grade_item->sum('score');
                    $total_score = $grade_item->gradelist->sum('total_score');
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
            }

            $existing_school_assessment_item = SchoolAssessmentItem::whereSchoolAssessmentId($school_assessment->id)->whereStudentCourseId($key)->first();

            if ($existing_school_assessment_item) {
                $existing_school_assessment_item->score = $score;
                $existing_school_assessment_item->save();
            } else {
                $school_assessment_item = new SchoolAssessmentItem();
                $school_assessment_item->student_course_id = $key;
                $school_assessment_item->school_assessment_id = $school_assessment->id;
                $school_assessment_item->score = $score;
                $school_assessment_item->save();
            }

            // array_push($arr, $key);
        }

        return response()->json([
            'status' => true,
            'message' => 'school assessment uploaded successfully',
            'data' => []
        ], 201);
    }

    public function show(SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolAssessment $schoolAssessment)
    {
        //
    }
}
