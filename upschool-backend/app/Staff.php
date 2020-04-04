<?php

namespace App;

use App\File;
use App\User;
use App\Course;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    //
    protected $with = ['user'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function advisee()
    {
        return $this->hasMany(Student::class);
    }

    public function courses_facilitating()
    {
        return $this->belongsToMany(Course::class, 'course_staff', 'staff_id', 'course_id');
    }

    public function image()
    {
        return $this->morphOne(File::class, 'fileable')->withDefault();
    }
}
