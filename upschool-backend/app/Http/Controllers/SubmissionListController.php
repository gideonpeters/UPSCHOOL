<?php

namespace App\Http\Controllers;

use App\Course;
use App\Student;
use App\Semester;
use App\StudentCourse;
use App\SubmissionList;
use Illuminate\Http\Request;

class SubmissionListController extends Controller
{
    public function index(Request $request)
    {
        //
        $course = Course::find($request->course_id);

        if (!$course) {
            return response()->json([
                'status' => false,
                'message' => 'course does not exist',
                'data' => []
            ], 201);
        }

        $submission_lists = SubmissionList::whereCourseId($request->course_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the submission lists for this course',
            'data' => $submission_lists->load('subsection')
        ], 201);
    }

    public function getUserSubmission()
    {
        //
        $user = auth()->user();

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'user does not exist',
                'data' => []
            ], 201);
        }

        if ($user && $user->userable_type == 'App\Student') {

            $student = Student::find($user->userable_id);

            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'student does not exist',
                    'data' => []
                ], 201);
            }

            $currentSemester = Semester::latest()->first();
            $student_courses = StudentCourse::whereStudentId($student->id)->whereSemesterId($currentSemester->id)->get();

            $course_ids = $student_courses->pluck('course_id')->all();

            $submission_lists = SubmissionList::whereIn('course_id', $course_ids)->get();

            return response()->json([
                'status' => true,
                'message' => 'these are all the submission lists for this user',
                'data' => $submission_lists->load('course', 'gradelist')
            ], 201);
        }

        // dd($submission_lists);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SubmissionList  $submissionList
     * @return \Illuminate\Http\Response
     */
    public function show(SubmissionList $submissionList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubmissionList  $submissionList
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmissionList $submissionList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubmissionList  $submissionList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmissionList $submissionList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubmissionList  $submissionList
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmissionList $submissionList)
    {
        //
    }
}
