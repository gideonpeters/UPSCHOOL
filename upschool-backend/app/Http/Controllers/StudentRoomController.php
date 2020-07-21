<?php

namespace App\Http\Controllers;

use App\AllocationSetting;
use App\Room;
use App\Semester;
use App\Student;
use App\StudentRoom;
use Illuminate\Http\Request;

class StudentRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => null
            ], 201);
        }

        // $allocation_settings = AllocationSetting::latest()->first();

        $student_rooms = StudentRoom::with('semester', 'session', 'room', 'room.hall')->whereStudentId($student->id)->get()->groupBy('session_id');

        return response()->json([
            'status' => true,
            'message' => 'these are all the rooms you have been allocated to',
            'data' => $student_rooms
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => null
            ], 201);
        }

        $room = Room::find($request->room_id);

        if (!$room) {
            return response()->json([
                'status' => false,
                'message' => 'room does not exist',
                'data' => null
            ], 201);
        }

        $currentSemester = Semester::latest()->first();
        $allocation_settings = AllocationSetting::latest()->first();

        if ($allocation_settings->allocate_by_session) {
            $existing_room = StudentRoom::whereStudentId($student->id)->whereSessionId($currentSemester->academic_session_id)->first();

            if ($existing_room) {
                return response()->json([
                    'status' => false,
                    'message' => 'a room has already been allocated',
                    'data' => null
                ], 201);
            }
        }

        $student_room = new StudentRoom();
        $student_room->student_id = $student->id;
        $student_room->room_id = $room->id;
        $student_room->semester_id = $currentSemester->id;
        $student_room->session_id = $currentSemester->academic_session_id;

        if (!$allocation_settings->allocate_after_pay && $allocation_settings->allocate_reservable) {
            $student_room->is_reserved = true;
        }

        $student_room->save();

        return response()->json([
            'status' => true,
            'message' => 'room allocated successfully',
            'data' => $room
        ], 201);
    }

    public function show(Request $request)
    {
        //
        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => null
            ], 201);
        }

        $currentSemester = Semester::latest()->first();
        $allocation_settings = AllocationSetting::latest()->first();

        if ($allocation_settings->allocate_by_session) {
            $student_room = StudentRoom::whereStudentId($student->id)->whereSessionId($currentSemester->academic_session_id)->first();

            if ($student_room) {
                return response()->json([
                    'status' => true,
                    'message' => 'this is the allocated room for the academic session',
                    'data' => $student_room->load(['room' => function ($query) {
                        $query->withCount('occupants');
                        $query->with('hall', 'room_type');
                    }, 'semester', 'session'])->append('room_mates')
                ], 201);
            }
        } else if ($allocation_settings->allocate_by_semester) {

            $student_room = StudentRoom::whereSemesterId($currentSemester->id)->whereStudentId($student->id)->first();
if(!$student_room){
    return response()->json([
        'status' => true,
        'message' => 'no room allocation history',
        'data' =>  []
    ], 201);
}
            return response()->json([
                'status' => true,
                'message' => 'this is the allocated room for the semester',
                'data' => $student_room->load(['room' => function ($query) {
                    $query->withCount('occupants');
                    $query->with('hall', 'room_type');
                }, 'semester', 'session'])->append('room_mates')
            ], 201);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentRoom $studentRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentRoom $studentRoom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentRoom  $studentRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentRoom $studentRoom)
    {
        //
    }
}
