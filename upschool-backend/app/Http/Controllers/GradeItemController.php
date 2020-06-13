<?php

namespace App\Http\Controllers;

use App\GradeItem;
use Illuminate\Http\Request;

class GradeItemController extends Controller
{

    public function index(Request $request)
    {
        //
        $grade_items = GradeItem::whereStudentCourseId($request->student_course_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the grade items for this student in this course',
            'data' => $grade_items->load('gradelist')
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $grade_item = new GradeItem();

        $grade_item->gradelist_id = $request->gradelist_id;
        $grade_item->score = $request->score;
        $grade_item->student_course_id = $request->student_course_id;
        $grade_item->save();

        return response()->json([
            'status' => true,
            'message' => 'student score uploaded successfully',
            'data' => $grade_item
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GradeItem  $gradeItem
     * @return \Illuminate\Http\Response
     */
    public function show(GradeItem $gradeItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GradeItem  $gradeItem
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $gradeItem = GradeItem::find($request->grade_id);

        if (!$gradeItem) {
            return response()->json([
                'status' => false,
                'message' => 'grade not found',
                'data' => null
            ], 201);
        }
        $gradeItem->score = $request->score;
        $gradeItem->save();

        return response()->json([
            'status' => true,
            'message' => 'score uploaded successfully',
            'data' => $gradeItem
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GradeItem  $gradeItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GradeItem $gradeItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GradeItem  $gradeItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeItem $gradeItem)
    {
        //
    }
}
