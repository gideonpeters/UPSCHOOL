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

class Course extends Model
{
    //
    protected $with = ['semester_type', 'prerequisites'];

    public function semester_type()
    {
        return $this->belongsTo(SemesterType::class);
    }

    public function status()
    {
        return $this->belongsTo(CourseStatus::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function facilitators()
    {
        return $this->belongsToMany(Staff::class, 'course_staff', 'course_id', 'staff_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'course_id', 'prerequisite_id');
    }

    public function prerequisite_to_courses()
    {
        return $this->belongsToMany(Course::class, 'prerequisite_course', 'prerequisite_id', 'course_id',);
    }


    public function curriculumItem()
    {
        return $this->hasOne(CurriculumItem::class);
    }
}
