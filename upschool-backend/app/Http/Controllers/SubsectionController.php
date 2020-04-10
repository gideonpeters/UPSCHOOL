<?php

namespace App\Http\Controllers;

use App\CourseSection;
use App\File;
use App\Subsection;
use Illuminate\Http\Request;
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
        // $table->string('name');
        //     $table->string('type'); //file/task
        //     $table->foreignId('course_section_id');
        //     $table->longText('body');

        $subsection->name = $request->name;
        $subsection->type = $request->type;
        $subsection->course_section_id = $request->section_id;
        $subsection->body = $request->body;

        $section = CourseSection::find($request->section_id);
        $course_code = $section->course->course_code;

        // dd($course_code);
        $subsection->save();

        if ($request->type == 'file') {
            $path = Storage::putFileAs(
                "documents/course-materials/$course_code",
                $request->file('file'),
                preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $request->name)) . '.' . $request->file('file')->getClientOriginalExtension()
            );

            if ($path) {

                $file = new File();
                $file->name = $request->file('file')->getClientOriginalName();
                $file->type = $request->file('file')->getClientMimeType();
                $file->path = $path;
                $file->fileable_id = $subsection->id;
                $file->fileable_type = 'App\Subsection';

                $file->save();

                return response()->json([
                    'status' => true,
                    'message' => ' subsection created successfully',
                    'data' => $subsection->load('file')
                ], 201);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'something went wrong',
                    'data' => []
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
    public function show(Subsection $subsection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subsection  $subsection
     * @return \Illuminate\Http\Response
     */
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
