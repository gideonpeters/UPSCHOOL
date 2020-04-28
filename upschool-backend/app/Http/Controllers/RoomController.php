<?php

namespace App\Http\Controllers;

use App\AllocationSetting;
use App\Hall;
use App\Program;
use App\Room;
use App\RoomType;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        //
        $rooms = Room::withCount('occupants')->get()->load('hall');

        if ($request->status == 'available') {
            $student = Student::find(1);
            $settings = AllocationSetting::latest()->first();
            $available_halls = Hall::all();
            if ($settings->allocate_by_sex) {
                $available_halls = Hall::all()->filter(function ($value, $key) use ($student) {
                    $student_sex = strtolower(trim($student->sex));
                    $allowed_sexes = collect($value->preferred_sex)->transform(function ($value) {
                        return strtolower(trim($value));
                    });
                    return $allowed_sexes->contains($student_sex) || $value->preferred_sex == null;
                });
            }
            if ($settings->allocate_by_level) {
                $available_halls = $available_halls->filter(function ($value) use ($student) {
                    return collect($value->preferred_level)->contains($student->level) || $value->preferred_level == null;
                });
            }
            if ($settings->allocate_by_program) {
                $available_halls = $available_halls->filter(function ($value) use ($student) {
                    $allowed_programs = collect($value->preferred_program)->transform(function ($value) {
                        $progr = Program::find($value);
                        if ($progr) {
                            return $progr->id;
                        } else {
                            return null;
                        }
                    });

                    return $allowed_programs->contains($student->program_id) || $value->preferred_program == null;
                    // return collect($value->pref);
                });
            }

            if ($settings->allocate_by_nationality) {
                $available_halls = $available_halls->filter(function ($value) use ($student, $settings) {

                    $studentNationality = strtolower(trim($student->nationality));
                    $allowed_nationalities = collect($value->preferred_nationality)->transform(function ($val) {
                        return strtolower(trim($val));
                    });
                    if ($allowed_nationalities->contains('local')) {
                        return $allowed_nationalities->contains(strtolower(trim($settings->local_nationality)));
                    } else if ($allowed_nationalities->contains('international')) {
                        return !($allowed_nationalities->contains(strtolower(trim($settings->local_nationality))));
                    } else {
                        return $allowed_nationalities->contains($studentNationality);
                    }
                });
            }
            $available_halls = $available_halls->map(function ($value) {
                return $value->id;
            });
            $rooms = Room::whereIn('hall_id', $available_halls)->get();
            dd($rooms->toArray());
            // if ($settings->allocate_by_sex) {
            // }
        }

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
