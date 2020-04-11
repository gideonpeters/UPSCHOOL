<?php

namespace App;

use App\File;
use App\User;
use App\Course;
use App\Option;
use App\Result;
use App\Program;
use App\Guardian;
use App\ResultItem;
use App\StudentCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $with = ['user', 'program',];

    protected $appends = ['credits_achieved'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function getCreditsAchievedAttribute()
    {
        return (int) (DB::table('results')->whereStudentId($this->id)->sum('total_units'));
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')->using(StudentCourse::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class);
    }

    public function adviser()
    {
        return $this->belongsTo(Staff::class, 'adviser_id');
    }

    public function image()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    public function result_items()
    {
        return $this->hasMany(ResultItem::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    // public function option()
    // {
    //     return $this->hasOneThrough(Option::class, Program::class);
    // }
}
