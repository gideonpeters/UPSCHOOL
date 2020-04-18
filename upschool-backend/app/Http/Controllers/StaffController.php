<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Staff;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        //
        $staff = Staff::with('user', 'department')->get();

        return response()->json([
            'status' => true,
            'message' => 'these are all the staff registered',
            'data' => $staff
        ], 201);
    }

    public function store(Request $request)
    {
        //
        $staff = new Staff();

        $staff->first_name = $request->first_name;
        $staff->middle_name = $request->middle_name;
        $staff->last_name = $request->last_name;

        $staff->staff_number = $request->staff_number;
        $staff->year_of_entry = $request->year_of_entry;
        $staff->rank = $request->rank;

        $staff->phone_number = $request->phone_number;
        $staff->home_number = $request->home_number;
        $staff->address = $request->address;
        $staff->nationality = $request->nationality;
        $staff->state_of_origin = $request->state_of_origin;

        $staff->department_id = $request->department_id;

        $staff->save();

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->middle_name[0] . '.' .  ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->userable_id = $staff->id;
        $user->userable_type = 'App\Staff';

        $user->save();

        $path = Storage::putFileAs(
            'images/profile-images/staff',
            $request->file('image'),
            preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '_', $user->name . $request->file('image')->getClientOriginalName()))
        );

        if ($path) {

            $file = new File();
            $file->name = $request->file('image')->getClientOriginalName();
            $file->type = $request->file('image')->getClientMimeType();
            $file->path = $path;
            $file->fileable_id = $staff->id;
            $file->fileable_type = 'App\Staff';

            $file->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Staff Account created successfully',
            'data' => $staff->load('user', 'image')
        ], 201);
    }

    public function show(Staff $staff, $id)
    {
        //
        $staff = Staff::find($id);

        if (!$staff) {
            return response()->json([
                'status' => false,
                'message' => 'This staff does not exist',
                'data' => []
            ], 201);
        }

        return response()->json([
            'status' => true,
            'message' => 'This is the retrieved staff',
            'data' => $staff->load('user', 'department')
        ], 201);
    }

    public function getAdvisees()
    {
        $staff = Staff::find(1);
        $students = Student::whereAdviserId($staff->id);

        return response()->json([
            'status' => true,
            'message' => 'these are all the students under this level adviser',
            'data' => $students
        ], 201);
    }

    public function update(Request $request, Staff $staff)
    {
        //
    }

    public function destroy(Staff $staff)
    {
        //
    }
}
