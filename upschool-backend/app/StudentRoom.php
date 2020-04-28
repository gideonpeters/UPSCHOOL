<?php

namespace App;

use App\Room;
use App\Student;
use App\Semester;
use App\AcademicSession;
use Illuminate\Database\Eloquent\Model;

class StudentRoom extends Model
{
    // 
    protected $table = 'student_rooms';

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function session()
    {
        return $this->belongsTo(AcademicSession::class, 'session_id');
    }
}
