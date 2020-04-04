<?php

namespace App;

use App\Degree;
use App\Option;
use App\School;
use App\Student;
use App\Curriculum;
use App\Department;
use App\CurriculumItem;
use App\GraduationUnit;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $with = ['department', 'degree', 'curricula'];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id');
    }

    public function degree()
    {
        return $this->belongsTo(Degree::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function graduationUnits()
    {
        return $this->hasMany(GraduationUnit::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function studentOption()
    {
        return $this->hasOneThrough(Option::class, Student::class);
    }

    public function curricula()
    {
        return $this->hasMany(Curriculum::class);
    }
}
