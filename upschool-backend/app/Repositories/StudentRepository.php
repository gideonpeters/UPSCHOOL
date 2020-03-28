<?php

namespace App\Repositories;

// use App\Staff;
use App\Student;
use App\User;

class StudentRepository
{
    public function all()
    {
        $students = Student::with('program')->get();

        return response()->json(
            [
                'status' => true,
                'message' => 'these are all the students',
                'data' => $students
            ],
            201
        );
    }
}
