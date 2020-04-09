<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentCourse extends Pivot
{
    //
    protected $table = 'student_courses';
}
