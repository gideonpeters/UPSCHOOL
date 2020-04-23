<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\Semester;
use App\GradeItem;
use App\Gradelist;
use App\StudentCourse;
use Illuminate\Http\Request;

class GradelistController extends Controller
{

    public function index(Request $request)
    {
        //
        $gradelists = Gradelist::whereCourseId($request->course_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the gradelists for this course',
            'data' => $gradelists
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $currentSemester = Semester::latest()->first();

        $gradelist = new Gradelist();
        $gradelist->name = $request->name;
        $gradelist->total_score = $request->total_score;
        $gradelist->course_id = $request->course_id;
        $gradelist->semester_id =  $currentSemester->id;
        $gradelist->save();

        $student_courses = StudentCourse::whereCourseId($request->course_id)->whereSemesterId($currentSemester->id)->get();

        foreach ($student_courses as $key => $student_course) {
            # code...
            $grade_item = new GradeItem();
            $grade_item->gradelist_id = $gradelist->id;
            $grade_item->score = null;
            $grade_item->student_course_id = $student_course->id;
            $grade_item->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'new gradelist created for this course',
            'data' => $gradelist
        ], 201);
    }

    public function upload(Request $request, $id)
    {
        $json = $request->data;

        $data = json_decode(str_replace(']"', ']', str_replace('"[', '[', $json)), true);
        // dd($data);

        $gradelist = Gradelist::find($id);
        // dd($data);
        if (!$gradelist) {
            return response()->json([
                'status' => false,
                'message' => 'this gradelist does not exist for this course',
                'data' => []
            ], 201);
        }

        // $course = Course::find($gradelist->course_id);

        foreach ($data as $key => $datum) {
            # code...
            $student = Student::whereMatricNumber($datum['matric_number'])->first();
            $student_course = StudentCourse::whereCourseId($gradelist->course_id)->whereSemesterId($gradelist->semester_id)->whereStudentId($student->id)->first();
            $grade_item = GradeItem::whereStudentCourseId($student_course->id)->first();

            if ($datum['score'] <= $gradelist->total_score) {
                $grade_item->score = $datum['score'];
                $grade_item->save();
            } else {
                $grade_item->score = null;
                $grade_item->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'scores uploaded successfully',
            'data' => []
        ], 201);
    }

    public function show($id)
    {
        //
        $gradelist = Gradelist::find($id);

        if (!$gradelist) {
            return response()->json([
                'status' => false,
                'message' => 'this gradelist does not exist for this course',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'this is the gradelist for this course',
            'data' => $gradelist->load('grade_items')
        ], 201);
    }

    public function edit(Gradelist $gradelist)
    {
        //
    }

    public function update(Request $request, Gradelist $gradelist)
    {
        //
    }


    public function destroy($id)
    {
        //
        $gradelist = Gradelist::find($id);

        if (!$gradelist) {
            return response()->json([
                'status' => false,
                'message' => 'this gradelist does not exist for this course',
                'data' => []
            ], 201);
        }

        GradeItem::whereGradelistId($id)->delete();
        $gradelist->delete();

        return response()->json([
            'status' => true,
            'message' => 'deleted successfully',
            'data' => null
        ], 201);
    }
}
