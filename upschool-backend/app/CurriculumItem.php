<?php

namespace App;

use App\Course;
use App\Program;
use App\Curriculum;
use App\Enrollment;
use App\CourseStatus;
use App\StudentCourse;
use Illuminate\Database\Eloquent\Model;

class CurriculumItem extends Model
{
    //status, course, prerequisite
    protected $with = ['status', 'curriculumable:id,title,course_code,description'];

    public function curriculumable()
    {
        return $this->morphTo();
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class);
    }

    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class, 'enrollments_curriculum_items', 'curriculum_item_id', 'enrollment_id');
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'programs_curriculum_items', 'curriculum_item_id', 'program_id');
    }

    public function student_courses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    // public function curriculum()
    // {
    //     return $this->belongsTo(Curriculum::class);
    // }
}
