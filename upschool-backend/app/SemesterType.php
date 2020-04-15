<?php

namespace App;

use App\Course;
use App\Semester;
use Illuminate\Database\Eloquent\Model;

class SemesterType extends Model
{
    //

    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }


    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
