<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        //
        $courses = Course::all();
        // $courses->withPath('custom');

        return response()->json([
            'status' => true,
            'message' => 'these are all the courses',
            'data' => $courses->load('facilitators', 'prerequisites', 'participants',)
        ], 201);
    }


    public function store(Request $request)
    {
        //
        $course = new Course();

        $course->title = $request->title;
        $course->course_code = $request->course_code;

        $course->venue = $request->venue;
        $course->description = $request->description;

        // $course->staff_id = $request->staff_id;
        $course->prerequisite_id = $request->prerequisite_id;
        $course->semester_type_id = $request->semester_type_id;

        $course->save();

        // $facilitators = Staff::find($request->staff_id);

        $course->facilitators()->attach($request->staff_id);
        $course->prerequisites()->attach($request->prerequisite_id);

        return response()->json([
            'status' => true,
            'message' => 'course created successfully',
            'data' => $course
        ], 201);
    }

    public function show(Course $course, $id)
    {
        //
        $course = Course::find($id);

        // dd($course->curriculum_items);

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'This course does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved course',
            'data' => $course->load('facilitators', 'prerequisites', 'participants')
        ], 201);
    }

    public function indexParticipants($id)
    {
        $course = Course::find($id);
        // dd($course);

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'This course does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved participants for this course',
            'data' => $course->participants
        ], 201);
    }

    public function storeBulk(Request $request)
    {
        $data = json_decode($request->data, true);
        // dd($data);
        DB::table('courses')->insertOrIgnore($data);

        return response()->json([
            'status' => true,
            'message' => 'Uploaded courses successfully',
            'data' => $data
        ]);
        // dd($request->data);
    }

    public function getFacilitatedCourses(Request $request)
    {
        $staff = Staff::find($request->staff_id);

        if (!$staff) {
            return response()->json([
                'status' => false,
                'message' => 'This staff does not exist',
                'data' => null
            ], 201);
        }

        $courses = $staff->courses_facilitating;

        return response()->json([
            'status' => true,
            'message' => 'These are all the courses you\'re facilitating',
            'data' => $courses
        ], 201);
    }


    public function update(Request $request, Course $course)
    {
        //
    }

    public function destroy(Course $course)
    {
        //
    }
}
