<?php

namespace App\Http\Controllers;

use App\SchoolAssessment;
use Illuminate\Http\Request;

class SchoolAssessmentController extends Controller
{
    public function index()
    {
        //
        $school_assessments = SchoolAssessment::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the school assessment items',
            'data' => $school_assessments
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $school_assessment = new SchoolAssessment();

        $school_assessment->name = $request->name;
        $school_assessment->total_score = $request->total_score;

        $school_assessment->save();

        return response()->json([
            'status' => true,
            'message' => 'school assessment created',
            'data' => $school_assessment
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolAssessment $schoolAssessment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SchoolAssessment  $schoolAssessment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolAssessment $schoolAssessment)
    {
        //
    }
}
