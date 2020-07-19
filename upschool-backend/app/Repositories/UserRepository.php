<?php

namespace App\Repositories;

use App\Staff;
use App\Student;
use App\User;

class UserRepository
{
    public function store($userData)
    {
        $user = new User();
        $user->name = $userData->name;
        $user->email = $userData->email;
        $user->password = bcrypt($userData->password); 


        if ($userData->user_type == 'student') {

            $student = new Student();
            $student->matric_number = $userData->matric_number;
            $student->reg_number = $userData->reg_number;
            $student->program_id = $userData->program_id;
            $student->save();

            $user->userable_id = $student->id;
            $user->userable_type = 'App\\Student';
        } elseif ($userData->user_type == 'staff') {

            $staff = new Staff();
            $staff->first_name = $userData->first_name;
            $staff->last_name = $userData->last_name;
            $staff->staff_number = $userData->staff_number;
            $staff->department_id = $userData->department_id;
            $staff->save();

            $user->userable_id = $staff->id;
            $user->userable_type = 'App\\Staff';
        } else {
            return false;
        }

        $user->save();

        return $user;
    }
}
