<?php

namespace App\Http\Controllers;

use App\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        //
        $schools = School::all();

        return response()->json([
            'staus' => true,
            'message' => 'these are all the schools',
            'data' => $schools
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $school = new School();

        $school->name = $request->name;
        $school->short_name = $request->short_name;
        $school->college_id = $request->college_id;

        $school->save();

        return response()->json([
            'status' => true,
            'message' => 'school created successfully',
            'data' => $school
        ], 201);
    }

    public function show(School $school, $id)
    {
        //
        $school = School::find($id);

        if (!$school) {
            return response()->json([
                'status' => false,
                'message' => 'This school does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved school',
            'data' => $school->load('college')
        ], 201);
    }

    public function update(Request $request, School $school)
    {
        //
    }

    public function destroy(School $school)
    {
        //
    }
}
