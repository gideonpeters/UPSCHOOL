<?php

namespace App;

use App\Event;
use App\Course;
use App\ScheduleItem;
use App\SemesterType;
use App\AcademicSession;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    //
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // protected $with = ['semesterType', 'academicSession'];

    public function semester()
    {
        return $this->belongsTo(SemesterType::class, 'semester_type_id');
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class, 'academic_session_id');
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
