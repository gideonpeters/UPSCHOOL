<?php

namespace App\Http\Controllers;

use App\Course;
use App\Semester;
use App\GradeItem;
use App\Gradelist;
use App\StudentCourse;
use App\SchoolAssessment;
use Illuminate\Http\Request;
use App\SchoolAssessmentItem;

class SchoolAssessmentController extends Controller
{
    public function index(Request $request)
    {
        //
        if ($request->course_id) {
            $course = Course::find($request->course_id);

            if (!$course) {
                return response()->json([
                    'status' => false,
                    'message' => 'course not found',
                    'data' => []
                ], 201);
            }

            $school_assessments = SchoolAssessment::whereNull('course_id')->orWhere('course_id', $course->id)->get();
        } else {
            $school_assessments = SchoolAssessment::all();
        }

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

        $grade_items = GradeItem::whereIn('gradelist_id', $json)->get()->load('gradelist')->groupBy('student_course_id');

        $arr = array();
        // dd($grade_items->toArray());

        foreach ($grade_items as $key => $grade_item) {
            # code...
            switch ($action) {
                case 'sum':
                    # code...
                    $score = $grade_item->sum('score');
                    $total_score = $grade_item->sum('gradelist.total_score');
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                case 'average':
                    # code...
                    $score = $grade_item->avg('score');
                    $total_score = $grade_item->avg('gradelist.total_score');
                    $score = ($score / $total_score) * $school_assessment->total_score;
                    break;
                case 'max':
                    # code...
                    $maxscore = $grade_item->flatten()->transform(function ($item, $key) {
                        return $item->score / $item->gradelist->total_score;
                    })->max();

                    $total_score = $grade_item->flatten()->filter(function ($item, $key) use ($maxscore) {
                        return ($item->score / $item->gradelist->total_score) == $maxscore;
                    })->first()->gradelist->total_score;

                    $score = $maxscore  * $school_assessment->total_score;
                    break;
                case 'min':
                    # code...
                    $minscore = $grade_item->flatten()->transform(function ($item, $key) {
                        return $item->score / $item->gradelist->total_score;
                    })->min();

                    $total_score = $grade_item->flatten()->filter(function ($item, $key) use ($minscore) {
                        return ($item->score / $item->gradelist->total_score) == $minscore;
                    })->first()->gradelist->total_score;

                    $score = $minscore * $school_assessment->total_score;
                    break;
                default:
                    # code...
                    $score = $grade_item->sum('score');
                    $total_score = $grade_item->sum('gradelist.total_score');
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

            // array_push($arr, $grade_tt);
        }
        // dd($arr);

        return response()->json([
            'status' => true,
            'message' => 'school assessment uploaded successfully',
            'data' => []
        ], 201);
    }

    public function show(Request $request, $id)
    {
        //
        $school_assessment = SchoolAssessment::with('school_assessment_items', 'school_assessment_items.student_course')->find($id);
        if (!$school_assessment) {
            return response()->json([
                'status' => false,
                'message' => 'assessment not found',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'school assessment found',
            'data' => $school_assessment
        ], 201);
    }

    public function storeCourse(Request $request)
    {
        //
        $course = Course::find($request->course_id);
        $currentSemester = Semester::latest()->first();

        $school_assessment = new SchoolAssessment();

        $school_assessment->name = $request->name;
        $school_assessment->total_score = $request->total_score;
        $school_assessment->course_id = $course->id;
        $school_assessment->percentage = $request->percentage;

        $school_assessment->save();

        $student_courses = StudentCourse::whereSemesterId($currentSemester->id)->whereCourseId($course->id)->get();

        foreach ($student_courses as $key => $student_course) {
            # code...
            $school_assessment_item = new SchoolAssessmentItem();
            $school_assessment_item->school_assessment_id = $school_assessment->id;
            // $school_assessment_item->score = 0;
            $school_assessment_item->student_course_id = $student_course->id;
            $school_assessment_item->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'school assessment created for the course',
            'data' => $school_assessment
        ], 201);
    }

    public function getCourse(Request $request)
    {
        $course = Course::find($request->course_id);
        $school_assessments = SchoolAssessment::whereCourseId($course->id)->get;

        return response()->json([
            'status' => true,
            'message' => 'school assessment specific for the course',
            'data' => $school_assessments
        ], 201);
    }

    public function update(Request $request, SchoolAssessment $schoolAssessment)
    {
        //
    }

    public function destroy(SchoolAssessment $schoolAssessment)
    {
        //
    }
}
