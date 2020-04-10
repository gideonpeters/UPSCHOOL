<?php

namespace App\Http\Controllers;

use App\ContinuousAssessment;
use Illuminate\Http\Request;

class ContinuousAssessmentController extends Controller
{
    public function index($id)
    {
        //
        $continuous_assessments = ContinuousAssessment::whereCourseId($id);

        return response()->json([
            'status' => true,
            'message' => 'these are all the CAs for this course',
            'data' => $continuous_assessments
        ], 201);
    }

    public function upload_scores(Request $request)
    {
        //

        $continuous_assessment = new ContinuousAssessment();

        $continuous_assessment->continuous_assessment_id = $request->continuous_assessment_id;
        $continuous_assessment->student_id = $request->student_id;
        $continuous_assessment->course_id = $request->course_id;
        $continuous_assessment->weighted_score = $request->weighted_score;

        $continuous_assessment->save();

        return response()->json([
            'status' => true,
            'message' => 'CA uploded successfully',
            'data' => $continuous_assessment
        ], 201);
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
     * @param  \App\ContinuousAssessment  $continuousAssessment
     * @return \Illuminate\Http\Response
     */
    public function show(ContinuousAssessment $continuousAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContinuousAssessment  $continuousAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(ContinuousAssessment $continuousAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContinuousAssessment  $continuousAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContinuousAssessment $continuousAssessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContinuousAssessment  $continuousAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContinuousAssessment $continuousAssessment)
    {
        //
    }
}
