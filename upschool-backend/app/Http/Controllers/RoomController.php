<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $room_type = RoomType::find($request->room_type_id);

        if (!$room_type) {
            return response()->json([
                'status' => false,
                'message' => 'room type not found',
                'data' => []
            ], 201);
        }

        $hall = Hall::find($request->hall_id);

        if (!$hall) {
            return response()->json([
                'status' => false,
                'message' => 'hall not found',
                'data' => []
            ], 201);
        }

        $room = new Room();
        $room->room_id = $request->room_id;
        $room->capacity = $request->capacity;
        $room->room_type_id = $room_type->id;
        $room->hall_id = $hall->id;
        $room->description = $request->description;
        $room->wing = $request->wing;
        $room->preferred_sex = $request->preferred_sex;
        $room->preferred_program = $request->preferred_program;
        $room->preferred_nationality = $request->preferred_nationality;
        $room->preferred_student_type = $request->preferred_student_type;
        $room->preferred_level = $request->preferred_level;
        $room->save();

        return response()->json([
            'status' => true,
            'message' => 'room created successfully',
            'data' => $room
        ], 201);
    }

    public function show(Room $room)
    {
        //
    }

    public function edit(Room $room)
    {
        //
    }

    public function update(Request $request, Room $room)
    {
        //
    }

    public function destroy(Room $room)
    {
        //
    }
}
