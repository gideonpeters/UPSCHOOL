<?php

namespace App\Http\Controllers;

use App\Semester;
use App\ResultItem;
use App\StudentCourse;
use Illuminate\Http\Request;

class ResultItemController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publish()
    {
        //
        $currentSemester = Semester::latest()->first();
        $studentCourses = StudentCourse::whereSemesterId($currentSemester->id);

        $resultItem = new ResultItem();

        // $table->foreignId('student_id');
        //     $table->foreignId('semester_id');
        //     $table->foreignId('course_id');
        //     $table->unsignedInteger('exam_score')->nullable();
        //     $table->unsignedInteger('ca_score')->nullable();
        //     $table->unsignedInteger('total_weighted_score')->nullable();
        //     $table->string('grade_score')->nullable();
        //     $table->unsignedInteger('weighted_score')->nullable();
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
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function show(ResultItem $resultItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ResultItem $resultItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResultItem $resultItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ResultItem  $resultItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResultItem $resultItem)
    {
        //
    }
}
