<?php

namespace App\Http\Controllers;

use App\Semester;
use App\SemesterType;
use Illuminate\Http\Request;

class SemesterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $semesterTypes = SemesterType::all();

        return response()->json([
            'status' => true,
            'message' => 'These are all the semester types',
            'data' => $semesterTypes
        ], 201);
    }


    public function store(Request $request)
    {
        //
        $semesterType = new SemesterType();
        $semesterType->title = $request->title;
        $semesterType->short_title = $request->short_title;

        $semesterType->save();

        return response()->json([
            'status' => true,
            'message' => 'New semester type created',
            'data' => $semesterType
        ], 201);
    }


    public function show(SemesterType $semesterType, $id)
    {
        //
        $semesterType = SemesterType::find($id);

        if (!$semesterType) {
            return response()->json([
                'status' => false,
                'message' => 'This semesterType does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved  semesterType',
            'data' => $semesterType
        ], 201);
    }


    public function update(Request $request, SemesterType $semesterType)
    {
        //
    }


    public function destroy(SemesterType $semesterType)
    {
        //
    }
}
