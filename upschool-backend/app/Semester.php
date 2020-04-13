<?php

namespace App;

use App\Event;
use App\Course;
use App\Result;
use App\Gradelist;
use App\ScheduleItem;
use App\SemesterType;
use App\AcademicSession;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // protected $with = ['semesterType', 'academicSession'];
    protected $appends = ['name'];

    public function getNameAttribute()
    {
        // dd(Semester::find($this->id)->semester_type_id);
        $semester =  SemesterType::find(Semester::find($this->id)->semester_type_id);
        return "$semester->title $semester->id";
    }

    public function semester()
    {
        return $this->belongsTo(SemesterType::class, 'semester_type_id');
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
    }

    public function gradelists()
    {
        return $this->hasMany(Gradelist::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function schedule_items()
    {
        return $this->hasMany(ScheduleItem::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
