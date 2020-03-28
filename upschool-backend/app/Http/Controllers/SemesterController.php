<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{

    public function index()
    {
        //
        $semesters = Semester::all();


        return response()->json([
            'status' => true,
            'message' => 'These are all the semesters',
            'data' => $semesters->load('semester')
        ], 201);
    }


    public function store(Request $request)
    {
        //
        $semester = new Semester();
        $semester->semester_type_id = $request->semester_type_id;
        $semester->academic_session_id = $request->academic_session_id;
        $semester->start_date = $request->start_date;
        $semester->end_date = $request->end_date;

        $semester->save();

        return response()->json([
            'status' => true,
            'message' => 'Semester Created successfully',
            'data' => $semester
        ], 201);
    }

    public function show(Semester $semester, $id)
    {
        //
        $semester = Semester::find($id);

        if (!$semester) {
            return response()->json([
                'status' => false,
                'message' => 'This semester does not exist',
                'data' => []
            ], 201);
        }

        // $semester::with('semesterType', 'academicSession')->first();

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved semester',
            'data' => $semester
        ], 201);
    }


    public function update(Request $request, Semester $semester)
    {
        //
    }

    public function destroy(Semester $semester)
    {
        //
    }
}
