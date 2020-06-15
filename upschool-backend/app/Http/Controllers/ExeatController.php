<?php

namespace App\Http\Controllers;

use App\File;
use App\Exeat;
use App\Student;
use App\Semester;
use App\ExeatType;
use App\StudentRoom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExeatController extends Controller
{
    public function index(Request $request)
    {
        //
        $exeats = Exeat::all();
        if ($request->has('student_id')) {
            $student = Student::whereMatricNumber($request->student_id)->first();

            if (!$student) {
                return response()->json([
                    'status' => false,
                    'message' => 'student does not exist',
                    'data' => []
                ], 201);
            }
            $exeats = Exeat::whereStudentId($student->id)->get();
        }
        $exeats->each(function ($query) {
            $query->append('latest_room');
        });

        return response()->json([
            'status' => true,
            'message' => 'These are all the exeats',
            'data' => $exeats->load('student', 'file', 'exeat_type')
        ], 201);
    }

    public function store(Request $request)
    {

        if ($request->has('action')) {
            $existing_exeat = Exeat::find($request->exeat_id);

            if (!$existing_exeat) {
                return response()->json([
                    'status' => false,
                    'message' => 'exeat does not exist',
                    'data' => []
                ], 201);
            }

            $existing_exeat->status = $request->status ? 'approved' : 'declined';
            $existing_exeat->save();

            return response()->json([
                'status' => true,
                'message' => "exeat $existing_exeat->status",
                'data' => $existing_exeat
            ], 201);
        }
        $student = Student::find($request->student_id);

        if (!$student) {
            return response()->json([
                'status' => false,
                'message' => 'student does not exist',
                'data' => []
            ], 201);
        }

        $exeat_type = ExeatType::find($request->exeat_type_id);

        if (!$exeat_type) {
            return response()->json([
                'status' => false,
                'message' => 'Exeat type does not exist',
                'data' => []
            ], 201);
        }

        $semester = Semester::latest()->first();

        if (!$semester) {
            return response()->json([
                'status' => false,
                'message' => 'semester not found',
                'data' => []
            ], 201);
        }

        $exeat = new Exeat();
        $exeat->exeat_type_id = $exeat_type->id;
        $exeat->exeat_id = "EXT" . Carbon::now()->format('Ymd') . $student->matric_number;
        $exeat->student_id = $student->id;
        $exeat->semester_id = $semester->id;
        $exeat->reason = $request->reason;
        $exeat->requested_departure = $request->requested_departure;
        if ($exeat_type->metric == 'hours') {
            $exeat->expected_arrival = Carbon::parse($request->requested_departure)->addHours($exeat_type->duration);
        } else if ($exeat_type->metric == 'days') {
            $exeat->expected_arrival = Carbon::parse($request->requested_departure)->addDays($exeat_type->duration);
        } else if ($exeat_type->metric == 'weeks') {
            $exeat->expected_arrival = Carbon::parse($request->requested_departure)->addWeeks($exeat_type->duration);
        } else if ($exeat_type->metric == 'months') {
            $exeat->expected_arrival = Carbon::parse($request->requested_departure)->addMonths($exeat_type->duration);
        }
        $exeat->save();

        if ($request->has('files')) {
            foreach ($request->file('files') as $key => $sent_file) {
                # code...
                $path = Storage::putFileAs(
                    "documents/exeat-applications/$semester->id",
                    $sent_file,
                    preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $exeat->exeat_id)) . '.' . $sent_file->getClientOriginalExtension()
                );

                $file = new File();
                $file->name = $sent_file->getClientOriginalName();
                $file->type = $sent_file->getClientMimeType();
                $file->path = $path;
                $file->fileable_id = $exeat->id;
                $file->fileable_type = 'App\Exeat';

                $file->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'submitted successfully',
            'data' => $exeat
        ], 201);
    }

    public function show(Exeat $exeat)
    {
        //
    }

    public function update(Request $request, Exeat $exeat)
    {
        //
    }

    public function destroy(Exeat $exeat)
    {
        //
    }
}
