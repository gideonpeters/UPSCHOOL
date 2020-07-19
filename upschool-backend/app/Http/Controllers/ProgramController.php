<?php

namespace App\Http\Controllers;

use App\Program;
use App\Curriculum;
use Illuminate\Http\Request;

class ProgramController extends Controller
{

    public function index()
    {
        //
        $programs = Program::all();

        if($programs->isEmpty()){
            return response()->json([
                'staus' => true,
                'message' => 'No programs created yet',
                'data' => []
            ], 201);
        }

        return response()->json([
            'staus' => true,
            'message' => 'these are all the programs',
            'data' => $programs
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $program = new Program();

        $program->name = $request->name;
        $program->short_name = $request->short_name;
        $program->department_id = $request->department_id;
        $program->description = $request->description;
        $program->no_of_years = $request->no_of_years;
        $program->degree_id = $request->degree_id;
        $program->max_number_of_failed_units = $request->max_number_of_failed_units;
        $program->min_cgpa = $request->min_cgpa;

        $program->save();

        $curriculum = new Curriculum();

        $curriculum->program_id = $program->id;

        $curriculum->save();


        return response()->json([
            'status' => true,
            'message' => 'program created successfully',
            'data' => $program->load('degree')
        ], 201);
    }

    public function show(Program $program, $id)
    {
        //
        $program = Program::find($id);

        if (!$program) {
            return response()->json([
                'status' => false,
                'message' => 'This program does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved program',
            'data' => $program
        ], 201);
    }

    public function update(Request $request, Program $program)
    {
        //
    }

    public function destroy(Program $program)
    {
        //
    }
}
