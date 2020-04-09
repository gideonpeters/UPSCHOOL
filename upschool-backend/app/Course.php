<?php

namespace App;

use App\Staff;
use App\Student;
use App\Category;
use App\CourseStatus;
use App\Prerequisite;
use App\SemesterType;
use App\CurriculumItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Course extends Model
{
    //
    protected $with = ['semester_type', 'prerequisites'];

    public function semester_type()
    {
        return $this->belongsTo(SemesterType::class);
    }

    public function participants()
    {
        return $this->belongsToMany(Student::class, 'student_courses')->using(StudentCourse::class);
    }

    public function curriculum_items()
    {
        return $this->morphMany(CurriculumItem::class, 'curriculumable');
    }

    public function facilitators()
    {
        return $this->belongsToMany(Staff::class, 'course_staff', 'course_id', 'staff_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'courses_course_categories', 'course_id', 'course_category_id');
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'course_id', 'prerequisite_id');
    }

    public function prerequisite_to_courses()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'prerequisite_id', 'course_id',);
    }

    // public function curriculum_items()
    // {
    //     return $this->belongsToMany(CurriculumItem::class, 'courses_curriculum_items', 'course_id', 'curriculum_item_id');
    // }
}
