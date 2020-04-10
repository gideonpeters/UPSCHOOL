<?php

namespace App\Http\Controllers;

use App\CourseSection;
use Illuminate\Http\Request;

class CourseSectionController extends Controller
{

    public function index($id)
    {
        //
        $sections = CourseSection::whereCourseId($id)->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the sections for this course',
            'data' => $sections->load('subsections')
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $section = new CourseSection();
        $section->title = $request->title;
        $section->course_id = $request->course_id;
        $section->body = $request->body;

        $section->save();

        return response()->json([
            'status' => true,
            'message' => 'section created successfully',
            'data' => $section
        ], 201);
    }

    public function show(CourseSection $courseSection)
    {
        //
    }

    public function edit(CourseSection $courseSection)
    {
        //
    }

    public function update(Request $request, CourseSection $courseSection)
    {
        //
    }

    public function destroy(CourseSection $courseSection)
    {
        //
    }
}
