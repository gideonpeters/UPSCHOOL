<?php

namespace App;

use App\Course;
use App\Result;
use App\Student;
use App\Semester;
use App\StudentCourse;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;

class ResultItem extends Model
{
    //
    protected $with = ['student_course'];

    // public function student()
    // {
    //     return $this->hasOneThrough(Student::class, StudentCourse::class);
    // }

    public function result()
    {
        return $this->belongsTo(Result::class);
    }

    // public function course()
    // {
    //     return $this->hasOneThrough(Course::class, StudentCourse::class);
    // }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function student_course()
    {
        return $this->belongsTo(StudentCourse::class);
    }
}
