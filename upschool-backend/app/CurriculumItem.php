<?php

namespace App;

use App\Course;
use App\Program;
use App\Curriculum;
use App\CourseStatus;
use Illuminate\Database\Eloquent\Model;

class CurriculumItem extends Model
{
    //status, course, prerequisite
    protected $with = ['course', 'status'];

    public function status()
    {
        return $this->belongsTo(CourseStatus::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function curriculum()
    {
        return $this->hasOne(Curriculum::class);
    }
}
