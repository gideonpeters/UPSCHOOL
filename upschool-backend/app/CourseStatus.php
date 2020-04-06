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
        return $this->morphMany(Course::class, 'courseable');
    }

    public function graduationUnits()
    {
        return $this->hasMany(GraduationUnit::class);
    }

    public function curriculum_item()
    {
        return $this->hasOne(CurriculumItem::class);
    }
}
