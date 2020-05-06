<?php

namespace App\Http\Controllers;

use App\Student;
use App\Semester;
use App\AcademicSession;
use Illuminate\Http\Request;
use App\Events\WebSocketDemoEvent;
use App\Notifications\AssignmentCreated;
use Illuminate\Support\Facades\Notification;

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

    public function test(Request $request)
    {
        //
        // $session = new AcademicSession();
        // $session->title = $request->body;
        // $session->start_date = '2020-04-11';
        // $session->end_date = '2020-04-11';
        // $session->save();
        $session = AcademicSession::latest()->first();
        $students = Student::all()->flatten()->map(function ($item, $key) {
            return $item->user;
        });
        // dd($students);

        // broadcast(new WebSocketDemoEvent($session));
        Notification::send($students, new AssignmentCreated($session));

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

    public function getCurrent()
    {
        $session = AcademicSession::latest()->first();
        $semester = Semester::whereAcademicSessionId($session->id)->latest()->first();
        $data = ['session' => $session, 'semester' => $semester];

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved academic session',
            'data' => $data
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
