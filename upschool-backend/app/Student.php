<?php

namespace App;

use App\File;
use App\User;
use App\Course;
use App\Option;
use App\Program;
use App\Guardian;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $with = ['user', 'program'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
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

    // public function option()
    // {
    //     return $this->hasOneThrough(Option::class, Program::class);
    // }
}
