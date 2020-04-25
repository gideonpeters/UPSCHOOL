<?php

namespace App\Http\Controllers;

use App\GradeItem;
use App\Semester;
use App\Gradelist;
use App\StudentCourse;
use App\SubmissionItem;
use App\SubmissionList;
use Illuminate\Http\Request;

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
        $gradelist = Gradelist::find($submission_list->gradelist_id);
        $currentSemester = Semester::latest()->first();

        $student_course = StudentCourse::whereStudentId($request->student_id)->whereCourseId($submission_list->course_id)->whereSemesterId($currentSemester->id)->first();
        $grade_item = GradeItem::whereStudentCourseId($student_course->id)->first();

        $submission_item = new SubmissionItem();
        $submission_item->body = $request->body;
        $submission_item->student_course_id = $student_course->id;
        $submission_item->grade_item_id = $grade_item->id;
        $submission_item->save();
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
     * @param  \App\SubmissionItem  $submissionItem
     * @return \Illuminate\Http\Response
     */
    public function show(SubmissionItem $submissionItem)
    {
        //
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
