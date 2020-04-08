<?php

namespace App\Http\Controllers;

use App\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $enrollments = Enrollment::all();

        return response()->json([
            'status' => true,
            'message' => 'all enrollments',
            'data' => $enrollments->load('curriculum_items')
        ], 201);
    }

    public function enrollCourses(Request $request)
    {
        //
        $courses = json_decode($request->course_ids);

        $enrollment = new Enrollment();
        $enrollment->student_id = $request->student_id;
        $enrollment->semester_id = $request->semester_id;
        $enrollment->approval_status = false;

        $enrollment->save();

        $enrollment->curriculum_items()->attach($courses);

        return response()->json([
            'status' => true,
            'message' => 'succe.
            ssfully enrolled courses',
            'data' => $enrollment->load('curriculum_items')
        ], 201);
    }

    public function approveenrollCourses()
    {
        //

    }

    public function addOrDropCourses()
    {
        //

    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        //
    }
}
