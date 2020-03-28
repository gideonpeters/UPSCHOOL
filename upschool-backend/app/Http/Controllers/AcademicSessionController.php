<?php

namespace App\Http\Controllers;

use App\AcademicSession;
use Illuminate\Http\Request;

class AcademicSessionController extends Controller
{
    public function index()
    {
        //
        $sessions = AcademicSession::all();

        return response()->json([
            'status' => true,
            'message' => 'These are all the sessions created',
            'data' => $sessions
        ], 201);
    }


    public function store(Request $request)
    {
        //
        $session = new AcademicSession();
        $session->title = $request->title;
        $session->start_date = $request->start_date;
        $session->end_date = $request->end_date;

        $session->save();

        return response()->json([
            'status' => true,
            'message' => 'Session created successfully',
            'data' => $session
        ], 201);
    }


    public function show(AcademicSession $academicSession, $id)
    {
        //
        $session = AcademicSession::find($id);

        if (!$session) {
            return response()->json([
                'status' => false,
                'message' => 'This session does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved academic session',
            'data' => $session
        ], 201);
    }


    public function update(Request $request, AcademicSession $academicSession)
    {
        //
    }


    public function destroy(AcademicSession $academicSession)
    {
        //
    }
}
