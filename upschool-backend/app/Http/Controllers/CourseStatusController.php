<?php

namespace App\Http\Controllers;

use App\CourseStatus;
use Illuminate\Http\Request;

class CourseStatusController extends Controller
{
    public function index()
    {
        //
        $course_statuses = CourseStatus::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the course_statuses available in this university',
            'data' => $course_statuses,
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $course_status = new CourseStatus();

        $course_status->name = $request->name;
        $course_status->short_name = $request->short_name;
        $course_status->description = $request->description;

        $course_status->save();

        return response()->json([
            'status' => true,
            'message' => 'course status created successfully',
            'data' => $course_status
        ], 201);
    }

    public function show(CourseStatus $courseStatus, $id)
    {
        //
        $course_status = CourseStatus::find($id);

        if (!$course_status) {
            return response()->json([
                'status' => false,
                'message' => 'This course status does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved course status',
            'data' => $course_status
        ], 201);
    }

    public function update(Request $request, CourseStatus $courseStatus)
    {
        //
    }

    public function destroy(CourseStatus $courseStatus)
    {
        //
    }
}
