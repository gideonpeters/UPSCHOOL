<?php

namespace App;

use App\File;
use App\Student;
use App\Semester;
use App\ExeatType;
use App\StudentRoom;
use Illuminate\Database\Eloquent\Model;

class Exeat extends Model
{
    //
    public function exeat_type()
    {
        return $this->belongsTo(ExeatType::class);
    }

    public function getLatestRoomAttribute()
    {
        // return '670';
        return StudentRoom::with('room', 'room.hall')->whereStudentId($this->student->id)->whereSemesterId(Semester::latest()->first()->id)->first();
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function file()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
