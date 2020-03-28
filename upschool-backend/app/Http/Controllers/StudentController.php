<?php

namespace App\Http\Controllers;

use App\File;
use App\User;
use App\Student;
use Illuminate\Http\Request;
use App\Repositories\StudentRepository;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, StudentRepository $studentRepository)
    {
        //
        $data = $studentRepository->all();

        return $data;
    }

    public function store(Request $request)
    {
        //
        $student = new Student();

        $student->first_name = $request->first_name;
        $student->middle_name = $request->middle_name;
        $student->last_name = $request->last_name;

        $student->matric_number = $request->matric_number;
        $student->reg_number = $request->reg_number;
        $student->level = $request->level;
        $student->year_of_entry = $request->year_of_entry;

        $student->promotion_status = $request->promotion_status;
        $student->program_id = $request->program_id;
        $student->adviser_id = $request->adviser_id;


        $student->save();

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->middle_name[0] . '.' .  ' ' . $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->userable_id = $student->id;
        $user->userable_type = 'App\Student';

        $user->save();

        $path = Storage::putFileAs(
            'images/profile-images/students',
            $request->file('image'),
            preg_replace('/[^A-Za-z0-9\-]/', '_', str_replace(' ', '_', $user->name . $request->file('image')->getClientOriginalName()))
        );

        if ($path) {

            $file = new File();
            $file->name = $request->file('image')->getClientOriginalName();
            $file->type = $request->file('image')->getClientMimeType();
            $file->path = $path;
            $file->fileable_id = $student->id;
            $file->fileable_type = 'App\Student';

            $file->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'New Student Account created',
            'data' => $student->load('user', 'image', 'adviser')
        ], 201);
    }

    public function show(Student $student)
    {
        //
    }

    public function update(Request $request, Student $student)
    {
        //
    }

    public function destroy(Student $student)
    {
        //
    }
}
