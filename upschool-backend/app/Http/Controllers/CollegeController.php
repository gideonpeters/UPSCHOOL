<?php

namespace App\Http\Controllers;

use App\College;
use Illuminate\Http\Request;

class CollegeController extends Controller
{
    public function index()
    {
        //
        $colleges = College::all();

        return response()->json([
            'staus' => true,
            'message' => 'these are all the colleges',
            'data' => $colleges
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $college = new College();

        $college->name = $request->name;
        $college->short_name = $request->short_name;

        $college->save();

        return response()->json([
            'status' => true,
            'message' => 'college created successfully',
            'data' => $college
        ], 201);
    }

    public function show(College $college, $id)
    {
        //
        $college = College::find($id);

        if (!$college) {
            return response()->json([
                'status' => false,
                'message' => 'This college does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved college',
            'data' => $college
        ], 201);
    }

    public function update(Request $request, College $college)
    {
        //
    }

    public function destroy(College $college)
    {
        // 
    }
}
