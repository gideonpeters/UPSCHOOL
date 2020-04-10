<?php

namespace App;

use App\Course;
use App\GraduationUnit;
use Illuminate\Database\Eloquent\Model;

class CourseStatus extends Model
{
    //
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function graduationUnits()
    {
        return $this->hasMany(GraduationUnit::class);
    }

    public function curriculum_items()
    {
        return $this->hasMany(CurriculumItem::class);
    }
}
