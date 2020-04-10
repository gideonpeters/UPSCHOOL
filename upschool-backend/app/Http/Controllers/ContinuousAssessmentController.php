<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;
use App\ContinuousAssessment;

class ContinuousAssessmentController extends Controller
{
    public function index($id)
    {
        //
        $continuous_assessments = ContinuousAssessment::whereCourseId($id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the CAs for this course',
            'data' => $continuous_assessments->load('continuous_assessments')
        ], 201);
    }

    public function upload_scores(Request $request)
    {
        //
        if ($request->student_course_id && $request->continuous_assessment_id) {

            $continuous_assessment = new ContinuousAssessment();
            $continuous_assessment->continuous_assessment_id = $request->continuous_assessment_id;
            // $continuous_assessment->student_id = $request->student_id;
            $continuous_assessment->student_course_id = $request->student_course_id;
            $continuous_assessment->weighted_score = $request->weighted_score;
            $continuous_assessment->save();

            return response()->json([
                'status' => true,
                'message' => 'CA uploded successfully',
                'data' => $continuous_assessment
            ], 201);
        }
    }

    public function store(Request $request)
    {
        //
        if ($request->course_id && $request->name) {
            $currentSemester = Semester::latest()->first();

            $continuous_assessment = new ContinuousAssessment();
            $continuous_assessment->name = $request->name;
            $continuous_assessment->course_id = $request->course_id;
            $continuous_assessment->semester_id = $currentSemester->id;

            $continuous_assessment->save();

            return response()->json([
                'status' => true,
                'message' => 'CA created successfully',
                'data' => $continuous_assessment
            ], 201);
        }
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
