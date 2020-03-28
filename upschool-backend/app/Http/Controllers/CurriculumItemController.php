<?php

namespace App\Http\Controllers;

use App\CurriculumItem;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        //
        $curriculum_item = new CurriculumItem();

        $curriculum_item->level = $request->level;
        $curriculum_item->credit_unit = $request->credit_unit;
        $curriculum_item->program_id = $request->program_id;
        $curriculum_item->course_status_id = $request->course_status_id;
        $curriculum_item->course_id = $request->course_id;

        $curriculum_item->save();

        return response()->json([
            'status' => true,
            'message' => 'course status created successfully',
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

    public function destroy(CurriculumItem $curriculumItem)
    {
        //
    }
}
