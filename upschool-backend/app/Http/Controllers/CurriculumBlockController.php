<?php

namespace App\Http\Controllers;

use App\CourseStatus;
use App\CurriculumBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurriculumBlockController extends Controller
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


    public function store(Request $request)
    {
        //
        $curriculum_block = new CurriculumBlock();
        $curriculum_block->program_id = $request->program_id;
        $curriculum_block->level = $request->level;
        $curriculum_block->course_status_id = $request->course_status_id;

        $curriculum_block->save();

        return response()->json([
            'status' => true,
            'message' => 'new curriculum block created successfully',
            'data' => $curriculum_block
        ], 201);
    }

    public function show(Request $request, $program_id)
    {
        //
        // $statuses = CourseStatus::all();

        // foreach ($statuses as $key => $status) {
        //     # code...
        //     $curriculum_block = new CurriculumBlock();
        //     $curriculum_block->program_id = $program_id;
        //     $curriculum_block->level = $request->level;
        //     $curriculum_block->course_status_id = $status->id;

        //     $curriculum_block->save();
        // }

        $curriculum_blocks = CurriculumBlock::whereProgramId($program_id)->get();

        return response()->json([
            'status' => true,
            'message' => 'this is the curriculum for this course',
            'data' => $curriculum_blocks
        ], 201);
    }

    public function edit(CurriculumBlock $curriculumBlock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CurriculumBlock  $curriculumBlock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CurriculumBlock $curriculumBlock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CurriculumBlock  $curriculumBlock
     * @return \Illuminate\Http\Response
     */
    public function destroy(CurriculumBlock $curriculumBlock)
    {
        //
    }
}
