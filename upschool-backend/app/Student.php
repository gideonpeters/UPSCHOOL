<?php

namespace App;

use App\File;
use App\Room;
use App\User;
use App\Exeat;
use App\Course;
use App\Option;
use App\Result;
use App\Program;
use App\Guardian;
use App\Enrollment;
use App\ResultItem;
use App\StudentRoom;
use App\PendingCourse;
use App\StudentCourse;
use App\StudentEnrollmentItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    //
    use Notifiable;

    protected $with = ['user', 'program'];

    protected $appends = ['credits_achieved', 'name', 'type'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function getCreditsAchievedAttribute()
    {

        return (int) (DB::table('results')->whereStudentId($this->id)->sum('total_units'));
    }

    public function getTypeAttribute()
    {
        return 'student';
    }

    public function getNameAttribute()
    {
        $student = Student::whereId($this->id)->first();
        return "$student->first_name $student->middle_name $student->last_name";
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_courses')->using(StudentCourse::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'student_rooms')->using(StudentRoom::class);
    }

    public function getLatestRoomAttribute()
    {
        return '670';
        // return StudentRoom::whereStudentId($this->id)->whereSemesterId(Semester::latest()->first()->id)->first();
    }

    public function enrollment_items()
    {
        return $this->hasMany(StudentEnrollmentItem::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
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
        return $this->hasManyThrough(ResultItem::class, StudentCourse::class, 'student_id', 'student_course_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function exeats()
    {
        return $this->hasMany(Exeat::class);
    }

    // public function option()
    // {
    //     return $this->hasOneThrough(Option::class, Program::class);
    // }
}
