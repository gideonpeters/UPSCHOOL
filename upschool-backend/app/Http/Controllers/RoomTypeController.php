<?php

namespace App\Http\Controllers;

use App\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        //
        $room_types = RoomType::all();

        return response()->json([
            'status' => true,
            'message' => 'these are all the room types',
            'data' => $room_types
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $room_type = new RoomType();
        $room_type->name = $request->name;
        $room_type->fee = $request->fee;
        $room_type->capacity = $request->capacity;
        $room_type->description = $request->description;
        $room_type->save();

        return response()->json(
            [
                'status' => true,
                'message' => 'room type created successfully',
                'data' => $room_type
            ],
            201
        );
    }

    public function show($id)
    {
        //
        $room_type = RoomType::find($id);

        if (!$room_type) {
            return response()->json([
                'status' => false,
                'message' => 'room type does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'this is the room type',
            'data' => $room_type
        ], 201);
    }

    public function edit(RoomType $roomType)
    {
        //
    }

    public function update(Request $request, RoomType $roomType)
    {
        //
    }

    public function destroy(RoomType $roomType)
    {
        //
    }
}
