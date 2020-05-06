<?php

namespace App\Http\Controllers;

use App\File;
use App\Semester;
use App\Gradelist;
use App\Subsection;
use App\CourseSection;
use App\Notifications\AssignmentCreated;
use App\SubmissionList;
use Illuminate\Http\Request;
// use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class SubsectionController extends Controller
{

    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        //
        $subsection = new Subsection();

        $subsection->name = $request->name;
        $subsection->type = $request->type;
        $subsection->course_section_id = $request->section_id;
        $subsection->body = $request->body;

        $section = CourseSection::find($request->section_id);

        if (!$section) {
            return response()->json([
                'status' => false,
                'message' => 'something went wrong',
                'data' => []
            ], 201);
        }

        $course_code = $section->course->course_code;

        // dd($course_code);
        $subsection->save();

        if ($request->type == 'submission') {

            $currentSemester = Semester::latest()->first();

            $gradelist = new Gradelist();
            $gradelist->name = $request->name;
            $gradelist->total_score = $request->total_score;
            $gradelist->course_id = $section->course->id;
            $gradelist->semester_id =  $currentSemester->id;
            $gradelist->save();

            $submission_list = new SubmissionList();
            $submission_list->open_date = $request->open_date;
            $submission_list->due_date = $request->due_date;
            $submission_list->course_id = $section->course->id;
            $submission_list->subsection_id = $subsection->id;
            $submission_list->body = $request->body;
            $submission_list->total_score = $request->total_score;
            $submission_list->gradelist_id = $gradelist->id;
            $submission_list->save();

            // $participants = $section->course->participants()->whereSemesterId($currentSemester->id)->get();

            // Notification::send($participants, new AssignmentCreated($submission_list));
        }

        if ($request->hasFile('file')) {
            $path = Storage::putFileAs(
                "documents/course-materials/$course_code",
                $request->file('file'),
                preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $request->name)) . '.' . $request->file('file')->getClientOriginalExtension()
            );


            $file = new File();
            $file->name = $request->file('file')->getClientOriginalName();
            $file->type = $request->file('file')->getClientMimeType();
            $file->path = $path;
            $file->fileable_id = $subsection->id;
            $file->fileable_type = 'App\Subsection';

            $file->save();
        }

        return response()->json([
            'status' => true,
            'message' => ' subsection created successfully',
            'data' => $subsection->load('file')
        ], 201);
    }

    public function show(Subsection $subsection)
    {
        //
    }

    public function edit(Subsection $subsection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subsection $subsection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsection $subsection)
    {
        //
    }
}
