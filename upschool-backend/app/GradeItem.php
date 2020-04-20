<?php

namespace App;

use App\Student;
use App\Gradelist;
use App\StudentCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GradeItem extends Model
{
    //
    protected $appends = ['student'];

    public function gradelist()
    {
        return $this->belongsTo(Gradelist::class);
    }

    public function getStudentAttribute()
    {
        $student_course = DB::table('student_courses')->whereId($this->student_course_id)->first();
        $student = DB::table('students')->whereId($student_course->student_id)->first();
        // dd($student);
        return $student;
        // return $this->hasOneThrough(Student::class, StudentCourse::class, 'student_id', 'id', 'id', 'id');
    }
}
