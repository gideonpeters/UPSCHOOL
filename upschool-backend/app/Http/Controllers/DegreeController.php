<?php

namespace App\Http\Controllers;

use App\Degree;
use Illuminate\Http\Request;

class DegreeController extends Controller
{
    public function index()
    {
        //
        $degrees = Degree::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the degrees available in this university',
            'data' => $degrees,
            'programs' => $degrees->load('programs')
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $degree = new Degree();
        $degree->name = $request->name;
        $degree->short_name = $request->short_name;
        $degree->category = $request->category;
        $degree->type = $request->type;

        $degree->save();

        return response()->json([
            'status' => true,
            'message' => 'degree created successfully',
            'data' => $degree,
        ], 201);
    }

    public function show(Degree $degree, $id)
    {
        //
        $degree = Degree::find($id);

        if (!$degree) {
            return response()->json([
                'status' => false,
                'message' => 'This degree does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved degree',
            'data' => $degree->load('programs')
        ], 201);
    }

    public function update(Request $request, Degree $degree)
    {
        //
    }

    public function destroy(Degree $degree)
    {
        //
    }
}
