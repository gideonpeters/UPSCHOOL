<?php

namespace App;

use App\Course;
use App\Program;
use App\Curriculum;
use App\Enrollment;
use App\CourseStatus;
use App\PendingCourse;
use App\StudentCourse;
use App\CurriculumBlock;
use App\StudentEnrollmentItem;
use Illuminate\Database\Eloquent\Model;

class CurriculumItem extends Model
{
    //status, course, prerequisite
    protected $with = ['status', 'curriculumable', 'curriculum_block'];

    public function curriculumable()
    {
        return $this->morphTo();
    }

    public function student_enrollment_items()
    {
        return $this->hasMany(StudentEnrollmentItem::class);
    }

    public function curriculum_block()
    {
        return $this->belongsTo(CurriculumBlock::class);
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class, 'course_status_id');
    }

    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class, 'enrollments_curriculum_items', 'curriculum_item_id', 'enrollment_id');
    }

    public function programs()
    {
        return $this->belongsTo(Program::class);
        // return $this->belongsToMany(Program::class, 'programs_curriculum_items', 'curriculum_item_id', 'program_id');
    }

    public function student_courses()
    {
        return $this->hasMany(StudentCourse::class);
    }

    public function semester()
    {
        return $this->belongsTo(SemesterType::class, 'semester_type_id');
    }

    // public function curriculum()
    // {
    //     return $this->belongsTo(Curriculum::class);
    // }
}
