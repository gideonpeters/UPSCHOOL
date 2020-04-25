<?php

namespace App\Http\Controllers;

use App\SubmissionList;
use Illuminate\Http\Request;

class SubmissionListController extends Controller
{
    public function index(Request $request)
    {
        //
        $submission_lists = SubmissionList::whereCourseId($request->course_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the submission lists for this course',
            'data' => $submission_lists->load('subsection')
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
