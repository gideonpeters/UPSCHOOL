<?php

namespace App;

use App\Course;
use App\Program;
use App\CourseStatus;
use Illuminate\Database\Eloquent\Model;

class CurriculumItem extends Model
{
    //status, course, prerequisite
    public function status()
    {
        return $this->hasOne(CourseStatus::class);
    }

    public function course()
    {
        return $this->hasOne(Course::class);
    }

    public function programs()
    {
        return $this->belongsTo(Program::class);
    }
}
