<?php

namespace App\Http\Controllers;

use App\Hall;
use App\Room;
use App\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
    {
        //
        $rooms = Room::withCount('occupants')->get()->load('hall');

        return response()->json([
            'status' => true,
            'message' => 'these are all the rooms',
            'data' => $rooms
        ], 201);
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

    public function storeBulk(Request $request)
    {
        $data = json_decode($request->data, true);

        DB::table('rooms')->insertOrIgnore($data);

        return response()->json([
            'status' => true,
            'message' => 'Uploaded rooms successfully',
            'data' => []
        ]);
    }

    public function show($id)
    {
        //
        $room = Room::with('hall')->find($id);

        if (!$room) {
            return response()->json([
                'status' => false,
                'message' => 'room not found',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'this is the room',
            'data' => $room
        ], 201);
    }

    public function edit(Room $room)
    {
        //
    }

    public function update(Request $request, Room $room)
    {
        //
    }

    public function destroy($id)
    {
        //
        $room = Room::find($id);

        if (!$room) {
            return response()->json([
                'status' => false,
                'message' => 'room not found',
                'data' => []
            ], 201);
        }

        $room->delete();

        return response()->json([
            'status' => true,
            'message' => 'room deleted successfully',
            'data' => []
        ], 201);
    }
}
