<?php

namespace App\Http\Controllers;

use App\File;
use App\Course;
use App\Student;
use App\Semester;
use App\GradeItem;
use App\Gradelist;
use App\StudentCourse;
use App\SubmissionItem;
use App\SubmissionList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionItemController extends Controller
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

    public function submit(Request $request)
    {
        //
        $submission_list = SubmissionList::find($request->submission_list_id);

        if (!$submission_list) {
            return response()->json([
                'status' => false,
                'message' => 'submission does not exist',
                'data' => []
            ], 201);
        }

        $gradelist = Gradelist::find($submission_list->gradelist_id);
        $currentSemester = Semester::latest()->first();

        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => []
            ], 201);
        }

        $student_course = StudentCourse::whereStudentId($student->id)->whereCourseId($submission_list->course_id)->whereSemesterId($currentSemester->id)->first();
        $course_code  = Course::find($student_course->course_id)->course_code;

        if (!$student_course) {
            return response()->json([
                'status' => false,
                'message' => 'you are not enrolled for this course',
                'data' => []
            ], 201);
        }

        $grade_item = GradeItem::whereGradelistId($gradelist->id)->whereStudentCourseId($student_course->id)->first();

        $submission_item = new SubmissionItem();
        $submission_item->submission_list_id = $submission_list->id;
        $submission_item->body = $request->body;
        $submission_item->student_course_id = $student_course->id;
        $submission_item->grade_item_id = $grade_item->id;
        $submission_item->save();

        if ($request->hasFile('file')) {
            $path = Storage::putFileAs(
                "documents/course-submissions/$course_code/$gradelist->name",
                $request->file('file'),
                preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $request->name)) . '.' . $request->file('file')->getClientOriginalExtension()
            );

            $file = new File();
            $file->name = $request->file('file')->getClientOriginalName();
            $file->type = $request->file('file')->getClientMimeType();
            $file->path = $path;
            $file->fileable_id = $submission_item->id;
            $file->fileable_type = 'App\SubmissionItem';

            $file->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'submitted successfully',
            'data' => $submission_item
        ], 201);
    }

    public function grade(Request $request)
    {
        //
        $submission_item = SubmissionItem::find($request->submission_item_id);
        // $submission_item->with('student');


        if (!$submission_item) {
            return response()->json([
                'status' => false,
                'message' => 'submission does not exist',
                'data' => []
            ], 201);
        }

        $currentSemester = Semester::latest()->first();
        $submission_list = SubmissionList::find($submission_item->submission_list_id);
        $student = $submission_item->student;

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => []
            ], 201);
        }

        $student_course = StudentCourse::whereStudentId($student->id)->whereCourseId($submission_list->course_id)->whereSemesterId($currentSemester->id)->first();
        $grade_item = GradeItem::find($submission_item->grade_item_id);

        if (!$grade_item) {
            $grade_item = new GradeItem();
            $grade_item->gradelist_id = $submission_list->gradelist_id;
            $grade_item->student_course_id = $student_course->id;
            $grade_item->save();
        }

        if ($request->score) {
            $grade_item->score = $request->score;
            $grade_item->save();
        }

        if ($request->review) {
            $submission_item->review = $request->review;
            $submission_item->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'submission graded successfully',
            'data' => []
        ], 201);
    }

    public function show($id)
    {
        //
        $submission_list = SubmissionList::find($id);

        if (!$submission_list) {
            return response()->json([
                'status' => false,
                'message' => 'submission list not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'these are all the submissions made for this list',
            'data' => $submission_list->load('submission_items', 'gradelist')
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SubmissionItem  $submissionItem
     * @return \Illuminate\Http\Response
     */
    public function edit(SubmissionItem $submissionItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SubmissionItem  $submissionItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubmissionItem $submissionItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SubmissionItem  $submissionItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubmissionItem $submissionItem)
    {
        //
    }
}
