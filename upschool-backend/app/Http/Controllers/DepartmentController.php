<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        //
        $departments = Department::with('college', 'programs')->get();

        return response()->json([
            'staus' => true,
            'message' => 'these are all the departments',
            'data' => $departments
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $department = new Department();

        $department->name = $request->name;
        $department->short_name = $request->short_name;
        $department->college_id = $request->college_id;
        $department->school_id = $request->school_id;

        $department->save();

        return response()->json([
            'status' => true,
            'message' => 'department created successfully',
            'data' => $department->load('college', 'school')
        ], 201);
    }

    public function show(Department $department, $id)
    {
        //
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'status' => false,
                'message' => 'This department does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved department',
            'data' => $department
        ], 201);
    }

    public function update(Request $request, Department $department)
    {
        //
    }

    public function destroy(Department $department)
    {
        //
    }
}
