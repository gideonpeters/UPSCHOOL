<?php

namespace App\Http\Controllers;

use App\Program;
use App\CurriculumItem;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Array_;

class CurriculumItemController extends Controller
{
    public function index()
    {
        //
        $curriculum_items = CurriculumItem::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the curriculum items',
            'data' => $curriculum_items
        ], 201);
    }

    public function store(Request $request, $id)
    {
        //
        // $program = Program::find($request->program_id);


        $curriculum_item = new CurriculumItem();

        // $curriculum_item->level = $request->level;
        $curriculum_item->credit_unit = $request->credit_unit;
        $curriculum_item->curriculum_block_id = $id;
        // $curriculum_item->course_status_id = $request->course_status_id;
        // $curriculum_item->semester_type_id = $request->semester_type_id;

        $curriculum_item->curriculumable_type = 'App\Course';
        $curriculum_item->curriculumable_id = $request->course_id;

        $curriculum_item->save();

        // $program->curriculum_items()->save($curriculum_item);

        return response()->json([
            'status' => true,
            'message' => 'curriculum_item created successfully',
            'data' => $curriculum_item
        ], 201);
    }

    public function show(CurriculumItem $curriculumItem, $id)
    {
        //
        $curriculum_item = CurriculumItem::find($id);

        if (!$curriculum_item) {
            return response()->json([
                'status' => false,
                'message' => 'This curriculum_item does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved curriculum_item',
            'data' => $curriculum_item
        ], 201);
    }

    public function update(Request $request, CurriculumItem $curriculumItem)
    {
        //
    }

    public function test(Request $request)
    {
        $data = $request->all();
        $da = json_decode($data["data"]);
        $arr = array();
        foreach ($da as $v => $item) {
            # code...
            $item->curriculumable_type = 'App\Course';
            $item->curriculumable_id = $item->course_id;

            array_push($arr, $item);
        }
        dd($arr);
        // printf($arr);
    }

    public function destroy(CurriculumItem $curriculumItem)
    {
        //
    }
}
